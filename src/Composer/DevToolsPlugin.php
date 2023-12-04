<?php

namespace Nulldark\DevTools\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Symfony\Component\Filesystem\Filesystem;

class DevToolsPlugin implements PluginInterface
{
    /**
     * @inheritDoc
     */
    public function activate(Composer $composer, IOInterface $io): void
    {
        $filesystem = new Filesystem();

        if (!$filesystem->exists('./build')) {
            $filesystem->mkdir('./build');
        }

        if ($filesystem->exists('./build/cache')) {
            $filesystem->mkdir('./build/cache');
            $filesystem->touch('./build/cache/.gitkeep');
        }

        if ($filesystem->exists('./build/coverages')) {
            $filesystem->mkdir('./build/coverages');
            $filesystem->touch('./build/coverages/.gitkeep');
        }
    }

    /**
     * @inheritDoc
     */
    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    /**
     * @inheritDoc
     */
    public function uninstall(Composer $composer, IOInterface $io)
    {
    }
}