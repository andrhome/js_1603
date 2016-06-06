<?php
/* @var $form CActiveForm*/
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.Jcrop.js',
    CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/jquery.Jcrop.css');

?>
<div class="forBlogH3">
    <h3><?= Yii::t('main', 'Особистий кабінет'); ?></h3> <span class="glyphicon glyphicon-play"></span> <a href="blog.html">блоггер</a>
</div>

<div class="profileAllSeen">
    <div class="forAvatarEdit" id="avatar">
        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-search"></span>
        </button>
        <?= CHtml::image('/uploads/users/avatars/'.$user->avatar, $user->name); ?>
    </div>
    
    <div class="textProfile">
        <h3><?= CHtml::encode($user->name); ?></h3>
        <p><?= CHtml::encode($user->location); ?></p>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle liveAbout" data-toggle="dropdown"><?= Yii::t('main', 'Про мене'); ?><span class="caret"></span></button>
            <div class="dropdown-menu blockForReload" role="menu">
                <div><p class="rText"><?= Yii::t('main', 'Стать'); ?>:</p><p class="lText"><?= CHtml::encode($user->stringSex); ?></p></div>
                <div><p class="rText"><?= Yii::t('main', 'Професія'); ?>:</p><p class="lText"><?= CHtml::encode($user->profession); ?></p></div>
                <div class="lastAbout"><p class="rText"><?= Yii::t('main', 'Про себе'); ?>:</p><p class="lText"><?= CHtml::encode($user->description); ?></p></div>
            </div>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" id="editText"><?= Yii::t('main', 'Змінити данні'); ?> <span class="caret"></span></button>

   <!--------------Form------------------->
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'editForms',
                'action'=>'/blog/cabinet/editProfile',
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            )); ?>
            <form class="editForm" id="editForms">
                <div class="dropdown-menu profEditM" role="menu">
                    <div>
                        <p class="rText"><?= Yii::t('main', 'Ім"я'); ?></p>
                        <p class="lText">
                            <?= $form->textField($user, 'name', array('class'=>'form-control', 'placeholder'=>Yii::t('main', 'Ім"я'))) ?>
                        </p>
                    </div>

                    <div>
                        <p class="rText"><?= Yii::t('main', 'Стать'); ?></p>
                        <p class="lText">
                            <?= $form->dropDownList($user, 'sex', array(1=>Yii::t('main', 'Чоловіча'), 2=>Yii::t('main', 'Жіноча')), array('class'=>'form-control', 'empty'=>Yii::t('main', 'Оберіть стать'))) ?>
                        </p>
                    </div>

                    <div>
                        <p class="rText"><?= Yii::t('main', 'Професія'); ?></p>
                        <p class="lText">
                            <?= $form->textField($user, 'profession', array('class'=>'form-control', 'placeholder'=>Yii::t('main', 'Професія'))); ?>
                        </p>
                    </div>

                    <div>
                        <p class="rText"><?= Yii::t('main', 'Місце проживання'); ?></p>
                        <p class="lText">
                            <?= $form->textField($user, 'location', array('class'=>'form-control', 'placeholder'=>Yii::t('main', 'Украина, Київ'))); ?>
                        </p>
                    </div>

                    <div>
                        <p class="rText"><?= Yii::t('main', 'Про себе'); ?></p>
                        <p class="lText">
                            <?= $form->textArea($user, 'description', array('class'=>'form-control')); ?>
                        </p>
                    </div>

                    <div class="lastAbout">
                        <p class="rText"></p>
                        <p class="lText bottomText">
                            <?= CHtml::ajaxSubmitButton(Yii::t('main', 'Змінити'), array('/blog/cabinet/editProfile'),array(
                                'success'=>'function(data) {
                                    $("#data-save").html(data);
                                }',
                            ), array('class'=>'btn btn-primary profEdit')); ?>
                            <p class="Edit" id="data-save"></p>
                        </p>
                </div>
			
            </div>
            </form>
            <?php $this->endWidget(); ?>
    <!---------------/Form-------------------->
        </div>
    </div>
    <div class="ratingBlock">

        <div class="rating">
            <input type="hidden" name="val" value="2.75"/>
            <input type="hidden" name="vote-id" value="voteID"/>
        </div>

        <div class="btn btn-primary showAdd">
            <span class="glyphicon glyphicon-plus"></span>
            <?= Yii::t('main', ' Додати пост'); ?>
        </div>

    </div>

    <span class="glyphicon glyphicon-wrench passworldEdit"></span>

