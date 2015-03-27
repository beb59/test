<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

$menu = Array(
	'posts' => 'Посты',
	'tags' => 'Теги',
	'categories' => 'Категории',
);

AppAsset::register($this);
?>
<?=$this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
    <?=$this->head()?>
	<?=$this->context->viewAssetsCss()?>
</head>
<body>
    <?=$this->beginBody()?>
    <div class="wrap">
        <?
            NavBar::begin([
                'brandLabel' => '',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if(Yii::$app->user->isGuest){
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            }
			else{
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

		<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<?
					foreach($menu AS $k => $m){
					?>
						<li class="<?=(Yii::$app->controller->id == $k ? 'active' : '')?>">
							<a href="/<?=$k?>"><?=$m?></a>
						</li>
					<?
					}
					?>
				</ul>
			</div></div></div>	
        <div class="container" style="padding-left: 180px; padding-right: 0; width: 1290px;">
			<?=Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			])?>
			<?=$content?>
        </div>
    </div>

    <?=$this->endBody()?>

<?=$this->context->viewAssetsJs()?>
<?=$this->context->get_modal_windows()?>
</body>
</html>
<?=$this->endPage()?>
