<?php
/* @var $this FaceImageMasterController */
/* @var $data FaceImageMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fim_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fim_id), array('view', 'id'=>$data->fim_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fm_id')); ?>:</b>
	<?php echo CHtml::encode($data->fm_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tracer_id')); ?>:</b>
	<?php echo CHtml::encode($data->tracer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />


</div>