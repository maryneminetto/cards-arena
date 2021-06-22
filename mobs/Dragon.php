<?php

include_once('Monstres.php');


class Dragon extends Monstres
{

    public function __construct(int $level, string $img, string $name)
    {
        parent::__construct($level, 130, 81, 0.7, 8.3, 8.8, 0.33, 1.65, $img, $name);
    }
}