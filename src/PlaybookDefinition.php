<?php

declare(strict_types=1);

/*
 * This file is part of konceiver/laravel-playbooks.
 *
 * (c) Konceiver <info@konceiver.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Konceiver\Playbooks;

class PlaybookDefinition
{
    /** @var string */
    public $id;

    /** @var \Konceiver\Playbooks\Playbook */
    public $playbook;

    /** @var int */
    public $times = 1;

    /** @var bool */
    public $once = false;

    public static function times(string $className, int $times): self
    {
        $definition = new static($className);

        $definition->times = $times;

        return $definition;
    }

    public static function once(string $className): self
    {
        $definition = new static($className);

        $definition->once = true;

        return $definition;
    }

    public function __construct(string $className)
    {
        $this->playbook = app($className);
        $this->id       = get_class($this->playbook);
    }
}
