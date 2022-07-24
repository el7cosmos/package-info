<?php declare(strict_types=1);

namespace PackageInfo\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;
use PackageInfo\Composer\Command\PackageInstalled;
use PackageInfo\Composer\Command\PackageVersion;

class Plugin implements PluginInterface, Capable, CommandProvider
{
    /**
     * @inheritDoc
     */
    public function activate(Composer $composer, IOInterface $io): void
    {
    }

    /**
     * @inheritDoc
     */
    public function deactivate(Composer $composer, IOInterface $io): void
    {
    }

    /**
     * @inheritDoc
     */
    public function uninstall(Composer $composer, IOInterface $io): void
    {
    }

    public function getCapabilities(): array
    {
        return [
            CommandProvider::class => self::class,
        ];
    }

    public function getCommands(): array
    {
        return [
            new PackageInstalled(),
            new PackageVersion(),
        ];
    }
}
