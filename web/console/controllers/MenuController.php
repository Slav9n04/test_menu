<?php

declare(strict_types=1);

namespace console\controllers;

use app\repositories\MenuRepositoryInterface;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Контроллер для вывода меню в консоль.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class MenuController extends Controller {

	/**
	 * @param MenuRepositoryInterface $repository
	 */
	public function actionAll(MenuRepositoryInterface $repository) {
		$items = $repository->findAll();

		foreach ($items as $item) {
			$this->stdout($item->name . PHP_EOL, Console::FG_GREEN);
		}
	}
}
