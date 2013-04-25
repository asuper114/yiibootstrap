<?php
/* @var $this ChannelController */
/* @var $model Channel */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'type' => 'horizontal',
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>

    <div class="control-group">
<?php echo $form->textFieldRow($model, 'channel_id'); ?>
    </div>

    <div class="control-group">
<?php echo $form->textFieldRow($model, 'channel_name', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="control-group">
<?php echo $form->textFieldRow($model, 'domain', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="control-group">
<?php echo $form->textFieldRow($model, 'desc', array('size' => 60, 'maxlength' => 256)); ?>
    </div>

    <div class="control-group buttons">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => '搜索',
            'type' => 'primary',
            'size' => 'large'
        ));
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->