<?
namespace backend\controllers\ajax;

use Yii;
use yii\web\Controller;
use backend\models\Admin;

class PostsController extends \backend\components\AjaxController{
	
	public function actionList(){

		$DATA = $this->strip_tags_array($_POST);

		$offset = 0;

		if($DATA['offset'] > 0){
			$offset = $DATA['offset'];
		}

		$data = \common\models\Posts::find()
			//->where(['status' => Customer::STATUS_ACTIVE])
			->orderBy('id DESC')
			->limit(30)
			->offset($offset)
			->all();

		$html = $this->renderPartial('/posts/ajax/list', Array('arr_data' => $data), true);

		echo json_encode(Array('html' => $html));

	}

	public function actionForm(){

		$DATA = $this->strip_tags_array($_POST);

		if(isset($DATA['id']) && $DATA['id'] > 0){
			$data = \common\models\Posts::find()
				->where('id = '.$DATA['id'])
				->one();
		}
		else{
			$data = [];
		}

		$html = $this->renderPartial(
			'/posts/ajax/form',
			Array(
				'data' => $data,
				//'access' => $access
			),
		true);

		echo json_encode(Array('html' => $html));

	}

	public function actionSave(){

		$DATA = $this->strip_tags_array($_POST);
		$ERROR = Array();
		$html = '';

		if(intval($DATA['id'])){
			$model = \common\models\Posts::findOne($DATA['id']);
		}
		else{
			$model = new \common\models\Posts();
		}

		foreach($DATA['data'] AS $k => $e){
			$model->$k = $e;
		}

		$model->description = $_POST['data']['description'];
		$model->save();

		if($model_errors = $model->getErrors()){
			foreach($model_errors AS $k => $er){
				if(isset($er[0])){
					$ERROR[$k] = $er[0];
				}
			}
		}
		else{
			$tags = explode(',', $DATA['tags']);

			foreach($tags AS $t){
				
				$t = trim($t);

				$tag = \common\models\Tags::find()
					->where('name LIKE "'.$t.'"')
					->one();

				if(!$tag){
					$tag = new \common\models\Tags();
					$tag->name = $t;
					$tag->save();
				}

				$post_tag = new \common\models\PostsTags;
				$post_tag->id_post = $model->id;
				$post_tag->id_tag = $tag->id;
				$post_tag->save();

			}
		}

		echo json_encode(Array('error' => $ERROR));

	}

}