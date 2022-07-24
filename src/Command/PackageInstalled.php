<?php declare(strict_types=1);

namespace PackageInfo\Composer\Command;

use Composer\Command\BaseCommand;
use Composer\InstalledVersions;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PackageInstalled extends BaseCommand
{
    protected function configure(): void
    {
        $this->setName('package:installed');
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
        $isInstalled = InstalledVersions::isInstalled($package);

        if ($isInstalled) {
            $output->writeln(sprintf('<info>Package <fg=yellow;options=bold>"%s"</> is installed</info>', $package));

            return 0;
        }

        $output->writeln(sprintf('<highlight>Package <fg=yellow;options=bold>"%s"</> is not installed</highlight>', $package));

        return 1;
    }
}
