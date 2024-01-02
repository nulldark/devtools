<?php

/*
 * Copyright (c) 2023-2024 Dominik Szamburski
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Nulldark\DevTools\Cli\Command\Common;

use Nulldark\DevTools\Cli\Command\BaseCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function sprintf;

#[AsCommand(
    name: 'dev:analyze',
    description: 'Run all QA tools',
)]
class DevToolsCommand extends BaseCommand
{
    private const _COMMANDS = [
        'dev:lint:fix',
        'dev:lint:style',
        'dev:analyze:phpstan',
        'dev:analyze:psalm',
        'dev:test:unit'
    ];

    public function doRun(InputInterface $input, OutputInterface $output): int
    {
        $app = $this->getApplication();

        $exitCode = 0;

        foreach (self::_COMMANDS as $name) {
            /** @var \Nulldark\DevTools\Cli\Command\BaseCommand $command */
            $command = $app->find($name);
            $code = $command->run($input, $output);

            $output->write(
                sprintf(
                    "\n<options=bold>[%s]</> <info>%s</info> ... %s \n",
                    $command->getName(),
                    $command->getDescription(),
                    $command->getAllowedExitCode() >= $code === false ? '❌' : '✅'
                )
            );

            $exitCode += $code;
        }

        return $exitCode;
    }
}
