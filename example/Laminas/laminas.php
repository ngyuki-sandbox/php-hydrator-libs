<?php

use App\User;
use App\UserItem;
use Laminas\Hydrator\Aggregate\AggregateHydrator;

require_once __DIR__ . '/../../vendor/autoload.php';

$hydrator = new Laminas\Hydrator\ObjectPropertyHydrator();

//class User
//{
//    public int $id = 0;
//    public string $name = '';
//    public bool $flg = false;
//    public array $items = [];
//    public DateTimeImmutable $date;
//
//    public UserItem $item;
//}
//
//class UserItem
//{
//    public int $no =  0;
//}

$data = [
    'id'   => 123,
    'name' => 'ore',
    'flg' => 'true',
    'items' => [
        [ 'no' => 1 ],
        [ 'no' => 1 ],
        [ 'no' => 1 ],
    ],
    'item' => [
        'no' => 1,
    ],
    'date' => '2021-12-21',
];

$hydrator->addStrategy('flg', new Laminas\Hydrator\Strategy\BooleanStrategy('true', 'false'));
$hydrator->addStrategy('items',
    new Laminas\Hydrator\Strategy\CollectionStrategy(
        new Laminas\Hydrator\ObjectPropertyHydrator(), UserItem::class
    )
);
$hydrator->addStrategy('item', new Laminas\Hydrator\Strategy\HydratorStrategy(
    new Laminas\Hydrator\ObjectPropertyHydrator(),
    UserItem::class
));

$hydrator->addStrategy('date',
    new Laminas\Hydrator\Strategy\DateTimeImmutableFormatterStrategy(
        new Laminas\Hydrator\Strategy\DateTimeFormatterStrategy('Y-m-d')
    )
);

$obj = $hydrator->hydrate($data, new User());
var_dump($obj);

$data = $hydrator->extract($obj);
var_dump($data);
