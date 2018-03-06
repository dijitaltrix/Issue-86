<?php
namespace Test\Child;

use Atlas\Orm\Mapper\AbstractMapper;

/**
 * @inheritdoc
 */
class ChildMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        // $this->manyToOne('parent', \Test\Parent\ParentMapper::CLASS);
    }
}
