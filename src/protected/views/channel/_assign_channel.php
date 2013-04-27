<td colspan="3">
    <div id="channel" class="row-fluid">
        <div class="span5">
            <?php
            echo CHtml::activeDropDownList($model, 'channel_id[revoke]', CHtml::listData(
                            $data['userAssignedChannel'], 'channel_id', 'channel_name'), array('size' => $data['listBoxNumberOfLines'], 'style' => '', 'multiple' => 'multiple', 'class' => 'dropdown'))
            ?>
        </div>
        <div class="span2  text-center" style="height:472px;margin-top: 200px;">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'ajaxSubmit',
                'label' => '左移',
                'size' => 'large',
                'disabled'=>$data['assign'],
                //'active'=>true,
                'url' => array('channel/AssignChannel','assignChannel'=>1),
                'htmlOptions'=>array('live'=>false),
                'ajaxOptions' => array(
                    'type' => 'POST',
                    'update'=>'#channel',
                    ),
            ));
            ?>
            <br/>
            <?php

            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => '右移',
                'disabled'=>$data['revoke'],
                'url' => array('/channel/AssignChannel','revokeChannel'=>1),
                'buttonType' => 'ajaxSubmit',
                'size' => 'large',
               'htmlOptions'=>array('live'=>false),
                'ajaxOptions' => array(
                    'type' => 'POST',
                    'update'=>'#channel',
                    ),
             ));
            ?>

        </div>

        <div class="span5">
            <?php
            echo CHtml::activeDropDownList($model, 'channel_id[assign]', CHtml::listData(
                            $data['userNoAssignedChannel'], 'channel_id', 'channel_name'), array('size' => $data['listBoxNumberOfLines'], 'style' => '', 'multiple' => 'multiple', 'class' => 'dropdown'))
            ?>
        </div>
    </div>
</td>