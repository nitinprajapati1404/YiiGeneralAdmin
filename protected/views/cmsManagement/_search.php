<?php
/* @var $this CmsManagementController */
/* @var $model CmsManagement */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cms_id'); ?>
		<?php echo $form->textField($model,'cms_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cms_page_alias'); ?>
		<?php echo $form->textField($model,'cms_page_alias',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cms_page_title'); ?>
		<?php echo $form->textField($model,'cms_page_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cms_page_content'); ?>
		<?php echo $form->textArea($model,'cms_page_content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified_on'); ?>
		<?php echo $form->textField($model,'modified_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified_by'); ?>
		<?php echo $form->textField($model,'modified_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_delete'); ?>
		<?php echo $form->textField($model,'is_delete'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->