<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePages extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this
            ->table('pages', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'string')
            ->addColumn('html', 'text')
            ->addColumn('screenshot', 'string')
            ->addColumn('created', 'datetime')
            ->create();
    }
}
