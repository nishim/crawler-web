<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RedirectsFixture
 */
class RedirectsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'page_id' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
        'url' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => 6],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'redirects_page_id_fkey' => ['type' => 'foreign', 'columns' => ['page_id'], 'references' => ['pages', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'page_id' => 'aeb12a37-b8e2-4f29-ad93-19b7d5849cc3',
                'url' => 'Lorem ipsum dolor sit amet',
                'created' => 1604735377,
            ],
        ];
        parent::init();
    }
}
