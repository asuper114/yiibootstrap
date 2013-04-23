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

<h1><?php echo Yii::t('channel', 'Manage Channels'); ?></h1>



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
            <?php echo $form->label($model, 'username'); ?>
            <?php echo $form->textField($model, 'username'); ?>
        </div>
        <div clas="row5">
            <?php echo $form->label($model, 'pay_time'); ?>从
           <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'language'=>'zh_cn',
                'attribute' => 'startDate',
                'model' => $model,
                //'value' => '',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', //database save format  
                    //'altFormat'=>'mm-dd-yy' //display format  
                    'showAnim'=>'fold',  
                    //'yearRange'=>'-3:+3'   
                ), 'htmlOptions' => array(
                    'readonly' => 'readonly',
                ),
            ));
            ?>至
             <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'language'=>'zh_cn',
                'attribute' => 'endDate',
                'model' => $model,
                //'value' => '',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', //database save format  
                    //'altFormat'=>'mm-dd-yy' //display format  
                    'showAnim'=>'fold',  
                    //'yearRange'=>'-3:+3'   
                ), 'htmlOptions' => array(
                    'readonly' => 'readonly',
                ),
            ));
            ?>
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
            'name' => 'ordernum',
            'header' => '订单号',
            'type' => 'raw',
            'value' => '$data->ordernum',
        ),
        array(
            'name' => 'username',
            'header' => '用户名',
            'type' => 'raw',
            'value' => '$data->username',
        ),
        array(
            'name' => 'pay_time',
            'header' => '支付时间',
            'type' => 'raw',
            'value' => 'date("Y-m-d H:i:s",$data->pay_time)',
        ),
        array(
            'name' => 'pay_money',
            'header' => '金额(元)',
            'type' => 'raw',
            'value' => '$data->pay_money*0.01',
        ),
        
    ),
));
?>