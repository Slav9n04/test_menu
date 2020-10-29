<?php

declare(strict_types=1);

namespace app;

use app\dto\MenuDTO;
use app\phpdoc\Categories;

/**
 * Парсер json в массив MenuDTO.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class Parser {

	/**
	 * @param string $path Путь до файла json с меню.
	 *
	 * @return MenuDTO[]
	 */
	public function parse(string $path): array {
		if (false === file_exists($path)) {
			throw new \InvalidArgumentException('Файл не найден');
		}

		$json = file_get_contents($path);

		if (false === $json) {
			throw new \InvalidArgumentException('Ошибка при парсинге json');
		}

		$categories = json_decode($json); /** @var Categories[] $categories */

		return $this->convertToDTO($categories);
	}

	/**
	 * @param Categories[] $categories
	 * @param int          $parentId
	 * @param array        $menus
	 *
	 * @return MenuDTO[]
	 */
	private function convertToDTO(array $categories, int $parentId = 0, array $menus = []): array {
		foreach ($categories as $item) {
			$menu            = new MenuDTO();
			$menu->id        = $item->id;
			$menu->parent_id = $parentId;
			$menu->name      = $item->name;
			$menu->alias     = $item->alias;

			$menus[] = $menu;

			if (isset($item->children) && is_array($item->children)) {
				$children = $this->convertToDTO($item->children, $item->id, $menus);

				$menus = array_merge($menus, $children);
			}
		}

		return $menus;
	}
}
