<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!--
<div class="row-fluid">
    <div class="span3">
        <h2 class="text-center">用户列表</h>
        
    </div>
    <div class="span3">
        <h2 class="text-center">已分配的渠道商</h>
    </div>
    <div class="span3">
        <h2 class="text-center">未分配的渠道商</h>
    </div>

</div>
-->
<div class="row-fluid">
<?php echo CHtml::beginForm(); ?>
    <table class="table ">  
        <caption>渠道商分配</caption>
        <thead>
            <tr>
                <th style="text-align: center;" >用户列表</th>
                <th style="text-align: center;">已分配</th>
                <th width="30">...</th>
                <th style="text-align: center;">未分配</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                
                <?php echo CHtml::errorSummary($model); ?>
                <td>

                    <?php
                    $criteria = new CDbCriteria();
                    $criteria->order = Yii::app()->getModule('srbac')->username;
                    $array_user = CHtml::listData(Yii::app()->getModule('srbac')->getUserModel()->findAll($criteria), Yii::app()->getModule('srbac')->userid, Yii::app()->getModule('srbac')->username);

                    echo CHtml::activeDropDownList(Yii::app()->getModule('srbac')->getUserModel(), Yii::app()->getModule('srbac')->userid, $array_user, array('size' => $data['listBoxNumberOfLines'],'style'=>'', 'class' => 'dropdown', 'ajax' => array(
                    'type' => 'POST',
                    'url' => array('getChannel'),
                    'data' => new CJavaScriptExpression('jQuery(this).serialize()'),
                    'update' => '#channel',
                    'beforeSend' => 'function(){
                      $("#loadMess").addClass("srbacLoading");
                  }',
                    'complete' => 'function(){
                      $("#loadMess").removeClass("srbacLoading");
                  }'
                    ),
                    ) );
                    ?>
                </td>
                <?php
                $this->renderPartial(
                       '//channel/_assign_channel', array('model' => $model, 'data' => $data)
                );
                ?>
               
            </tr>


        </tbody>
    </table> 
     <?php //echo CHtml::endForm(); ?>
</div>