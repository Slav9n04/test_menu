<?php

declare(strict_types=1);

namespace app\connection;

/**
 * Класс подключения к PDO.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class Connection {

	/** @var \PDO */
	private $pdo;

	public function __construct() {
		try {
			$this->pdo = new \PDO(env('DB_CONNECTION') . ":host=" . env('DB_HOST') . ';port=' . env('DB_PORT') . ';dbname=' . env('DB_DATABASE'), env('DB_USER'), env('DB_PASSWORD'));
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
			$this->pdo->setAttribute(\PDO::ATTR_PERSISTENT, true);
			$this->pdo->query('SET NAMES utf8');
			$this->pdo->query('SET CHARACTER SET utf8');
		}
		catch (\PDOException $error) {
			echo $error->getMessage();
		}
	}

	/**
	 * @return \PDO
	 */
	public function getPdo(): \PDO {
		return $this->pdo;
	}
}
