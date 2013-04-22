<?php
/* @var $this ChannelController */
/* @var $model Channel */

$this->breadcrumbs=array(
	'Channels'=>array('index'),
	$model->channel_id=>array('view','id'=>$model->channel_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Channel', 'url'=>array('index')),
	array('label'=>'Create Channel', 'url'=>array('create')),
	array('label'=>'View Channel', 'url'=>array('view', 'id'=>$model->channel_id)),
	array('label'=>'Manage Channel', 'url'=>array('admin')),
);
?>

<h1>Update Channel <?php echo $model->channel_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>