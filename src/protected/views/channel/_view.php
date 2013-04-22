<?php
/* @var $this ChannelController */
/* @var $data Channel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->channel_id), array('view', 'id'=>$data->channel_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_name')); ?>:</b>
	<?php echo CHtml::encode($data->channel_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('domain')); ?>:</b>
	<?php echo CHtml::encode($data->domain); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />


</div>