<?php
/* @var $this CmsManagementController */
/* @var $model CmsManagement */

$this->breadcrumbs=array(
	'Cms Managements'=>array('index'),
	$model->cms_id,
);

$this->menu=array(
	array('label'=>'List CmsManagement', 'url'=>array('index')),
	array('label'=>'Create CmsManagement', 'url'=>array('create')),
	array('label'=>'Update CmsManagement', 'url'=>array('update', 'id'=>$model->cms_id)),
	array('label'=>'Delete CmsManagement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cms_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CmsManagement', 'url'=>array('admin')),
);
?>

<h1>View CmsManagement #<?php echo $model->cms_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cms_id',
		'cms_page_alias',
		'cms_page_title',
		'cms_page_content',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'is_active',
		'is_delete',
	),
)); ?>
