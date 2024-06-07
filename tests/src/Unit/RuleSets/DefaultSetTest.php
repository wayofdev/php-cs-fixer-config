<?php

declare(strict_types=1);

namespace WayOfDev\Tests\src\Unit\RuleSets;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WayOfDev\PhpCsFixer\Config\RuleSets\DefaultSet;

use function array_diff_assoc;

final class DefaultSetTest extends TestCase
{
    #[Test]
    public function it_retrieves_name(): void
    {
        $ruleSet = new DefaultSet();

        self::assertEquals('wayofdev', $ruleSet->name());
    }

    #[Test]
    public function it_allows_risky_rules(): void
    {
        $ruleSet = new DefaultSet();

        self::assertTrue($ruleSet->allowRisky());
    }

    #[Test]
    public function it_merges_custom_rules_with_default_rules(): void
    {
        $customRules = [
            '@Symfony' => false,
            'custom_rule' => true,
        ];

        $ruleSet = new DefaultSet($customRules);

        $rules = $ruleSet->rules();

        $expectedRules = [
            '@Symfony' => false,
            'custom_rule' => true,
        ];

        self::assertArrayHasKey('custom_rule', $rules);
        self::assertEmpty(array_diff_assoc($expectedRules, $rules));
    }
}
