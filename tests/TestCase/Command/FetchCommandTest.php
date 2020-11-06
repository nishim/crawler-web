<?php
declare(strict_types=1);

namespace App\Test\TestCase\Command;

use App\Command\FetchCommand;
use Cake\Console\Command;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Command\FetchCommand Test Case
 *
 * @uses \App\Command\FetchCommand
 */
class FetchCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->useCommandRunner();
    }

    /** @test */
    public function 引数なし(): void
    {
        $this->exec('fetch');
        $this->assertExitCode(Command::CODE_ERROR);
    }

    /** @test */
    public function 不正なURL(): void
    {
        $this->exec('fetch invalidargument');
        $this->assertExitCode(Command::CODE_ERROR);
    }

    /** @test */
    public function リクエスト成功(): void
    {
        $this->exec('fetch http://example.com');
        $this->assertExitCode(Command::CODE_SUCCESS);
    }
}
