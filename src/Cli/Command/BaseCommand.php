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

namespace Nulldark\DevTools\Cli\Command;

use RuntimeException;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends SymfonyCommand
{
    public const DEFAULT_ALLOWED_EXIT_CODE = 0;

    /**
     * Returns the allowed exit code treated as success.
     *
     * @return int
     */
    public function getAllowedExitCode(): int
    {
        return self::DEFAULT_ALLOWED_EXIT_CODE;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            return $this->doRun($input, $output);
        } catch (RuntimeException $exc) {
            $output->write($exc->getMessage());
            $output->write($exc->getTraceAsString());
        }

        return 0;
    }

    /**
     * Internal execute of command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    abstract protected function doRun(InputInterface $input, OutputInterface $output): int;

    protected function configure(): void
    {
        $this->addArgument(
            'args',
            InputArgument::OPTIONAL | InputArgument::IS_ARRAY,
            'Optional arguments to pass'
        );
    }
}
