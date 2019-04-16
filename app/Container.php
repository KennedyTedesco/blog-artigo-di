<?php
declare(strict_types=1);

namespace App;

use Closure;

final class Container
{
    private $instances = [];

    public function set(string $id, Closure $closure) : void
    {
        $this->instances[$id] = $closure;
    }

    public function get(string $id) : object
    {
        return $this->instances[$id]($this);
    }

    public function singleton(string $id, Closure $closure) : void
    {
        $this->instances[$id] = function () use ($closure) {
            static $resolvedInstance;

            if (null !== $resolvedInstance) {
                $resolvedInstance = $closure($this);
            }

            return $resolvedInstance;
        };
    }
}
