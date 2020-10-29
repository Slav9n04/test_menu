<?php

declare(strict_types=1);

namespace app;

/**
 * Базовый класс для работы с консолью.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class Cli {

	/** @var array Параметры из команды */
	private $params = [];

	/**
	 * Cli constructor.
	 *
	 * @param array $argv Параметры из команды.
	 *
	 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
	 */
	public function __construct(array $argv) {
		foreach ($argv as $argument) {
			preg_match('/^-(.+)=(.+)$/', $argument, $matches);

			if (false === empty($matches)) {
				$name                = $matches[1];
				$value               = $matches[2];
				$this->params[$name] = $value;
			}
		}
	}

	/**
	 * Получить поименованные параметры.
	 *
	 * @return array
	 *
	 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
	 */
	public function getParams(): array {
		return $this->params;
	}
}
