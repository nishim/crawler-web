<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateJobs extends AbstractMigration
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
            ->table('jobs')
            ->addColumn('command', 'string')
            ->addColumn('parameters', 'string', [
                'null' => true,
            ])
            ->addColumn('status', 'string', [
                'default' => 'WAITING'
            ])
            ->addColumn('created', 'datetime')
            ->addColumn('executed', 'datetime', [
                'null' => true,
            ])
            ->create();
    }
}
