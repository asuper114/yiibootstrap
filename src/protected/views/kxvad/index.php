<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
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
<?php echo CHtml::link(Yii::t('channel', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <div class="wide form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'action' => Yii::app()->createUrl($this->route),
            'method' => 'get',
                ));
        ?>

        <div class="row5">
            <?php echo $form->label($model, 'web'); ?>
            <?php echo $form->dropDownlist($model,'web',CHtml::listData(Channel::model()->findAll(),'channel_id','channel_name')); ?>
        </div>
       

        <div class = "row5 buttons">
            <?php echo CHtml::submitButton('Search');
            ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- search-form -->
</div><!-- search-form -->
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'channel-grid',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'columns' => array(
        array(
            'name' => 'id',
            'header' => '广告编号',
            'type' => 'raw',
            'value' => 'CHtml::link($data->id,$data->jq_file_url)',
        ),
        array(
            'name' => 'web',
            'header' => '渠道商',
            'type' => 'raw',
            'value' => 'Channel::model()->getItem($data->web)',
        ),
        array(
            'name' => 'total',
            'header' => '注册人数(个)',
            'type' => 'raw',
            'value' => 'CHtml::link($data->total,Yii::app()->createUrl("/Kxvad/member",array("code_id"=>$data->code_id)),array("class"=>"external_link"))',
        ),
        array(
            
            'header' => '充值总金额(元)',
            'type' => 'raw',
            'value' => 'KxvCharge::model()->getChargeTotal($data->code_id)',
        ),
        /*
        array(
            'header' => '操作',
            'class' => 'CButtonColumn',
            'headerHtmlOptions' => array('width' => '80',),
            'htmlOptions' => array('align' => 'center'),
            'template' => '{ad}',
            'buttons' => array(
                'ad' => array(
                    'label' => '广告',
                    //'imageUrl' => Yii::app()->request->baseUrl . '/images/icons/coins.png',
                    //'url' => 'Yii::app()->createUrl("member/recharge", array("id"=>$data->id))',
                ),
            ),
        ),
         */
    ),
));
?>
