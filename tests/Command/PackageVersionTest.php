<?php declare(strict_types=1);

namespace PackageInfo\Composer\Test\Command;

use Composer\InstalledVersions;
use PackageInfo\Composer\Command\PackageVersion;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PackageVersionTest extends TestCase
{
    public function testRun(): void
    {
        $input = $this->createMock(InputInterface::class);
        $input->method('getArgument')->with('package')->willReturn('composer/composer');

        $output = $this->createMock(OutputInterface::class);
        $output->expects($this->once())->method('writeln')->with(InstalledVersions::getPrettyVersion('composer/composer'));

        $this->assertEquals(0, (new PackageVersion())->run($input, $output));
    }

    public function testRunException(): void
    {
        $this->expectException(\OutOfBoundsException::class);

        $input = $this->createMock(InputInterface::class);
        $input->method('getArgument')->with('package')->willReturn('test/test');

        (new PackageVersion())->run($input, $this->createStub(OutputInterface::class));
    }
}
