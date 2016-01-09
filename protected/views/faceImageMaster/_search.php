<?php
/* @var $this FaceImageMasterController */
/* @var $model FaceImageMaster */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'fim_id'); ?>
		<?php echo $form->textField($model,'fim_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fm_id'); ?>
		<?php echo $form->textField($model,'fm_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tracer_id'); ?>
		<?php echo $form->textField($model,'tracer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>10000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->