<?php

declare(strict_types=1);

namespace WayOfDev\PhpCsFixer\Config\Tests\Unit;

use LogicException;
use PhpCsFixer\Config;
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

    /**
     * @test
     */
    public function it_retrieves_default_options(): void
    {
        $config = $this->builder->getConfig();

        self::assertEquals('wayofdev', $config->getName());
        self::assertTrue($config->getRiskyAllowed());
        self::assertTrue($config->getUsingCache());
    }

    /**
     * @test
     */
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

    /**
     * @test
     */
    public function it_has_no_directories_by_default(): void
    {
        $this->expectException(LogicException::class);

        [...$this->builder->getConfig()->getFinder()];
    }

    /**
     * @test
     */
    public function it_adds_directories(): void
    {
        $finder = $this->builder
            ->inDir(__DIR__ . '/../../src')
            ->inDir(__DIR__ . '/../../tests')
            ->getConfig()
            ->getFinder()
        ;

        $items = $this->finderToArray($finder);

        self::assertContains(__FILE__, $items);
        self::assertContains(realpath(__DIR__ . '/../../src/ConfigBuilder.php'), $items);
    }

    /**
     * @test
     */
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

    /**
     * @test
     */
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

    /**
     * @test
     */
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

    private function finderToArray(iterable $finder): array
    {
        $map = static function (SplFileInfo $info): string {
            return $info->getRealPath();
        };

        return array_map($map, [...$finder]);
    }
}
