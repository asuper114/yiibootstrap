<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Kxvad extends KxvCActiveRecord {

    private static $_items = array();
    public $total;

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
        return '{{ad}}';
    }

    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'member' => array(self::BELONGS_TO, 'KxvMember', array('code_id' => 'code_id'), 'order' => 'total DESC',),
        );
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('web', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() {
        return array(
            'web' => "选择渠道商",
        );
    }

    /*
      public function defaultScope() {

      return CMap::mergeArray(array(), array(
      'alias' => 'ad',
      'select' => 'ad.id, ad.web, ad.code_id',
      ));
     * 

      } */

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->select = 'ad.id,ad.web,ad.jq_file_url,ad.code_id,count(member.id) as total';
        $criteria->alias = 'ad';
        //$criteria->joinType = 'lef join';
        $criteria->with = 'member'; //调用relations   
        $criteria->group = 'ad.id';
        
        $criteria->compare('web', $this->web, true);
        
        
        return new CActiveDataProvider(get_class($this), array(
                    'pagination' => array(
                        'pageSize' => 30, //设置每页显示20条
                    ),
                    /*
                      'sort' => array(
                      'defaultOrder' => 'id asc', //设置默认排序是create_time倒序
                      ), */
                    'criteria' => $criteria,
                ));
    }

}
