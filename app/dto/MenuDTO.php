<?php

declare(strict_types=1);

namespace app\dto;

/**
 * DTO для таблицы Menu.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class MenuDTO {

	/** @var int */
	public $id;

	/** @var int */
	public $parent_id;

	/** @var string */
	public $name;

	/** @var string */
	public $alias;
}
