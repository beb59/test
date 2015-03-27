<?php
namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class SecurityFilter extends ActiveRecord{

	public static function tableName(){
		return 'security_filter';
	}

}