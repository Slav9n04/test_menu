<?php

declare(strict_types=1);

namespace common\exceptions;

use yii\base\Exception;
use yii\base\Model;
use yii\db\ActiveRecordInterface;

/**
 * Исключение, когда модель не прошла валидацию.
 */
class ValidationException extends Exception {

	/**
	 * @param Model|ActiveRecordInterface $model      Модель, которая не прошла валидацию
	 * @param mixed|null                  $extendData Дополнительные данные для логгирования
	 */
	public function __construct($model, $extendData = null) {
		$message = [];

		$message[] = 'Ошибка валидации модели ' . get_class($model) . ':';

		foreach ($model->getErrors() as $attribute => $errors) {
			$message[] = 'Атрибут: ' . $attribute;
			if (in_array($attribute, $model->attributes())) {
				$message[] = 'Значение: ' . var_export($model->$attribute, true);
			}
			$message[] = 'Ошибки:';
			foreach ($errors as $i => $error) {
				$message[] = ($i + 1) . '. ' . $error;
			}
			$message[] = null;
			$message[] = '- - - - -';
			$message[] = null;
		}

		if (null !== $extendData) {
			$message[] = var_export($extendData, true);
		}

		$message = implode(PHP_EOL, $message);

		parent::__construct($message);
	}
}
