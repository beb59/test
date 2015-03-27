<?php
namespace backend\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Posts controller
 */
class PostsController extends \backend\components\BaseController{

	public function actionIndex(){

		$this->assetJs('/js/posts.js');
		$this->modal_window[] = 'posts/add';

		return $this->render('index');
	}

}
