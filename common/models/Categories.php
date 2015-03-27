<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Categories extends ActiveRecord{

	public static function tableName(){
		return 'categories';
	}

	public function getPosts(){
		return $this->hasMany(PostsCategories::className(), ['id_category' => 'id']);
	}

}