<?

namespace frontend\components;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\assets\AppAsset;
use yii\web\View;

class SecurityFilter extends \yii\base\Component{

	public static function filter($controller, $action){

		$user_roles = Array('guest');

		// get user role
		if(Yii::$app->user->id){
			$user_roles[] = 'user';
		}

		$roles_find = Array();

		foreach($user_roles AS $role){
			$roles_find[] = 'FIND_IN_SET("'.$role.'", roles)';
		}

		$q = \frontend\models\SecurityFilter::find()
				->where('
					controller = "'.$controller.'"
					AND (action = "'.$action.'" OR action = "*") 
					AND (
						'.implode(' OR ', $roles_find).'
					)'
				)
				->one();

		if(isset($q->id)){
			return true;
		}

	}

	public static function closed(){
		Yii::app()->controller->render('/main/close_page');
		exit;
	}
}
?>