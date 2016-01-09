<?php
/* @var $this CmsManagementController */
/* @var $model CmsManagement */

$this->breadcrumbs=array(
	'Cms Managements'=>array('index'),
	$model->cms_id=>array('view','id'=>$model->cms_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CmsManagement', 'url'=>array('index')),
	array('label'=>'Create CmsManagement', 'url'=>array('create')),
	array('label'=>'View CmsManagement', 'url'=>array('view', 'id'=>$model->cms_id)),
	array('label'=>'Manage CmsManagement', 'url'=>array('admin')),
);
?>

<h1>Update CmsManagement <?php // echo $model->cms_id; ?></h1>

<?php 

//$xmppPrebind = new XmppPrebind('your-jabber-host.tld', 'http://your-jabber-host/http-bind/', 'Your XMPP Clients resource name', false, false);
//$xmppPrebind->connect($username, $password);
//$xmppPrebind->auth();
//$sessionInfo = $xmppPrebind->getSessionInfo(); // array containing sid, rid and jid
//App::pr($sessionInfo,2);

//If you use Candy, change the Candy.Core.Connect() line to the following: 

$this->renderPartial('_form', array('model'=>$model)); ?>