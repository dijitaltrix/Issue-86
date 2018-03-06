<?php
/**
 * This table class was generated by Atlas. Changes will be overwritten.
 */
namespace Test\Child;

use Atlas\Orm\Table\AbstractTable;

/**
 * @inheritdoc
 */
class ChildTable extends AbstractTable
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'parent_children';
    }

    /**
     * @inheritdoc
     */
    public function getColNames()
    {
        return [
            'id',
            'parent_id',
            'description',
            'quantity',
            'price',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getCols()
    {
        return [
            'id' => (object) [
                'name' => 'id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => true,
                'primary' => true,
            ],
            'parent_id' => (object) [
                'name' => 'parent_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => '0',
                'autoinc' => false,
                'primary' => false,
            ],
            'description' => (object) [
                'name' => 'description',
                'type' => 'varchar',
                'size' => 255,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
            'quantity' => (object) [
                'name' => 'quantity',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => '1',
                'autoinc' => false,
                'primary' => false,
            ],
            'price' => (object) [
                'name' => 'price',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => '0',
                'autoinc' => false,
                'primary' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryKey()
    {
        return [
            'id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAutoinc()
    {
        return 'id';
    }

    /**
     * @inheritdoc
     */
    public function getColDefaults()
    {
        return [
            'id' => null,
            'parent_id' => '0',
            'description' => null,
            'quantity' => '1',
            'price' => '0',
        ];
    }
}
