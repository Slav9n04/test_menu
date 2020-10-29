<?php

declare(strict_types=1);

namespace frontend\controllers;

use app\repositories\MenuRepositoryInterface;
use yii\web\Controller;
use yii\web\ErrorAction;

/**
 * Site controller
 */
class SiteController extends Controller {

	/**
	 * {@inheritdoc}
	 */
	public function actions() {
		return [
			'error' => [
				'class' => ErrorAction::class,
			],
		];
	}

	/**
	 * Все меню.
	 *
	 * @param MenuRepositoryInterface $repository
	 *
	 * @return mixed
	 */
	public function actionIndex(MenuRepositoryInterface $repository) {
		$items  = $repository->findAllAndGroupByParent();

		return $this->render('index', [
			'items' => $items,
		]);
	}

	/**
	 * Меню первой вложенности.
	 *
	 * @param MenuRepositoryInterface $repository
	 *
	 * @return mixed
	 */
	public function actionTop(MenuRepositoryInterface $repository) {
		$items  = $repository->findAllAndGroupByParent();

		return $this->render('top', [
			'items' => $items,
		]);
	}

	/**
	 * @return string
	 */
	public function actionCrud() {
		return $this->render('crud');
	}

}
