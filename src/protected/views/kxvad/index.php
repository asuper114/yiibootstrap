<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'channel-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'id',
            'header'=>'广告编号',
            'type' => 'raw',
            'value' => '$data->id',
        ),
        array(
            'name' => 'web',
            'header'=>'渠道商',
            'type' => 'raw',
            'value' => '$data->web',
        ),
        array(
            'name' => 'total',
            'header'=>'注册人数',
            'type' => 'raw',
            'value' => '$data->total',
        ),
    ),
));
?>
