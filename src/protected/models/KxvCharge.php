<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KxvCharge extends KxvCActiveRecord {

    private static $_items = array();
    public $total;
    public $startDate;
    public $endDate;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Channel the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{payment_account}}';
    }
    public function scopes()
    {
        return array(
            'published'=>array(
                'condition'=>'pay_status=1',
            ),
        );
    }
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username,startDate,endDate', 'safe', 'on' => 'search'),
        );
    }
     public function attributeLabels() {
        return array(
            'username' => "用户名",
            'pay_time' => "注册时间",
        );
    }

    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $members = array();
        if($code_id = Yii::app()->request->getQuery('code_id')){
            $members = KxvMember::model()->getMembers($code_id,$this->username);
        }

        $criteria = new CDbCriteria;
        $criteria->addCondition("pay_status=1");
        $criteria->addInCondition('user_id', $members);
        if (!empty($this->startDate)) {

            $criteria->addCondition("FROM_UNIXTIME(pay_time,'%Y-%m-%d') >= '" . $this->startDate . "'");
        }
        if (!empty($this->endDate)) {
            $criteria->addCondition("FROM_UNIXTIME(pay_time,'%Y-%m-%d') <= '" . $this->endDate . "'");
        }

        return new CActiveDataProvider(get_class($this), array(
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
                    'sort' => array(
                        'defaultOrder' => 'id desc', //设置默认排序是create_time倒序
                    ),
                    'criteria' => $criteria,
                ));
    }
    public function getChargeTotal($code_id,$username=NULL){

        $members = KxvMember::model()->getMembers($code_id);

        $criteria=new CDbCriteria();
        $criteria->select = 'sum(pay_money)*0.01 as total';
        $criteria->addCondition("pay_status=1");
        $criteria->addInCondition('user_id', $members);


        $charge = self::model()->find($criteria);


        return  !empty($charge->total) ? CHtml::link($charge->total,Yii::app()->createUrl("/Kxvad/charge",array("code_id"=>$code_id)),array("class"=>"external_link")):"";

       // return isset($charge->total)?$charge->total:0;
        //print_r($a);exit;
    }

    public function getChargeById($user_id){
        $criteria=new CDbCriteria();
        $criteria->select = 'sum(pay_money)*0.01 as total';
        $criteria->compare("user_id",$user_id);
        $criteria->order = 'pay_money desc';
        $charge = self::model()->published()->find($criteria);
        return !empty($charge->total) ? $charge->total : 0;
       //->with(array('select'=>'sum(pay_money)*0.01 as total'))
    }

}
