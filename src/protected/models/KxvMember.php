<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KxvMember extends KxvCActiveRecord {

    private static $_items = array();
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
        return '{{members}}';
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
            'regdate' => "注册时间",
        );
    }

    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('code_id', Yii::app()->request->getQuery('code_id'));
        $criteria->compare('username', $this->username, true);
        if (!empty($this->startDate)) {
            $criteria->addCondition("FROM_UNIXTIME(regdate,'%Y-%m-%d') >= '" . $this->startDate . "'");
        }
        if (!empty($this->endDate)) {
            $criteria->addCondition("FROM_UNIXTIME(regdate,'%Y-%m-%d') <= ' " . $this->endDate . "'");
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

    public function getMembers($code_id, $username = NULL) {
        $criteria = new CDbCriteria();
        if(!empty($username)){
            $criteria->addCondition("username='".$username."'");
        }
        $criteria->addCondition("code_id='".$code_id."'");
        
        $members = self::model()->findAll($criteria);
        $tmp = array();
        foreach ($members as $key => $val) {
            $tmp[] = $val->id;
        }
        if (!empty($tmp)) {
            return $tmp;
        }
        return $tmp;
    }

}
