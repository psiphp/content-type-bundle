<?php

namespace Psi\Bundle\ContentType\Tests\Functional\Command;

use Psi\Bundle\ContentType\Tests\Functional\BaseTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class DebugCommandTest extends BaseTestCase
{
    public function testCommandList()
    {
        $output = $this->runCommand();
        $this->assertContains('example', $output->fetch());
    }

    public function testCommandShow()
    {
        $output = $this->runCommand([
            'field' => 'text',
        ]);
        $this->assertContains('tag', $output->fetch());
    }

    public function testCommandCompound()
    {
        $output = $this->runCommand([
            'field' => 'example',
        ]);
        $display = $output->fetch();
        $this->assertContains('barbar', $display);
        $this->assertContains('darf', $display);
    }

    private function runCommand(array $input = [])
    {
        $output = new BufferedOutput();
        $input = new ArrayInput($input);
        $command = $this->getContainer()->get('psi_content_type.console.command.debug');
        $command->run($input, $output);

        return $output;
    }
}
