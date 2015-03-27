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

class BaseController extends Controller{

	public $js = [];
	public $css = [];
	public $modal_window = [];

	public function init(){

		$this->enableCsrfValidation = false;
		$this->assetJs('/js/jquery-ui.js');
		$this->assetCss('/css/jquery-ui.min.css');

		return parent::init();
	}

	public function beforeAction($action){
		return parent::beforeAction($action);
	}
	
	public function assetJs($file){
		$this->js[] = $file;
	}

	public function viewAssetsJs(){
		
		$result = '';

		foreach($this->js AS $js){
			$result.= '<script src="'.$js.'"></script>
';
		}

		return $result;

	}

	public function assetCss($file){
		$this->css[] = $file;
	}

	public function viewAssetsCss(){
		
		$result = '';

		foreach($this->css AS $css){
			$result.= ' <link href="'.$css.'" rel="stylesheet">
';
		}

		return $result;

	}

	public function strip_tags_array($arr = Array()){

		$result = '';

		foreach($arr AS $key => $elem){
			if(is_array($elem)){
				$result[$key] = self::strip_tags_array($elem);
				continue;
			}

			$result[$key] = (!empty($elem) ? strip_tags($elem) : '');
		}

		return $result;
	}

	public function get_modal_windows(){

		$result = '';

		foreach($this->modal_window AS $modal){

			$data = [];

			if(is_array($modal)){
				$data = $modal[1];
				$modal = $modal[0];
			}

			$result.= $this->renderPartial('/modal_window/'.$modal, $data, true).'
';
		}

		return $result;

	}

	public function make_options_from_array($array = Array(), $selected = '0'){

		if(!count($array)){
			return false;
		}

		$result = '';

		foreach($array AS $key => $elem){
			$result.= '<option '.($selected == $key ? ' selected ' : '').' value="'.$key.'">'.$elem.'</option>';
		}

		return $result;

	}

}
