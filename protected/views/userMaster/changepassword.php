<?php
/* @var $this UserMasterController */
/* @var $model UserMaster */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
	'Change Password'
	//$model->admin_id,
);
?>

                                  
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
           <div class="panel-body">
                <div class=" form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'frmChangePassword',
   // 'name'=>'frmChangePassword',
        //'class'=>'cmxform form-horizontal tasi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
                'class'=>'cmxform form-horizontal tasi-form',
        ),
)); ?>

	
	
	<div class="form-group ">
            <label for="cemail" class="control-label col-lg-2">Current Password <span class="asterisk">*</span></label>
            <div class="col-lg-4">
                <input placeholder="Enter Your Current Password" class="form-control validate[required,minSize[5]]" id="txtCurPassword" type="password" name="UserMaster[CurrentPassword]"/>
            </div>
        </div>
        
        <div class="form-group ">
            <label for="cemail" class="control-label col-lg-2">New Password <span class="asterisk">*</span></label>
            <div class="col-lg-4">
                <input placeholder="Enter New Password" class="form-control validate[required,minSize[5]]" id="txtNewPassword" type="password" name="UserMaster[NewPassword]" />
            </div>
        </div>
        
        <div class="form-group ">
            <label for="cemail" class="control-label col-lg-2">Re-type Password <span class="asterisk">*</span></label>
            <div class="col-lg-4">
                <input placeholder="Retype New Password" class="form-control validate[required,minSize[5],equals[txtNewPassword]]" id="txtCnfPassword" type="password" name="UserMaster[CnfPassword]" />
            </div>
        </div>

	<div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Update' : 'Save',array('class' => 'btn btn-primary btn-sm','id'=>'btnSubmit')); ?>
                <a class="btn btn-danger btn-sm" id="btncancel" href='<?php echo Yii::app()->request->urlReferrer; ?>'>Cancel</a>
            </div>
        </div>
                

<?php $this->endWidget(); ?>

</div><!-- form -->
 </div>
    </section>
</div>
</div>
<?php Yii::app()->clientScript->registerScriptFile(App::param('siteurl') . "js/btvalidationEngine.js", CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(App::param('siteurl') . "js/btvalidationEngine-en.js", CClientScript::POS_END); ?>
<link rel="stylesheet" type="text/css" href="<?=App::param('siteurl');?>css/validationEngine.css"/>

 <?php  
    Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(e){
$('#frmChangePassword').validationEngine();
$('#btnSubmit').click(function(e){
        e.preventDefault();
        if($('#frmChangePassword').validationEngine('validate'))
        {
             $('form#frmChangePassword').submit();
        }
     }); 
 });
", CClientScript::POS_END);
?>