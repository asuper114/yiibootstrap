<?php
/*
 * for connection the other db 
 */

class KxvCActiveRecord extends CActiveRecord
{
	public function getDbConnection()
	{
		if(self::$db!==null)
			return self::$db;
		else
		{
			self::$db=Yii::app()->getComponent('db_kxv');
			if(self::$db instanceof CDbConnection)
				return self::$db;
			else
				throw new CDbException(Yii::t('yii','Active Record requires a "db_kxv" CDbConnection application component.'));
		}
	}
	
}