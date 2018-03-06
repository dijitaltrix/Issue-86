<?php
namespace Test\Child;

use Exception;
use Atlas\Orm\Mapper\MapperEvents;
use Atlas\Orm\Mapper\MapperInterface;
use Atlas\Orm\Mapper\RecordInterface;

/**
 * @inheritdoc
 */
class ChildMapperEvents extends MapperEvents
{
    public function beforeInsert(MapperInterface $mapper, RecordInterface $record)
    {
        // throw new Exception("Some error");
    }
}
