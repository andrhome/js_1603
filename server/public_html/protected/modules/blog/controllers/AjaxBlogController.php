<?php

class AjaxBlogController extends Controller
{
    public function actionImg()
    {
        $model = new Articles();
        $image = CUploadedFile::getInstance($model,'image');
        //var_dump($image->name); exit;
        $image->saveAs(Yii::getPathOfAlias('webroot.uploads.temp').DIRECTORY_SEPARATOR.$image->name);
        $this->renderPartial('_image', array('image'=>$image));
    }
}