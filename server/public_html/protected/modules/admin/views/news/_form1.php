<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/cropper.js',
    CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/crop-avatar.js',
    CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/cropper.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/crop-avatar.css');

?>
<div class="container" id="crop-avatar">

    <!-- Current avatar -->
    <div class="avatar-view" title="Change the avatar">
        <?= CHtml::image(Yii::app()->baseUrl.'/images/news-image.jpg', 'Avatar'); ?>
    </div>

    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form" method="post" action="crop-avatar.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">

                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <label for="avatarInput">Local upload</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>

                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary avatar-save" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->

    <!-- Loading state -->
    <div class="loading" tabindex="-1" role="img" aria-label="Loading"></div>
</div>

