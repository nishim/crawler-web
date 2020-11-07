<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateConsoleLogs extends AbstractMigration
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
            ->table('console_logs')
            ->addColumn('page_id', 'string')
            ->addColumn('level', 'string')
            ->addColumn('message', 'string')
            ->addColumn('line_number', 'integer', [
                'null' => true
            ])
            ->addColumn('column_number', 'integer', [
                'null' => true
            ])
            ->addColumn('created', 'datetime')
            ->addForeignKey(['page_id'], 'pages', 'id', [
                'update' => 'NO_ACTION',
                'delete' => 'CASCADE',
            ])
            ->create();
    }
}
