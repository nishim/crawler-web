<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RedirectsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RedirectsTable Test Case
 */
class RedirectsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RedirectsTable
     */
    protected $Redirects;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Pages',
        'app.Redirects',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Redirects') ? [] : ['className' => RedirectsTable::class];
        $this->Redirects = $this->getTableLocator()->get('Redirects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Redirects);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
