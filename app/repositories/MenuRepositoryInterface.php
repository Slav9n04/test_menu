<?php

declare(strict_types=1);

namespace app\repositories;

use app\dto\MenuDTO;

/**
 * Интерфейс для репозитория элементов меню.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
interface MenuRepositoryInterface {

	/**
	 * @param MenuDTO $menuDTO
	 */
	public function save(MenuDTO $menuDTO);

	/**
	 * @param MenuDTO[] $menuDTO
	 *
	 * @return bool
	 */
	public function saveAll(array $menuDTO) :bool;

	/**
	 * Получить все записи.
	 *
	 * @return MenuDTO[]
	 */
	public function findAll(): array;

	/**
	 * Получить все записи с гурппированные по родительской категории.
	 *
	 * @return MenuDTO[][]
	 */
	public function findAllAndGroupByParent(): array;

	/**
	 * Удалить элемент по идентификатору.
	 *
	 * @param int $id
	 *
	 * @return bool
	 */
	public function delete(int $id): bool;

	/**
	 * Удалить все записи.
	 *
	 * @return bool
	 */
	public function deleteAll(): bool;
}
