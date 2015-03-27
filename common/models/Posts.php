<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Posts extends ActiveRecord{

	public $tags_arr = [];

	public static function tableName(){
		return 'posts';
	}

	public function afterFind(){

		foreach($this->tags AS $tag){
			$this->tags_arr[] = $tag->tag->name; 
		}

		return parent::afterFind();
	}

	public function getTags(){
		return $this->hasMany(PostsTags::className(), ['id_post' => 'id']);
	}

	public function getCategories(){
		return $this->hasMany(PostsCategories::className(), ['id_post' => 'id']);
	}

}