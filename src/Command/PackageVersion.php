<?php declare(strict_types=1);

namespace PackageInfo\Composer\Command;

use Composer\Command\BaseCommand;
use Composer\InstalledVersions;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PackageVersion extends BaseCommand
{
    protected function configure(): void
    {
        $this->setName('package:version');
        $this->setDefinition(
            new InputDefinition([
                new InputArgument('package', InputArgument::REQUIRED, 'Package to inspect'),
            ])
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $package = $input->getArgument('package');
        assert(is_string($package));

        $version = InstalledVersions::getPrettyVersion($package);
        assert(!is_null($version));

        $output->writeln($version);

        return 0;
    }
}
