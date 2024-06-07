<?php

declare(strict_types=1);

namespace WayOfDev\Tests\src\Unit;

use BadMethodCallException;
use LogicException;
use PhpCsFixer\Config;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SplFileInfo;
use WayOfDev\PhpCsFixer\Config\ConfigBuilder;
use WayOfDev\PhpCsFixer\Config\RuleSets\DefaultSet;

use function array_diff_assoc;
use function array_map;
use function realpath;

final class ConfigBuilderTest extends TestCase
{
    private ConfigBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = ConfigBuilder::createFromRuleSet(new DefaultSet());
    }

    #[Test]
    public function it_retrieves_default_options(): void
    {
        $config = $this->builder->getConfig();

        self::assertEquals('wayofdev', $config->getName());
        self::assertTrue($config->getRiskyAllowed());
        self::assertTrue($config->getUsingCache());
    }

    #[Test]
    public function it_overrides_default_options(): void
    {
        /** @var Config $config */
        $config = $this->builder
            ->setRiskyAllowed(false)
            ->setUsingCache(false)
            ->getConfig()
        ;

        self::assertFalse($config->getRiskyAllowed());
        self::assertFalse($config->getUsingCache());
    }

    #[Test]
    public function it_has_no_directories_by_default(): void
    {
        $this->expectException(LogicException::class);

        [...$this->builder->getConfig()->getFinder()];
    }

    #[Test]
    public function it_adds_directories(): void
    {
        $finder = $this->builder
            ->inDir(__DIR__ . '/../../../src')
            ->inDir(__DIR__ . '/../../../tests/src')
            ->getConfig()
            ->getFinder()
        ;

        $items = $this->finderToArray($finder);

        self::assertContains(__FILE__, $items);
        self::assertContains(realpath(__DIR__ . '/../../../src/ConfigBuilder.php'), $items);
    }

    #[Test]
    public function it_adds_files(): void
    {
        $finder = $this->builder
            ->addFiles([__FILE__])
            ->getConfig()
            ->getFinder()
        ;

        $items = $this->finderToArray($finder);

        self::assertCount(1, $items);
        self::assertContains(__FILE__, $items);
    }

    #[Test]
    public function it_adds_default_rules(): void
    {
        $rules = $this->builder
            ->getConfig()
            ->getRules()
        ;

        $expected = [
            '@Symfony' => true,
        ];

        self::assertEmpty(array_diff_assoc($expected, $rules));
    }

    #[Test]
    public function it_overrides_default_rules(): void
    {
        $rules = ConfigBuilder::createFromRuleSet(new DefaultSet(['@Symfony' => false]))
            ->getConfig()
            ->getRules()
        ;

        $expected = [
            '@Symfony' => false,
        ];

        self::assertEmpty(array_diff_assoc($expected, $rules));
    }

    #[Test]
    public function it_excludes_directories(): void
    {
        $finder = $this->builder
            ->exclude([__DIR__ . '/../../../src/RuleSets'])
            ->inDir(__DIR__ . '/../../../src')
            ->getConfig()
            ->getFinder()
        ;

        $items = $this->finderToArray($finder);

        self::assertNotContains(__DIR__ . '/../../../src/RuleSets/DefaultSet.php', $items);
    }

    #[Test]
    public function it_calls_methods_on_config(): void
    {
        $config = $this->builder
            ->setRiskyAllowed(false)
            ->getConfig()
        ;

        self::assertFalse($config->getRiskyAllowed());
    }

    #[Test]
    public function it_throws_exception_on_invalid_method_call(): void
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Method "PhpCsFixer\Config::invalidMethod" does not exists.');

        // @phpstan-ignore-next-line
        $this->builder->invalidMethod();
    }

    #[Test]
    public function it_sets_parallel_config_with_custom_parameters(): void
    {
        /** @var Config $config */
        $config = $this->builder
            ->useParallelConfig(4, 10, 600)
            ->getConfig()
        ;

        $parallelConfig = $config->getParallelConfig();

        self::assertSame(4, $parallelConfig->getMaxProcesses());
        self::assertSame(10, $parallelConfig->getFilesPerProcess());
        self::assertSame(600, $parallelConfig->getProcessTimeout());
    }

    /**
     * @param iterable<SplFileInfo> $finder
     *
     * @return array<string>
     */
    private function finderToArray(iterable $finder): array
    {
        $map = static function (SplFileInfo $info): string {
            return $info->getRealPath();
        };

        return array_map($map, [...$finder]);
    }
}
