<?php
/*
 * for connection the other db 
 */

class MyCActiveRecord extends CActiveRecord
{
	public function getDbConnection()
	{
            return self::$db=Yii::app()->getComponent('db');
            
		if(self::$db!==null)
			return self::$db;
		else
		{
			self::$db=Yii::app()->getComponent('db');
			if(self::$db instanceof CDbConnection)
				return self::$db;
			else
				throw new CDbException(Yii::t('yii','Active Record requires a "db_kxv" CDbConnection application component.'));
		}
	}
	
}