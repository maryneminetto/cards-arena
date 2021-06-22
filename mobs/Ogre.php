<?php

include_once('Monstres.php');


class Ogre extends Monstres
{

    public function __construct(int $level, string $img, string $name)
    {
        parent::__construct($level, 112, 71, 0.5, 6.4, 6.8, 0.28, 1.5, $img, $name);
    }
}