<?php

use Phinx\Migration\AbstractMigration;

class TestInit extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('parents');
        $table->addColumn('customer_id', 'integer', ['default'=>0])
            ->addcolumn('date', 'date')
            ->addColumn('reference', 'string', ['limit'=>10])
            ->create();

        $table = $this->table('parent_children');
        $table->addColumn('parent_id', 'integer', ['default'=>0])
            ->addColumn('description', 'string', ['limit'=>255])
            ->addColumn('quantity', 'integer', ['default'=>1])
            ->addColumn('price', 'integer', ['default'=>0])
            ->create();

    }
}