</div>
<div class="addPost">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'article-form',
        'action'=>'/blog/cabinet/create',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title', array('class'=>'form-control', 'placeholder'=>Yii::t('main', 'Назва поста'))); ?>
    <?php echo $form->error($model,'title'); ?>

    <?php echo $form->labelEx($model,'description'); ?>
    <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
        'model'=>$model,
        'attribute'=>'description',
        'config'=>array(
            'filebrowserUploadUrl' => $this->createUrl('/blog/upload/index/'),//Конфиг вставлять сюда
        ),
    ));
    ?>
    <?php echo $form->error($model,'description'); ?>
    <p class="absoluteAdd"><?= Yii::t('main', 'Додати пост'); ?> &nbsp; <?php echo CHtml::tag('button',
            array('class' => 'btn btn-info absoluteAddButton'),
            '<span class="glyphicon glyphicon-plus"></span>'); ?></p>
    <?php $this->endWidget(); ?>
</div>
	
	<div class="changePass">
	    <form action="" id="ChangePass">
            <input name="oldPass" class="form-control" type="text" placeholder="Введите старый пароль" required>
            <input name="newPass" class="form-control" type="text" placeholder="Введите новый пароль" required>
            <input name="newPass2" class="form-control" type="text" placeholder="Повторите ввод" required>
            <?= CHtml::ajaxSubmitButton('Змінити', array('/blog/cabinet/editPassword'),array(
                'success'=>'function(data) {
                                    alert(data);
                                }',
            ), array('class'=>'btn btn-default')); ?>
		</form>
	</div>


        <h3 class="pull-left"><?= Yii::t('main', 'Мої записи'); ?></h3>
        <div style="clear: both"></div>
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$allPosts,
            'ajaxUpdate'=>true,
            'itemView'=>'_posts',
            'itemsCssClass'=>'blogerOnePost',
            'template'=>'{items}{pager}',
            'cssFile'=>false,
            'pager'=>array(
                'maxButtonCount' => 5,
                'lastPageLabel'=>'>>',
                'nextPageLabel'=>'>',
                'prevPageLabel'=>'<',
                'firstPageLabel'=>'<<',
                'class'=>'CLinkPager',
                'header'=>false,
                'cssFile'=>'/css/pager.css', // устанавливаем свой .css файл
                'htmlOptions'=>array('class'=>'sfd'),
            ),
            'pagerCssClass'=>'pager',
            'htmlOptions'=>array(
                'id'=>'userList',
            )
        ));
        ?>
<div class="forBlogH3">
    <h3><?= Yii::t('main', 'Читайте також'); ?></h3> <span class="glyphicon glyphicon-play"></span> <a><?= Yii::t('main', 'Популярні пости'); ?></a>
</div>



<div class="marginBottom">
    <div class="collsPost">
        <?php foreach($lastPosts as $i => $post): ?>
            <?php if($i == 0 || $i == 6 || $i == 12) echo '<div>'; ?>
            <a href="<?= $this->createUrl('/blog/default/post', array('id'=>$post->id)); ?>">
            <span>
                <span class="glyphicon glyphicon-calendar"></span>
                <?= date('d.m.Y', strtotime($post->date)); ?>
            </span>
                <br />
                <?= CHtml::encode($post->title); ?>
            </a>
            <?php if($i == 5 || $i == 11 || $i == 17) echo '</div>'; ?>
        <?php endforeach; ?>
    </div>
</div>
<div class="marketOwnNewA">

