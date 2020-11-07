<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRedirects extends AbstractMigration
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
            ->table('redirects')
            ->addColumn('page_id', 'string')
            ->addColumn('url', 'string')
            ->addColumn('created', 'datetime')
            ->addForeignKey(['page_id'], 'pages', 'id', [
                'update' => 'NO_ACTION',
                'delete' => 'CASCADE',
            ])
            ->create();
    }
}
