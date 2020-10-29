<?php

declare(strict_types=1);

use app\repositories\MenuARRepository;
use app\repositories\MenuRepositoryInterface;
use common\modules\menu\Menu;

return [
	'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
	'vendorPath' => dirname(dirname(__DIR__)) . '/../vendor',
	'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
	'modules' => [
	    'Menu' => [
		    'class' => Menu::class,
	    ],
    ],
	'container' => [
		'singletons' => [
			MenuRepositoryInterface::class => [
				'class' => MenuARRepository::class
			],

		],
	],
];
