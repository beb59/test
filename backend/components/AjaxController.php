<?php
namespace backend\components;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\LoginForm;
use yii\filters\VerbFilter;
use backend\assets\AppAsset;
use yii\web\View;
/**
 * Site controller
 */

class AjaxController extends BaseController{

	public function init(){

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest'){
			#die('Page not found');
		}

		header('Content-type: text/json');
		header('Content-type: application/json');

		return parent::init();
	}

}
