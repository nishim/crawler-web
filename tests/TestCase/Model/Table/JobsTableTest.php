<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JobsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JobsTable Test Case
 */
class JobsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\JobsTable
     */
    protected $Jobs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Jobs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Jobs') ? [] : ['className' => JobsTable::class];
        $this->Jobs = $this->getTableLocator()->get('Jobs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Jobs);

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

    /** @test */
    public function キューに追加(): void
    {
        $ret = $this->Jobs->enqueue('fetch', ['http://example.com']);
        $this->assertTrue($ret);
        $job = $this->Jobs->find()->first();
        $this->assertEquals('fetch', $job->command);
        $this->assertEquals(['http://example.com'], $job->parameters);
        $this->assertEquals('waiting', $job->status);
    }

    /** @test */
    public function デキュー(): void
    {
        $ret = $this->Jobs->enqueue('fetch', ['http://example.com']);
        $job = $this->Jobs->dequeue();
        $this->assertEquals('fetch', $job->command);
        $this->assertEquals(['http://example.com'], $job->parameters);
        $this->assertEquals('running', $job->status);

        var_dump($job);

        $job = $this->Jobs->dequeue();
        $this->assertNull($job);
    }
}
