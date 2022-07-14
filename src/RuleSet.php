<?php

declare(strict_types=1);

namespace WayOfDev\PhpCsFixer\Config;

interface RuleSet
{
    public function name(): string;

    public function allowRisky(): bool;

    public function useCache(): bool;

    public function rules(): array;
}
