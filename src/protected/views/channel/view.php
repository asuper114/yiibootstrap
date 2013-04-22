<?php
/* @var $this ChannelController */
/* @var $model Channel */

$this->breadcrumbs=array(
	'Channels'=>array('index'),
	$model->channel_id,
);

$this->menu=array(
	array('label'=>'List Channel', 'url'=>array('index')),
	array('label'=>'Create Channel', 'url'=>array('create')),
	array('label'=>'Update Channel', 'url'=>array('update', 'id'=>$model->channel_id)),
	array('label'=>'Delete Channel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->channel_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Channel', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('channel','View Channel')?> #<?php echo $model->channel_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'channel_id',
		'channel_name',
		'domain',
		'desc',
	),
)); ?>
