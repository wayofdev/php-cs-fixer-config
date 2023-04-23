<?php

declare(strict_types=1);

namespace WayOfDev\PhpCsFixer\Config\RuleSets;

use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use WayOfDev\PhpCsFixer\Config\RuleSet;

use function array_merge;

final class DefaultSet implements RuleSet
{
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
            // Base our RuleSet on Symfony
            // PhpCsFixer\RuleSet\Sets\SymfonySet
            '@Symfony' => true,

            // @Symfony overrides
            'single_line_throw' => false,
            'ordered_imports' => [
                'imports_order' => [
                    'class',
                    'function',
                    'const',
                ],
            ],
            'concat_space' => [
                'spacing' => 'one',
            ],
            'method_argument_space' => [
                'after_heredoc' => true,
            ],
            'php_unit_method_casing' => [
                'case' => 'snake_case',
            ],
            'yoda_style' => [
                'always_move_variable' => true,
                'equal' => true,
                'identical' => true,
                'less_and_greater' => true,
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
                    'destruct',
                ],
            ],

            // @Symfony:risky overrides
            'native_function_invocation' => [
                'include' => [
                    // All php native functions
                    NativeFunctionInvocationFixer::SET_INTERNAL,
                ],
                'scope' => 'namespaced',
                'strict' => true,
            ],
            'php_unit_test_annotation' => [
                'style' => 'annotation',
            ],

            // @PHP80Migration
            'list_syntax' => [
                'syntax' => 'short',
            ],
            'static_lambda' => true,

            // @PHP70Migration @PHP71Migration @PHP73Migration @PHP74Migration @PHP80Migration
            'ternary_to_null_coalescing' => true,
            'random_api_migration' => true,
            'declare_strict_types' => true,

            // @PHP71Migration:risky @PHP74Migration:risky @PHP80Migration:risky
            'void_return' => true,

            // @PhpCsFixer
            // PhpCsFixer\RuleSet\Sets\PhpCsFixerSet
            'array_indentation' => true,
            'align_multiline_comment' => true,
            'explicit_indirect_variable' => true,
            'method_chaining_indentation' => true,
            'phpdoc_order' => true,
            'phpdoc_var_annotation_correct_order' => true,
            'phpdoc_add_missing_param_annotation' => true,
            'multiline_comment_opening_closing' => true,

            // Rules without presets
            'phpdoc_tag_casing' => true,
            'not_operator_with_successor_space' => true,
            'global_namespace_import' => [
                'import_classes' => true,
                'import_functions' => true,
                'import_constants' => true,
            ],
            'self_static_accessor' => true,

            'no_useless_else' => true,
            'no_useless_return' => true,

        ], $this->rules);
    }
}
