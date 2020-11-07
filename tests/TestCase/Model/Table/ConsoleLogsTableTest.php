<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConsoleLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConsoleLogsTable Test Case
 */
class ConsoleLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConsoleLogsTable
     */
    protected $ConsoleLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ConsoleLogs',
        'app.Pages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ConsoleLogs') ? [] : ['className' => ConsoleLogsTable::class];
        $this->ConsoleLogs = $this->getTableLocator()->get('ConsoleLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ConsoleLogs);

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
