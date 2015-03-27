<?php
namespace frontend\components\OAuth2;

use Yii;
use yii\web\View;
/**
 * Site controller
 */

class Vkontakte extends \yii\base\Component{

	public function get_token($token){
		return json_decode($token);
	}

}
