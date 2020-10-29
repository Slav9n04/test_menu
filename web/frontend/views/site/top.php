<?php

use app\dto\MenuDTO;
use common\helpers\MenuRenderHelper;

/* @var $this yii\web\View */
/* @var $items MenuDTO[] */

$this->title = 'Тестовое задание';
?>
<div class="site-index">
	<?php MenuRenderHelper::render($items, 0, 1) ?>
</div>
