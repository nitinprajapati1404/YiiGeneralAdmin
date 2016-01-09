<?php
/* @var $this UserMasterController */
/* @var $model UserMaster */

$this->breadcrumbs=array(
	'User Masters'=>array('index'),
	$model->u_id,
);

$this->menu=array(
	array('label'=>'List UserMaster', 'url'=>array('index')),
	array('label'=>'Create UserMaster', 'url'=>array('create')),
	array('label'=>'Update UserMaster', 'url'=>array('update', 'id'=>$model->u_id)),
	array('label'=>'Delete UserMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->u_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserMaster', 'url'=>array('admin')),
);
?>

<h1>View UserMaster #<?php echo $model->u_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'u_id',
		'ur_id',
		'user_name',
		'user_pass',
		'first_name',
		'last_name',
		'user_image',
		'created_by',
		'created_on',
		'modified_by',
		'modified_on',
		'is_active',
		'is_delete',
	),
)); ?>
