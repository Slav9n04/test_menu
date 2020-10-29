<?php

declare(strict_types=1);

namespace common\modules\menu\models;

use yii\db\ActiveRecord;
use yii\validators\NumberValidator;
use yii\validators\StringValidator;
use yii\validators\UniqueValidator;

/**
 * This is the model class for table "menu".
 *
 * @property int         $id        Идентификатор
 * @property int|null    $parent_id Идентификатор родительской категории
 * @property string|null $name      Название категории
 * @property string|null $alias     Псевдоним для построения url
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class Menu extends ActiveRecord {

	const ATTR_ID        = 'id';
	const ATTR_PARENT_ID = 'parent_id';
	const ATTR_NAME      = 'name';
	const ATTR_ALIAS     = 'alias';

	/**
	 * {@inheritdoc}
	 */
	public static function tableName() {
		return 'menu';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			[[self::ATTR_ID, self::ATTR_PARENT_ID], NumberValidator::class],
			[[self::ATTR_NAME, self::ATTR_ALIAS],   StringValidator::class, 'max' => 255],
			[[self::ATTR_ID],                       UniqueValidator::class],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			self::ATTR_ID        => 'Идентификатор',
			self::ATTR_PARENT_ID => 'Идентификатор родительской категории',
			self::ATTR_NAME      => 'Название категории',
			self::ATTR_ALIAS     => 'Псевдоним для построения url',
		];
	}
}
