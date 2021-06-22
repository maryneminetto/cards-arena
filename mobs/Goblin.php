<?php

include_once('Monstres.php');

/**
 * Class Gobelin.php
 *
 * @author Kevin Tourret
 */
class Gobelin extends Monstres
{

    /**
     * Gobelin constructor.
     * @param int $level
     */
    public function __construct(int $level, string $img, string $name)
    {
        parent::__construct($level, 100, 65, 0.33, 3.33, 3.35, 0.15, 1.5, $img, $name);
    }
}