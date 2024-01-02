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

use Nulldark\DevTools\Composer\Factory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

abstract class ProcessCommand extends BaseCommand
{
    protected ?string $executablePath = null;

    /**
     * {@inheritDoc}
     */
    protected function doRun(InputInterface $input, OutputInterface $output): int
    {
        $process = new Process(
            $this->getCommandLine($input, $output),
        );

        $process->start();

        return $process->wait(
            static function (string $type, string $buffer) use ($output) {
                $output->write($buffer);
            }
        );
    }

    /**
     * Returns a full command to execute.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return array
     */
    public function getCommandLine(InputInterface $input, OutputInterface $output): array
    {
        return [
            $this->getExecutablePath(),
            ...$this->getExecutableArgs($input, $output)
        ];
    }

    /**
     * Gets a full path of executable path.
     *
     * @return string|null
     */
    public function getExecutablePath(): ?string
    {
        if ($this->executablePath === null) {
            $this->executablePath = (new ExecutableFinder())->find(
                name: $this->getExecutableName(),
                extraDirs: [Factory::createComposer()->getConfig()->get('bin-dir')]
            );
        }

        return $this->executablePath;
    }

    /**
     * Gets an executable name.
     *
     * @return string
     */
    abstract public function getExecutableName(): string;

    /**
     * Gets arguments for command line.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return array
     */
    abstract public function getExecutableArgs(InputInterface $input, OutputInterface $output): array;
}