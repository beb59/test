<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class MainController extends \frontend\components\BaseController{

	public function actionError(){
		
	}

	public function actionIndex($id = 0){

		if(!intval($id)){
			$posts = \common\models\Posts::find()
				->orderBy('created DESC')
				->all();
		}
		else{

			$posts = \common\models\Posts::find()
				->joinWith('categories', true, 'JOIN')
				->where('posts_categories.id_category = '.$id)
				->orderBy('created DESC')
				->all();

			#$posts
		}

		return $this->render('index', ['posts' => $posts]);
	}

}

?>