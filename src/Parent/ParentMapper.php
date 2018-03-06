<?php
namespace Test\Parent;

use Atlas\Orm\Mapper\AbstractMapper;

/**
 * @inheritdoc
 */
class ParentMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('children', \Test\Child\ChildMapper::class)->on([
            'id' => 'parent_id'
        ]);
    }
}
