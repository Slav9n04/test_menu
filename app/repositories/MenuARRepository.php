<?php

declare(strict_types=1);

namespace app\repositories;

use app\dto\MenuDTO;
use common\exceptions\ValidationException;
use common\modules\menu\models\Menu;

/**
 * Репозиторий для работы через ActiveRecord.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class MenuARRepository implements MenuRepositoryInterface {

	/**
	 * {@inheritdoc}
	 * @throws ValidationException
	 */
	public function save(MenuDTO $menuDTO) {
		$model            = new Menu();
		$model->name      = $menuDTO->name;
		$model->alias     = $menuDTO->alias;
		$model->parent_id = $menuDTO->parent_id;

		if (false === $model->save()) {
			throw new ValidationException($model);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function saveAll(array $menuDTO): bool {
		// TODO: Implement saveAll() method.
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAll(): array {
		$itemsDTO = [];
		$items    = Menu::find()
			->all();
		/** @var Menu[] $items */

		foreach ($items as $item) {
			$dto            = new MenuDTO();
			$dto->id        = $item->id;
			$dto->parent_id = $item->parent_id;
			$dto->name      = $item->name;
			$dto->alias     = $item->alias;

			$itemsDTO[] = $dto;
		}

		return $itemsDTO;
	}

	/**
	 * {@inheritdoc}
	 */
	public function delete(int $id): bool {
		$rows = Menu::deleteAll([Menu::ATTR_ID => $id]);

		return (0 !== $rows);
	}

	/**
	 * @inheritDoc
	 */
	public function deleteAll(): bool {
		// TODO: Implement deleteAll() method.
	}

	/**
	 * @inheritDoc
	 */
	public function findAllAndGroupByParent(): array {
		$items    = $this->findAll();
		$newItems = [];

		foreach ($items as $item) {
			$newItems[$item->parent_id][] = $item;
		}

		return $newItems;
	}
}
