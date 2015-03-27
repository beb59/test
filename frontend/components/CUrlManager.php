<?php

namespace frontend\components;

use yii\web\UrlManager;
use frontend\models\Lang;

class CUrlManager extends UrlManager{

	public function parseRequest($request){

		#print_r($request);
		#exit;

		return parent::parseRequest($request);

	}

}
