<?php
/* @var $this ContactUsController */
/* @var $model ContactUs */

$this->breadcrumbs=array(
	'Contact Uses'=>array('index'),
	$model->contact_id,
);

$this->menu=array(
	array('label'=>'List ContactUs', 'url'=>array('index')),
	array('label'=>'Create ContactUs', 'url'=>array('create')),
	array('label'=>'Update ContactUs', 'url'=>array('update', 'id'=>$model->contact_id)),
	array('label'=>'Delete ContactUs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->contact_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContactUs', 'url'=>array('admin')),
);
?>

<h1>View ContactUs #<?php echo $model->contact_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'contact_id',
		'contact_name',
		'contact_email',
		'contact_phone',
		'contact_message',
	),
)); ?>
