<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class PostsTags extends ActiveRecord{

	public static function tableName(){
		return 'posts_tags';
	}

	public function getTag(){
		return $this->hasOne(Tags::className(), ['id' => 'id_tag']);
	}

}