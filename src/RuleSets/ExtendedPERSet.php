<?php

declare(strict_types=1);

namespace WayOfDev\PhpCsFixer\Config\RuleSets;

use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use WayOfDev\PhpCsFixer\Config\RuleSet;

use function array_merge;

final class ExtendedPERSet implements RuleSet
{
    /**
     * @param array<string, array<string, mixed>|bool> $rules
     */
    public function __construct(private readonly array $rules = [])
    {
    }

    public function name(): string
    {
        return 'ExtendedPER';
    }

    public function allowRisky(): bool
    {
        return true;
    }

    public function useCache(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge([
            /*
             * Base our RuleSet on PER-CS2.0 Ruleset
             * https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/ruleSets/PER-CS2.0.rst
             * https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/src/RuleSet/Sets/PERCS2x0Set.php
             */
            '@PER-CS2.0' => true,

            /*
             * @PER-CS2.0 Overrides
             */
            'class_definition' => [
                'space_before_parenthesis' => false,
            ],

            /*
             * @Symfony
             */
            'yoda_style' => [
                'equal' => false,
                'identical' => false,
                'less_and_greater' => false,
            ],
            'align_multiline_comment' => true,
            'single_line_throw' => false,
            'phpdoc_order' => [
                'order' => [
                    'param',
                    'return',
                    'throws',
                ],
            ],
            'global_namespace_import' => [
                'import_classes' => false,
                'import_functions' => false,
                'import_constants' => false,
            ],
            'class_attributes_separation' => [
                'elements' => [
                    'const' => 'one',
                    'method' => 'one',
                    'property' => 'one',
                    'trait_import' => 'none',
                    'case' => 'only_if_meta',
                ],
            ],
            'no_unused_imports' => true,

            /*
             * @Symfony:risky
             */
            'native_function_invocation' => [
                'include' => [
                    NativeFunctionInvocationFixer::SET_INTERNAL,
                    NativeFunctionInvocationFixer::SET_COMPILER_OPTIMIZED,
                ],
                'scope' => 'namespaced',
                'strict' => true,
            ],

            /*
             * @PER-CS2.0 overrides
             */
            'ordered_class_elements' => [
                'sort_algorithm' => 'none',
                'order' => [
                    'use_trait',
                    'case',
                    'constant',
                    'property_public',
                    'property_protected',
                    'property_private',
                    'construct',
                    'method_public_static',
                    'method_public',
                    'magic',
                    'destruct',
                    'phpunit',
                    'method_protected_static',
                    'method_protected',
                    'method_private_static',
                    'method_private',
                ],
            ],
            'method_argument_space' => [
                'on_multiline' => 'ensure_fully_multiline',
                'attribute_placement' => 'same_line',
                'after_heredoc' => true,  // @PHP73Migration
            ],

            /*
             * @PhpCsFixer
             */
            'method_chaining_indentation' => true,
            'phpdoc_var_annotation_correct_order' => true,
            'phpdoc_add_missing_param_annotation' => [
                'only_untyped' => true,
            ],
            'multiline_comment_opening_closing' => true,
            'self_static_accessor' => true,
            'no_useless_else' => true,

            /*
             * @PhpCsFixer:risky
             */
            'static_lambda' => true,

            /*
             * @PHP**MigrationSet
             */
            'list_syntax' => [
                'syntax' => 'short',
            ],
            'ternary_to_null_coalescing' => true,

            /*
             * @PHP**MigrationSet:risky
             */
            'random_api_migration' => true,
            'declare_strict_types' => true,
            'void_return' => true,

            /*
             * Rules without presets
             */
            'phpdoc_tag_casing' => true,
            'attribute_empty_parentheses' => [
                'use_parentheses' => false,
            ],
            'phpdoc_line_span' => [
                'const' => null,
                'method' => 'multi',
                'property' => null,
            ],
        ], $this->rules);
    }
}
