<?php
/* @var $this ContactUsController */
/* @var $model ContactUs */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'contact_id'); ?>
		<?php echo $form->textField($model,'contact_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_name'); ?>
		<?php echo $form->textField($model,'contact_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_email'); ?>
		<?php echo $form->textField($model,'contact_email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_phone'); ?>
		<?php echo $form->textField($model,'contact_phone',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_message'); ?>
		<?php echo $form->textArea($model,'contact_message',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->