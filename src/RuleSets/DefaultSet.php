<?php

declare(strict_types=1);

namespace WayOfDev\PhpCsFixer\Config\RuleSets;

use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use WayOfDev\PhpCsFixer\Config\RuleSet;

use function array_merge;

final class DefaultSet implements RuleSet
{
    /**
     * @param array<string, array<string, mixed>|bool> $rules
     */
    public function __construct(private readonly array $rules = [])
    {
    }

    public function name(): string
    {
        return 'wayofdev';
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
             * Base our RuleSet on @Symfony RuleSet
             * https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/ruleSets/Symfony.rst
             * https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/src/RuleSet/Sets/SymfonySet.php
             */
            '@Symfony' => true,

            /*
             * @Symfony overrides
             */
            'concat_space' => [
                'spacing' => 'one',
            ],
            'method_argument_space' => [
                'on_multiline' => 'ensure_fully_multiline',
                'attribute_placement' => 'same_line',
                'after_heredoc' => true, // @PHP73Migration
            ],
            'php_unit_method_casing' => [
                'case' => 'snake_case',
            ],
            'yoda_style' => [
                'equal' => false,
                'identical' => false,
                'less_and_greater' => false,
            ],
            'phpdoc_align' => [
                'align' => 'left',
            ],

            'ordered_class_elements' => [
                'sort_algorithm' => 'none',
                'order' => [
                    'use_trait',
                    'constant_public',
                    'constant_protected',
                    'constant_private',
                    'property_public_static',
                    'property_public',
                    'property_protected_static',
                    'property_protected',
                    'property_private_static',
                    'property_private',
                    'construct',
                    'method_public_static',
                    'method_protected_static',
                    'method_private_static',
                    'method_public_abstract_static',
                    'method_protected_abstract_static',
                    'method_public_abstract',
                    'method_protected_abstract',
                    'phpunit',
                    'method_public',
                    'method_protected',
                    'method_private',
                ],
            ],
            'global_namespace_import' => [
                'import_classes' => true,
                'import_functions' => true,
                'import_constants' => true,
            ],
            'class_attributes_separation' => [
                'elements' => [
                    'const' => 'one',
                    'method' => 'one',
                    'property' => 'one',
                    'trait_import' => 'none',
                ],
            ],

            /*
             * @Symfony:risky overrides
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
             * @PhpCsFixer
             */
            'single_line_throw' => false,
            'explicit_indirect_variable' => true,
            'method_chaining_indentation' => true,
            'phpdoc_var_annotation_correct_order' => true,
            'phpdoc_add_missing_param_annotation' => [
                'only_untyped' => true,
            ],
            'multiline_comment_opening_closing' => true,
            'self_static_accessor' => true,
            'no_useless_else' => true,
            'no_useless_return' => true,

            /*
             * @PhpCsFixer:risky
             */
            'static_lambda' => true,
            'php_unit_test_annotation' => [
                'style' => 'annotation',
            ],

            /*
             * Rules without presets
             */
            'phpdoc_tag_casing' => true,
            'not_operator_with_successor_space' => true,
            'attribute_empty_parentheses' => [
                'use_parentheses' => false,
            ],
            'phpdoc_line_span' => [
                'const' => 'multi',
                'method' => 'multi',
                'property' => 'multi',
            ],
        ], $this->rules);
    }
}
