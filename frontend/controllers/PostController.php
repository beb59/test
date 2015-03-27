<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class PostController extends \frontend\components\BaseController{

	public function actionView($id){

		if(!$post = \common\models\Posts::findOne($id)){
			echo 'Нерабочая ссылка';
			exit;
		}

		return $this->render('index', ['post' => $post]);
	}

}

?>