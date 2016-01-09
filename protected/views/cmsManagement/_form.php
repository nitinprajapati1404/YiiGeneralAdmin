<?php
/* @var $this CmsManagementController */
/* @var $model CmsManagement */
/* @var $form CActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-heading">

        <?php if (!$model->isNewrecord) { ?>
            <h4 class="panel-title">Edit Contact Us</h4>
        <?php } else { ?>
            <h4 class="panel-title">Create Contact Us</h4>
        <?php } ?>
    </div>
    <div class="panel-body">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'cms-management-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')
        ));

        $err = $form->errorSummary($model);
        if (isset($err) && $err != '') {
            ?>
            <div class="info" style="z-index: 11;text-align:center;">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $form->errorSummary($model); ?>
                </div>
            </div>
        <?php }
        ?>
        <div class="row"> 
            <div class="col-md-12"> 
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'cms_page_title'); ?> <span class="asterisk">*</span></label>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'cms_page_title', array('class' => 'form-control validate[required]', 'onblur' => "return config.checkvalue(this.value);")); ?><div id="magazine_error"></div>
                    </div>
                </div>  
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'cms_page_content'); ?> <span class="asterisk">*</span></label>
                    <div class="col-sm-6">
                        <?php echo $form->textArea($model, 'cms_page_content', array('class' => 'form-control validate[required]')); ?>
                        <div class="formErrorContent errContent" style="display: none;">* This field is required</div>
                    </div>

                </div>


            </div></div> 

        <?php $this->endWidget(); ?>

    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="form-group description mt15">
                <div class="col-sm-3"> </div>
                <div class="col-sm-9">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class' => 'btn btn-primary btn-sm', 'id' => 'btnSubmit')); ?>
                    <?php echo App::cancelButton($this); ?>
                </div
                ></div>
        </div>
    </div>
</div><!-- form -->
<?php Yii::app()->clientScript->registerScriptFile(App::param('siteurl') . "js/select2.min.js", CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(App::param('siteurl') . "js/jasny-bootstrap.js", CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(App::param('siteurl') . "js/btvalidationEngine.js", CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(App::param('siteurl') . "js/btvalidationEngine-en.js", CClientScript::POS_END); ?>
<link rel="stylesheet" type="text/css" href="<?= App::param('siteurl'); ?>css/validationEngine.css"/>
<link rel="stylesheet" type="text/css" href="<?= App::param('siteurl'); ?>css/jasny-bootstrap.css"/>
<?php
Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(e){

 });
", CClientScript::POS_END);
?>
<script src="<?php echo App::param('lib') . 'ckeditor/ckeditor.js'; ?>"></script>
<script>
    var flag;
    $(document).ready(function(e) {
        config.ckEditorFormGet('CmsManagement[cms_page_content]', 'CmsManagement_cms_page_content');
        var flag = false;
        CKEDITOR.instances['CmsManagement_cms_page_content'].on('blur', function() {
            flag = config.ckEditorValueOnBlur('CmsManagement_cms_page_content');
        });
        config.eventHandler('#btnSubmit', 'click', function(e) {
            e.preventDefault();
            config.submitForm('#cms-management-form', flag);
        });
        $('select').select2({
            width: '100%'
        });
        window.setTimeout(function() {
            $('.select2-container').removeClass('error');
        }, 100);
    });


</script> 

<style>
    .imageThumb{
        max-height: 100px;
        max-width: 100px;
        padding: 5px;
    }

</style>
