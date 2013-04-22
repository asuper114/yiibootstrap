<?php
/* @var $this ChannelController */
/* @var $model Channel */

$this->breadcrumbs=array(
	'Channels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Channel', 'url'=>array('index')),
	array('label'=>'Manage Channel', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('channel','Create Channel');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>