</div>
<div class="blogSlider">
    <div class="forBlogH3">
        <h3><?= Yii::t('main', 'ТОП блогери'); ?></h3> <span class="glyphicon glyphicon-play"></span> <a>блоги</a>
    </div>
    <ul class="bxsliderBlog">
        <?php foreach($popularBlogers as $bloger): ?>
            <li>
                <?= CHtml::image(Yii::app()->baseUrl.'/uploads/users/avatars/'.$bloger->avatar, $bloger->name); ?>
                <h5><?= CHtml::link($bloger->name, array('/blog/default/bloger', 'id'=>$bloger->id)); ?></h5>
                <p>
                    <?= CHtml::encode($bloger->description); ?>
                </p>
                <?= CHtml::link(Yii::t('main', 'Читати...'), array('/blog/default/bloger', 'id'=>$bloger->id), array('class'=>'btnRead')); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    $('.showAdd').click(function(){
        $('.addPost').slideToggle();
    });
    $('.edit_privat').click(function(){
        $('.edit_slide').toggle();
    });

    $('#editText').on('click', function(){
    	$('.profEditM').toggle();
    });

    $(".liveAbout").on('click', function(){
    	$('.profEditM').hide();
    });

    $("#editForms").submit(function(e){
    	e.preventDefault();

    	var data = $('#editForms').serialize();
        $.ajax({
          type: 'POST',
          url: 'Поставить свои контроллер или модель или что там у тебя!',
          data: data,
          beforeSend: function(){
          	$('.profEdit').hide();
          	$('.EditOk').show();
          },
          success: function(data) {
          	$(".blockForReload").load("Твой файл", function() {
				/*Тут калбак если нужно,  эта функция перезагружает блок обо мне чтоб страницу 
				не обновлять если не получиться убери нахуй или закомментируй, но я делал это легко*/
			});
          	setTimeout(function() {
			  $('.EditOk').hide();
              $('.profEdit').show()   
			}, 5000);
          },
          error:  function(xhr, str){
                
            }
        });

    });

    $('#delUserForm').submit(function(event){
    	event.preventDefault();
    	if(confirm("Уверены что хотите удалить акаункт?")){
    		var data = $('#delUserForm').serialize();
        $.ajax({
          type: 'POST',
          url: 'Поставить свои контроллер или модель или что там у тебя!',
          data: data,
          success: function() {
          	location.href("Сюда вставить переадресацию на главную страницу");
          }
    	});
      }
    });


    $(".passworldEdit").on('click', function(){
    	$(".changePass").fadeToggle('slow');
    });

</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Загрузка и обрезка фото</h4>
            </div>
            <div class="modal-body">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id'=>'image-form',
                    'method'=>'POST',
                    'action'=>'/blog/cabinet/upload',
                    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                )); ?>

                <?= CHtml::fileField('avatar', '', array('class'=>'form-control')); ?>

                <?= CHtml::submitButton('Загрузить', array('class'=>'btn btn-default')); ?>
                <?php $this->endWidget(); ?>

                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id'=>'image-crop',
                    'method'=>'POST',
                    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                )); ?>

                <div id="done"></div>
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />

                <?= CHtml::submitButton('Обрезать', array('class'=>'btn btn-default')); ?>
                <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>
</div>
<script>
    $("#image-form").submit(function(event){
        event.preventDefault();
        var data = new FormData($("#image-form")[0]);
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl("/blog/cabinet/upload"); ?>",
            data: data,
            contentType: false,
            processData: false,
            success: function(html) {
                $("#image-form").hide();
                $("#image-crop").show();
                $("#done").append(html);
                $("#crop").load(function(){
                    $(this).Jcrop({
                        aspectRatio: 4/2.8,
                        boxWidth: 530,
                        boxHeight: 600,
                        onSelect: updateCoords
                    });
                });
            }
        }).done(function(){

        });
    });
</script>
<script>
    $( document ).ready(function() {
        $("#image-crop").hide();
    });
</script>
<script>
    function updateCoords(c)
    {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    };

    function checkCoords()
    {
        if (parseInt($('#w').val())) return true;
        alert('Please select a crop region then press submit.');
        return false;
    };
</script>
<script>
    $("#image-crop").submit(function(event){
        event.preventDefault();
        var data = new FormData($("#image-crop")[0]);
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl("/blog/cabinet/crop"); ?>",
            data: data,
            contentType: false,
            processData: false,
            success: function(html) {
                $("#avatar").html(html);
                //location.reload();
            }
        }).done(function(){

        });
    });
</script>
