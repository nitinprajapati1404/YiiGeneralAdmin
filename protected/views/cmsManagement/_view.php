<?php
/* @var $this CmsManagementController */
/* @var $data CmsManagement */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cms_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cms_id), array('view', 'id'=>$data->cms_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cms_page_alias')); ?>:</b>
	<?php echo CHtml::encode($data->cms_page_alias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cms_page_title')); ?>:</b>
	<?php echo CHtml::encode($data->cms_page_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cms_page_content')); ?>:</b>
	<?php echo CHtml::encode($data->cms_page_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_on')); ?>:</b>
	<?php echo CHtml::encode($data->modified_on); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_delete')); ?>:</b>
	<?php echo CHtml::encode($data->is_delete); ?>
	<br />

	*/ ?>

</div>