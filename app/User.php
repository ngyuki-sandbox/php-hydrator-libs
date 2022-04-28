<?php
namespace App;

use DateTimeImmutable;

class User
{
    public int $id = 0;
    public string $name = '';
    public bool $flg = false;

    public UserItem $item;

    public array $items = [];

    public DateTimeImmutable $date;

    public \stdClass $std;

}
