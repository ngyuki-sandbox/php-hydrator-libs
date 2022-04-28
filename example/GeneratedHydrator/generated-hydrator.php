<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use GeneratedHydrator\Configuration;

class Foo
{
    private int $foo   = 1;
    private int $bar = 2;
    private string $baz    = '3';

    public function getFoo()
    {
        return $this->foo;
    }

    public function getBar()
    {
        return $this->bar;
    }

    public function getBaz()
    {
        return $this->baz;
    }
}

$config = new Configuration(Foo::class);
$config->setGeneratedClassesTargetDir(__DIR__ . '/generated');
$hydrator = $config->createFactory()->getHydrator();

$foo = new Foo();
$data = $hydrator->extract($foo);

echo "\nExtracted data:\n";
var_dump($data);

$hydrator->hydrate(
    [
        'foo' => 4,
        'bar' => 5,
        'baz' => 6,
    ],
    $foo,
);

echo "\nObject hydrated with new data:\n";
var_dump($foo);
