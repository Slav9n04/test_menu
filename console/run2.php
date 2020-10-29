<?php

declare(strict_types=1);

use app\Cli;
use app\connection\Connection;
use app\Parser;
use app\repositories\MenuPDORepository;

require __DIR__ . '/../vendor/autoload.php';

$params     = [];
$menus      = [];
$repository = new MenuPDORepository(new Connection());

// -- Парсим переданные агрументы, чтобы иметь возможность обращаться к параметру по имени.
$cli    = new Cli($argv);
$params = $cli->getParams();
// -- -- --

if (false === array_key_exists('fileName', $params)) {
	die('Необходимо передать имя файла в формате json' . PHP_EOL);
}

$path   = __DIR__ . '/../data/' . $params['fileName'];
$parser = new Parser();

try {
	$menus = $parser->parse($path);

	// Удаляем все записи, если передана такая опция.
	if (array_key_exists('beforeDeleteAll', $params) && 'true' === $params['beforeDeleteAll']) {
		if (false === $repository->deleteAll()) {
			echo 'Произошли ошибки при удалении';
		}
	}

	if (false === $repository->saveAll($menus)) {
		echo 'Произошли ошибки при сохранение';
	}
}
catch (Throwable $e) {
	die($e->getMessage() . PHP_EOL);
}

