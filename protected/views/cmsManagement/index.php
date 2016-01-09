<?php
/* @var $this CmsManagementController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cms Managements',
);

$this->menu=array(
	array('label'=>'Create CmsManagement', 'url'=>array('create')),
	array('label'=>'Manage CmsManagement', 'url'=>array('admin')),
);
?>

<h1>Cms Managements</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
