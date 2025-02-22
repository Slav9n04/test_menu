<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="app">
  <div class="wrap">
	  <?php
	  NavBar::begin([
		  'brandLabel' => Yii::$app->name,
		  'brandUrl'   => Yii::$app->homeUrl,
		  'options'    => [
			  'class' => 'navbar-inverse navbar-fixed-top',
		  ],
	  ]);

	  NavBar::end();
	  ?>

    <div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>

      <div>
        <a class="btn btn-default" href="/">Все меню</a>
        <a class="btn btn-default" href="<?= Url::toRoute(['/site/top/']) ?>">Первый уровень меню</a>
        <a class="btn btn-default" href="<?= Url::toRoute(['/site/crud/']) ?>">CRUD</a>
      </div>
      <br>
		<?= $content ?>
    </div>
  </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
