<?php

declare(strict_types=1);

namespace frontend\controllers;

use app\dto\MenuDTO;
use app\repositories\MenuRepositoryInterface;
use common\helpers\ControllerAjaxResponseHelper;
use common\modules\menu\models\Menu;
use frontend\forms\CreateItemForm;
use yii\base\InvalidConfigException;
use yii\rest\ActiveController;
use yii\web\ServerErrorHttpException;

/**
 * Api controller
 */
class ApiController extends ActiveController {

	/** @var Menu */
	public $modelClass = Menu::class;

	/**
	 * Костыль конечно ((
	 *
	 * @return array
	 */
	public function actions()
	{
		$actions = parent::actions();

		unset($actions['index']);
		unset($actions['delete']);
		unset($actions['create']);

		return $actions;
	}

	/**
	 * @param MenuRepositoryInterface $repository
	 *
	 * @return MenuDTO[]
	 */
	public function actionIndex(MenuRepositoryInterface $repository): array {
		return $repository->findAll();
	}

	/**
	 * @param int                     $id
	 * @param MenuRepositoryInterface $repository
	 *
	 * @throws ServerErrorHttpException
	 */
	public function actionDelete(int $id, MenuRepositoryInterface $repository) {
		if (false === $repository->delete($id)) {
			throw new ServerErrorHttpException('Ошибки при удалении элемента');
		}
	}

	/**
	 * @throws ServerErrorHttpException
	 * @throws InvalidConfigException
	 *
	 * @return ControllerAjaxResponseHelper
	 */
	public function actionCreate(): ControllerAjaxResponseHelper {
		$form              = \Yii::createObject(CreateItemForm::class); /** @var CreateItemForm $form */
		$response          = new ControllerAjaxResponseHelper();
		$response->result  = true;

		if (false === $form->load(\Yii::$app->request->post(), '')) {
			$response->result  = false;
			$response->message = 'Некорректные данные';

			return $response;
		}

		try {
			$form->save();
		}
		catch (\Throwable $e) {
			$response->result  = false;
			// Так как задание тестовое, то выводим ошибку пользователю.
			// На проде, конечно, нужно подробную ошибку логировать, а пользователю выдавать юзерфрендли-сообщение.
			$response->message = $e->getMessage();
		}

		return $response;
	}
}
