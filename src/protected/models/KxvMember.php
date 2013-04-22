<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KxvMember extends KxvCActiveRecord {

    private static $_items = array();

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

    /*
      public function defaultScope() {

      return CMap::mergeArray(array(), array(
      'alias' => 'ad',
      'select' => 'ad.id, ad.web, ad.code_id',
      ));
     * 

      } */

}
