<?php

declare(strict_types=1);

namespace common\helpers;

use app\dto\MenuDTO;

/**
 * Класс для рендиринга меню.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class MenuRenderHelper {

	/**
	 * @param MenuDTO[] $items
	 * @param int       $parentId
	 * @param int|null  $stopLevel
	 * @param int       $currentLevel
	 *
	 * @return int|void
	 */
	public static function render(array $items, int $parentId = 0, ?int $stopLevel = null, int $currentLevel = 0) {
		if (false === array_key_exists($parentId, $items)) {
			return;
		}

		echo '<ul>';

		foreach ($items[$parentId] as $item) {
			echo '<li>' . $item->name . ' ' . $item->alias . '</li>';

			// -- Если конечный уровень не задан, то проходим по всем вложенным меню.
			// -- Если текущий уровень меньше конечного, то продолжаем обход.
			if (null === $stopLevel || $currentLevel < $stopLevel) {
				$currentLevel++;
				$currentLevel = static::render($items, $item->id, $stopLevel, $currentLevel);
			}
			// -- -- --
		}

		echo '</ul>';

		$currentLevel--;

		return $currentLevel;
	}
}
