<?php declare(strict_types=1);

namespace PackageInfo\Composer\Test\Command;

use PackageInfo\Composer\Command\PackageInstalled;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PackageInstalledTest extends TestCase
{
    /**
     * @dataProvider runProvider
     */
    public function testRun(string $package, int $expected, string $message): void
    {
        $input = $this->createMock(InputInterface::class);
        $input->method('getArgument')->with('package')->willReturn($package);

        $output = $this->createMock(OutputInterface::class);
        $output->expects($this->once())->method('writeln')->with($message);

        $this->assertEquals($expected, (new PackageInstalled())->run($input, $output));
    }

    public function runProvider(): \Generator
    {
        yield ['composer/composer', 0, '<info>Package <fg=yellow;options=bold>"composer/composer"</> is installed</info>'];
        yield ['test/test', 1, '<highlight>Package <fg=yellow;options=bold>"test/test"</> is not installed</highlight>'];
    }
}
