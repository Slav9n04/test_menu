<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Миграция для таблицы Menu.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class m201023_163000_create_menu_table extends Migration {

	private const TABLE = 'menu';

	/**
	 * {@inheritdoc}
	 *
	 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
	 */
	public function safeUp() {
		$this->createTable(self::TABLE,
			[
				'id'        => $this->integer()->comment('Идентификатор'),
				'parent_id' => $this->integer()->comment('Идентификатор родительской категории'),
				'name'      => $this->string()->comment('Название категории'),
				'alias'     => $this->string()->comment('Псевдоним для построения url'),
			],
		);

		$this->addPrimaryKey('pk_on_' . self::TABLE, self::TABLE, ['id']);
	}

	/**
	 * {@inheritdoc}
	 *
	 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
	 */
	public function safeDown() {
		$this->dropTable(self::TABLE);
	}
}
