<?php
namespace frontend\components\OAuth2;

use Yii;
use yii\web\View;
/**
 * Site controller
 */

class Facebook extends \yii\base\Component{

	public function get_token($token){

		$token = explode('&', $token); 
		$token = explode('=', $token[0]);

		return [
			'access_token' => $token[1]
		];
	}

	public function find_user(){

		$user = \common\models\User::find()
			->where('social_code = '.$token->user_id)
			->one();

		return [];
	}

}
