<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class PostsCategories extends ActiveRecord{

	public static function tableName(){
		return 'posts_categories';
	}

}