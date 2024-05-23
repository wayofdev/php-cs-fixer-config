<?php

declare(strict_types=1);

namespace WayOfDev\PhpCsFixer\Config;

use BadMethodCallException;
use PhpCsFixer\Config;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Finder;

use function call_user_func_array;
use function get_class;
use function is_callable;
use function sprintf;

/**
 * @method self setRiskyAllowed(bool $flag)
 * @method self setUsingCache(bool $flag)
 */
final class ConfigBuilder
{
    private Config $config;

    private function __construct(private readonly RuleSet $ruleSet)
    {
        $this->config = new Config($ruleSet->name());
        $this->config
            ->setRiskyAllowed($ruleSet->allowRisky())
            ->setUsingCache($ruleSet->useCache())
        ;
    }

    public static function createFromRuleSet(RuleSet $ruleSet): self
    {
        return new self($ruleSet);
    }

    /**
     * @param array<mixed> $arguments
     *
     * @throws BadMethodCallException
     */
    public function __call(string $name, array $arguments): self
    {
        $method = [$this->config, $name];

        if (is_callable($method)) {
            call_user_func_array($method, $arguments);

            return $this;
        }

        throw new BadMethodCallException(sprintf('Method "%s::%s" does not exists.', get_class($this->config), $name));
    }

    public function inDir(string $dir): self
    {
        $this->getFinder()->in([$dir]);

        return $this;
    }

    /**
     * @param array<mixed> $files
     */
    public function addFiles(array $files): self
    {
        $this->getFinder()->append($files);

        return $this;
    }

    public function getConfig(): ConfigInterface
    {
        return $this->config->setRules($this->ruleSet->rules());
    }

    private function getFinder(): Finder
    {
        return $this->config->getFinder();
    }
}
