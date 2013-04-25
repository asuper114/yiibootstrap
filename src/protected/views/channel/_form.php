<?php
/* @var $this ChannelController */
/* @var $model Channel */
/* @var $form CActiveForm */
?>

<div class="form-horizontal">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'channel-form',
        'type'=>'horizontal',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'well'),
            ));
    ?>

    <p class="note">字段前为 <span class="required">*</span> 必须填写</p>

<?php echo $form->errorSummary($model); ?>

    <div class="control-group">

        
        
<?php echo $form->textFieldRow($model, 'channel_name', array('size' => 20, 'maxlength' => 20,'disabled'=>($this->action->id =='update' ? true:false))); ?>
    </div>

    <div class="control-group">
<?php echo $form->textFieldRow($model, 'domain', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="control-group">
<?php echo $form->textFieldRow($model, 'desc', array('size' => 60, 'maxlength' => 256)); ?>
    </div>

    <div class="control-group buttons">
<?php $this->widget('bootstrap.widgets.TbButton', array('type' => 'primary', 'buttonType' => 'submit', 'label' => $model->isNewRecord ? Yii::t('channel', 'Create') : Yii::t('channel', 'Save'))); ?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->