<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>

    <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

<?php echo $form->errorSummary(array($model, $profile)); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php
        if($model->isNewRecord){
            echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20));
        }else{
           echo $model->username;
        }

        ?>
<?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 128)); ?>
<?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
<?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'superuser'); ?>
        <?php echo $form->dropDownList($model, 'superuser', User::itemAlias('AdminStatus')); ?>
<?php echo $form->error($model, 'superuser'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', User::itemAlias('UserStatus')); ?>
    <?php echo $form->error($model, 'status'); ?>
    </div>
    <?php
    $profileFields = $profile->getFields();
    if ($profileFields) {
        foreach ($profileFields as $field) {
            ?>
            <div class="row">
                <?php echo $form->labelEx($profile, $field->varname); ?>
                <?php
                if ($widgetEdit = $field->widgetEdit($profile)) {
                    echo $widgetEdit;
                } elseif ($field->range) {
                    echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                } elseif ($field->field_type == "TEXT") {
                    echo CHtml::activeTextArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                } else {
                    echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                }
                ?>
            <?php echo $form->error($profile, $field->varname); ?>
            </div>
            <?php
        }
    }
    ?>
    <style type="text/css">
label .labelForRadio{display:inline-block;width:auto;float:left;}
.checkboxList input[type="checkbox"]{display:inline-block;width:20px;cursor: auto;float:left;}
</style>
<!--
    <div class="row">
        <lable>选择渠道商</lable>
        <div class='checkboxList'><?php //echo Chtml::checkBoxList('channel_id','',  Channel::model()->loadItems(),array('template'=>'{input}{label}','separator'=>'','labelOptions'=>array('class'=>'labelForCheck')));?></div>
    </div>
-->

    <div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->