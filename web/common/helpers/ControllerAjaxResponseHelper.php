<?php

declare(strict_types=1);

namespace common\helpers;

/**
 * Класс для описания результата выполнения AJAX-запроса
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class ControllerAjaxResponseHelper {

	/** @var bool Успешен ли результат выполнения. */
	public $result = false;

	/** @var string Результат в виде HTML. */
	public $html = '';

	/** @var mixed Возвращаемые данные. */
	public $data;

	/** @var string Сообщение для пользователя. */
	public $message = '';

	/** @var string[] Список возникших ошибок. */
	public $errors = [];
}
