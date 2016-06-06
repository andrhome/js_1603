<?php

class UploadController extends AdminController
{
    public function actionIndex()
    {
        //номер функции обратного вызова
        $callback = $_GET['CKEditorFuncNum'];
        //имя фалйа
        $file_name = uniqid().$_FILES['upload']['name'];
        //временное имя файла на сервере
        $file_name_tmp = $_FILES['upload']['tmp_name'];
        //указываем куда складывать изображения
        $file_new_name = 'uploads/newsimages/';
        //формируем полный путь к изображению
        $full_path = $file_new_name.$file_name;
        //формируем адрес для атрибута src тега img
        $http_path = '/uploads/newsimages/'.$file_name;
        $error = '';
        if( move_uploaded_file($file_name_tmp, $full_path) ) {}
        else
        {
            $error = 'Some error occured please try again later';
            $http_path = '';
        }
        echo "<script type=\"text/javascript\">
                 window.parent.CKEDITOR.tools.callFunction(".$callback.",  \"".$http_path."\", \"".$error."\" );
             </script>";
    }

    public function actionCrop()
    {
        $name = $_POST['nameFull'];
        $fullImagePath = Yii::getPathOfAlias('webroot.uploads.news.full').DIRECTORY_SEPARATOR.$name;
        $quality = 100;

        $fullImg = getimagesize($fullImagePath);
        switch(strtolower($fullImg['mime']))
        {
            case 'image/png':
                $source_image = imagecreatefrompng($fullImagePath);
                $type = 'png';
                $quality = 0;
                break;
            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($fullImagePath);
                $type = 'jpeg';
                break;
            case 'image/gif':
                $source_image = imagecreatefromgif($fullImagePath);
                $type = 'gif';
                break;
            default: die('image type not supported');
        }
        $function = 'image'.$type;

        $resizeImage = imagecreatetruecolor(324, 230); //$_POST['h'], $_POST['h']

        $src_x = $_POST['x'];
        $src_y = $_POST['y'];
        $dst_y = 0;
        $dst_x = 0;
        $dst_w = $_POST['w'];
        $dst_h = $_POST['h'];

        imagecopyresampled($resizeImage,$source_image, 0, 0, $src_x, $src_y,
            324, 230, $dst_w, $dst_h);

        $function($resizeImage, Yii::getPathOfAlias('webroot.uploads.news.thumb').DIRECTORY_SEPARATOR.$name, $quality);
        $model = new News();
        echo CHtml::image(Yii::app()->baseUrl.'/uploads/news/full/'.$name);
        echo CHtml::image(Yii::app()->baseUrl.'/uploads/news/thumb/'.$name);
        echo CHtml::activeHiddenField($model, 'image', array('value'=>$name));


    }

    public function actionUpload()
    {
        $name = $_POST['name'];
        $model = new News();
        $image = CUploadedFile::getInstance($model, 'image');

        switch(strtolower($image->type))
        {
            case 'image/png':
                $type = '.png';
                break;
            case 'image/jpeg':
                $type = '.jpeg';
                break;
            case 'image/gif':
                $type = '.gif';
                break;
            default: die('image type not supported');
        }
        $image->saveAs(Yii::getPathOfAlias('webroot.uploads.news.full').DIRECTORY_SEPARATOR.$name.$type);
        list($resource['width'], $resource['height']) = getimagesize(Yii::getPathOfAlias('webroot.uploads.news.full').DIRECTORY_SEPARATOR.$name.$type);

        echo CHtml::image(Yii::app()->baseUrl.'/uploads/news/full/'.$name.$type, '', array('id'=>'crop'));
        echo CHtml::hiddenField('nameFull', $name.$type);
        echo CHtml::hiddenField('src_w', $resource['width']);
        echo CHtml::hiddenField('src_h', $resource['height']);
        Yii::app()->end();
    }
}