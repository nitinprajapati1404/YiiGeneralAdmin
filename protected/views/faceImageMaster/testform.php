<!--<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Multiple File Ppload with PHP</title>
</head>
<body>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
<input type="file" name="image[]" value="" id="image" class="MultiFile-applied" multiple="multiple">
  <input type="submit" value="Upload!" />
</form>
</body>
</html>-->

<?php
print_r(phpinfo());die;
/* @var $this FaceImageMasterController */
/* @var $model FaceImageMaster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'face-image-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	 

	<div class="row">
		<?php echo $form->labelEx($model,'tracer_id'); ?>
		<?php echo $form->textField($model,'tracer_id'); ?>
		<?php echo $form->error($model,'tracer_id'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'image'); ?>
              <?php 
      $this->widget('CMultiFileUpload', array(
             'model'=>$model,
             'name'=>'image',
             'attribute'=>'image',
             'accept'=>'jpg|gif|png',
            ));
            ?> 
		<?php echo $form->error($model,'image'); ?>
	</div>
 

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->