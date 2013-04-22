<?php
/* @var $this ChannelController */
/* @var $model Channel */

$this->breadcrumbs=array(
	'Channels'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Channel', 'url'=>array('index')),
	array('label'=>'Create Channel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#channel-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('channel','Manage Channels');?></h1>



<?php echo CHtml::link(Yii::t('channel','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'channel-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'channel_id',
		'channel_name',
		'domain',
		'desc',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
