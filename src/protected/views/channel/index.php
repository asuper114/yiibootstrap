<?php
/* @var $this ChannelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Channels',
);

$this->menu=array(
	array('label'=>'Create Channel', 'url'=>array('create')),
	array('label'=>'Manage Channel', 'url'=>array('admin')),
);
?>

<h1>Channels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
