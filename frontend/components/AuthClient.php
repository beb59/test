<?php
namespace frontend\components;

use Yii;
use yii\web\View;
use \frontend\components\OAuth2;
use linslin\yii2\curl;

/**
 * Site controller
 */

class AuthClient extends \yii\base\Component{

	public $clients = '';
	protected $client_settings = '';
	public $current_client = '';
	public $client_class = '';
	public $user_data;
	protected $send_data = '';

	public function set_client($client){

		$this->current_client = $client;
		$this->client_settings = $this->clients[$client];

		if($client == 'vkontakte'){
			$this->client_class = new \frontend\components\OAuth2\Vkontakte();
		}
		else if($client == 'facebook'){
			$this->client_class = new \frontend\components\OAuth2\Facebook();
		}

	}

	public function get_token(){

		$params = array(
			'client_id' => $this->client_settings['clientId'],
			'client_secret' => $this->client_settings['clientSecret'],
			'code' => $_GET['code'],
			'redirect_uri' => 'http://0social.ru/oauth/'.$this->current_client
		);

		$curl = new curl\Curl();
		$curl->setOption(CURLOPT_SSL_VERIFYPEER, 0);
		$curl->setOption(CURLOPT_SSL_VERIFYHOST, 0);

		$token = $curl->get($this->client_settings['get_token_url'].'?'.urldecode(http_build_query($params)));
		$token = $this->client_class->get_token($token);

		print_r($token);
		exit;

		return $token;
	}

	public function get_links(){
		return Yii::$app->controller->renderPartial('/oauth/links');
	}
	
	public function get_info($user, $token){

		$params = array(
            'uids' => $user,
            'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token
        );

        $info = json_decode(file_get_contents($this->client_settings['get_user_info'].'?'.urldecode(http_build_query($params))), true);

		return $info;

	}
}
