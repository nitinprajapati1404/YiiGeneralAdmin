<?php
/* @var $this MagazineController */
/* @var $model Magazine */
/* @var $form CActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-heading">

        <?php if (!$model->isNewrecord) { ?>
            <h4 class="panel-title">Edit Image</h4>
        <?php } else { ?>
            <h4 class="panel-title">Create Image</h4>
        <?php } ?>
    </div>
    <div class="panel-body">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'face-image-master-form',
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
                    <label class="col-sm-3 control-label">Name <span class="asterisk">*</span></label>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'tracer_id', array('class' => 'form-control validate[required]', 'onblur' => "checkMagazine(this.value);")); ?><div id="magazine_error"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Image <span class="asterisk">*</span></label>
                    <div class="col-md-9">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <!--<div class="fileinput-new thumbnail" style="width: 100px;">-->


                            <!--</div>-->
                            <!--<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 100px;"></div>-->
                            <div class="text-center">
                                <span class="btn btn-primary btn-xs btn-file"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span>

                                    <?php
                                    $image = "";
                                    if (!$model->isNewrecord) {
                                        $image_value = $model->image;
                                        if (empty($image_value)) {
                                            ?>
                                            <input type="hidden" id="test" value="">
                                            <?php
                                        } else {
                                            $image = $model->imagePathTest . $image_value;
                                            ?>
                                            <input type="hidden" id="test" value="<?php echo $image; ?>"> 

                                            <?php
                                        }
                                        ?>  
                                        <input id="files" type="file" name="image[]" multiple="" value=""/></span>

                                    <?php
                                } else {
                                    ?>
                                    <input id="files" type="file" name="image[]" multiple=""/></span>
                                    <?php
                                }
                                ?>

                                <a href="#" class="btn btn-primary btn-xs fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                        <span id="testImage"> 

                        </span>
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
$('#face-image-master-form').validationEngine();
$('#btnSubmit').click(function(e){
        e.preventDefault(); 
        if($('#face-image-master-form').validationEngine('validate'))
        {
            $('form#face-image-master-form').submit();
        }
     }); 
 });
", CClientScript::POS_END);
?>
<script>
//    $(window).load(function() {
//         var hiddenImageVal = $("#hiddenImage").val();
//        if(hiddenImageVal!==""){
//            console.log("yes");
////            $("#files").trigger("change");
////            config.imagePreview('#files', 'change', '#testImage');
//        }
//        
//    });
    $(document).ready(function(e) {
        var Updatevalue = $("#test").val();
        config.imagePreview('#files', 'change', '#testImage');

//        if (Updatevalue !== '') {
//            var arr = Updatevalue.split(',');
//            $.each(arr, function(index, value) {
//                config.onImageExistsPreview('#testImage', value); 
//            });
//          
//        }
        if (Updatevalue !== '') {
            
                config.onImageExistsPreview(Updatevalue,'#testImage'); 
            
        }

        //select
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