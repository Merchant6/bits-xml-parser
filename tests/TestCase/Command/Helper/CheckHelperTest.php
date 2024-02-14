<?php
declare(strict_types=1);

namespace App\Test\TestCase\Command\Helper;

use App\Command\Helper\CheckHelper;
use Cake\Console\ConsoleIo;
use Cake\TestSuite\Stub\ConsoleOutput;
use Cake\TestSuite\TestCase;

/**
 * App\Command\Helper\CheckHelper Test Case
 */
class CheckHelperTest extends TestCase
{
    /**
     * ConsoleOutput stub
     *
     * @var \Cake\TestSuite\Stub\ConsoleOutput
     */
    protected $stub;

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo
     */
    protected $io;

    /**
     * Test subject
     *
     * @var \App\Command\Helper\CheckHelper
     */
    protected $Check;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->stub = new ConsoleOutput();
        $this->io = new ConsoleIo($this->stub);
        $this->Check = new CheckHelper($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Check);

        parent::tearDown();
    }

    /**
     * Test output method
     *
     * @return void
     * @uses \App\Command\Helper\CheckHelper::output()
     */
    public function testOutput(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
