<?php

declare(strict_types=1);

namespace frontend\forms;

use app\dto\MenuDTO;
use app\repositories\MenuRepositoryInterface;
use common\exceptions\ValidationException;
use yii\base\Model;
use yii\validators\NumberValidator;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

/**
 * Форма создания элемента меню.
 *
 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
 */
class CreateItemForm extends Model {

	/** @var string Название. */
	public $name;
	const ATTR_NAME = 'name';

	/** @var string Алиас. */
	public $alias;
	const ATTR_ALIAS = 'alias';

	/** @var string Родительская категория. */
	public $parent_id;
	const ATTR_PARENT_ID = 'parent_id';

	/** @var MenuRepositoryInterface */
	private $repository;

	/**
	 * @param MenuRepositoryInterface $repository
	 * @param array                   $config
	 */
	public function __construct(MenuRepositoryInterface $repository, $config = []) {
		parent::__construct($config);

		$this->repository = $repository;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return array
	 *
	 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
	 */
	public function rules(): array {
		return [
			[static::ATTR_NAME, RequiredValidator::class],
			[static::ATTR_NAME, StringValidator::class],
			[static::ATTR_ALIAS, RequiredValidator::class],
			[static::ATTR_ALIAS, StringValidator::class],
			[static::ATTR_PARENT_ID, RequiredValidator::class],
			[static::ATTR_PARENT_ID, NumberValidator::class],

		];
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return array
	 *
	 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
	 */
	public function attributeLabels(): array {
		return [
			static::ATTR_NAME      => 'Название',
			static::ATTR_ALIAS     => 'Алиас',
			static::ATTR_PARENT_ID => 'Родительский элемент',
		];
	}

	/**
	 * Сохранить форму.
	 *
	 * @throws ValidationException
	 *
	 * @author Svyatoslav Khazinurov <slav9n04@gmail.com>
	 */
	public function save() {
		if (false === $this->validate()) {
			throw new ValidationException($this);
		}

		$menuDTO            = new MenuDTO();
		$menuDTO->name      = $this->name;
		$menuDTO->parent_id = $this->parent_id;
		$menuDTO->alias     = $this->alias;

		$this->repository->save($menuDTO);
	}
}
