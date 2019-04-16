<?php
declare(strict_types=1);

namespace App;

use Closure;
use ReflectionClass;
use ReflectionParameter;

final class Container
{
    private $instances = [];

    public function set(string $id, Closure $closure) : void
    {
        $this->instances[$id] = $closure;
    }

    public function get(string $id) : object
    {
        // Se essa referência existe no mapa do container, então a retorna diretamente.
        if ($this->has($id)) {
            return $this->instances[$id]($this);
        }

        // Se a referência não existe no container, então foi passado uma classe para ser instanciada
        // Façamos então a reflexão dela para obter os parâmetros do método construtor
        $reflector = new ReflectionClass($id);
        $constructor = $reflector->getConstructor();

        // Se a classe não implementa um método construtor, então vamos apenas retornar uma instância dela.
        if (null === $constructor) {
            return new $id();
        }

        // Itera sobre os parâmetros do construtor para realizar a resolução das dependências que ele exige.
        // O método "newInstanceArgs()" cria uma nova instância da classe usando os novos argumentos passados.
        // Usamos "array_map()" para iterar os parâmetros atuais, resolvê-los junto ao container e retornar um array das instâncias já resolvidas pelo container.
        return $reflector->newInstanceArgs(array_map(
            function (ReflectionParameter $dependency) {
                // Busca no container a referência da classe desse parâmetro
                return $this->get(
                    $dependency->getClass()->getName()
                );
            },
            $constructor->getParameters()
        ));
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

    public function has(string $id) : bool
    {
        return isset($this->instances[$id]);
    }
}
