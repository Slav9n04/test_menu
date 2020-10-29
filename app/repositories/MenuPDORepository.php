<?php

declare(strict_types=1);

namespace app\repositories;

use app\connection\Connection;
use app\dto\MenuDTO;
use PDO;

/**
 * Репозиторий для работы через PDO.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class MenuPDORepository implements MenuRepositoryInterface {

	/** @var PDO  */
	private $pdo;

	/**
	 * @param Connection $connection
	 */
	public function __construct(Connection $connection) {
		$this->pdo = $connection->getPdo();
	}

	/**
	 * @inheritDoc
	 */
	public function save(MenuDTO $menuDTO) {
		$sth = $this->pdo->prepare("INSERT INTO `menu` SET `id` = :id, `parent_id` = :parent_id, `name` = :name, `alias` = :alias");

		if (false === $sth->execute([
			'id'        => $menuDTO->id,
			'parent_id' => $menuDTO->parent_id,
			'name'      => $menuDTO->name,
			'alias'     => $menuDTO->alias,
		])) {
			throw new \PDOException('Не удалось сохранить элемент');
		}
	}

	/**
	 * @inheritDoc
	 */
	public function saveAll(array $menuDTO): bool {
		$pdoStatement = $this->pdo->prepare("INSERT INTO `menu` (`id`, `parent_id`, `name`, `alias`) VALUES (:id, :parent_id, :name, :alias)");

		try {
			$this->pdo->beginTransaction();

			foreach ($menuDTO as $dto) {
				$pdoStatement->bindValue('id', $dto->id);
				$pdoStatement->bindValue('parent_id', $dto->parent_id);
				$pdoStatement->bindValue('name', $dto->name);
				$pdoStatement->bindValue('alias', $dto->alias);

				$pdoStatement->execute();
			}

			$this->pdo->commit();

			return true;
		}
		catch (\Exception $e) {
			$this->pdo->rollback();

			return false;
		}
	}

	/**
	 * @inheritDoc
	 */
	public function delete(int $id): bool {
		// TODO: Implement delete() method.
	}

	/**
	 * @inheritDoc
	 */
	public function findAll(): array {
		// TODO: Implement findAll() method.
	}

	/**
	 * @inheritDoc
	 */
	public function deleteAll(): bool {
		$statement = $this->pdo->prepare('DELETE FROM `menu`');

		return $statement->execute();
	}

	/**
	 * @inheritDoc
	 */
	public function findAllAndGroupByParent(): array {
		// TODO: Implement findAllAndGroupByParent() method.
	}
}
