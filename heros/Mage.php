<?php

include_once ('Heros.php');
include_once ('Ability.php');

class Mage extends Heros
{
    public function __construct($name, $img)
    {
        parent::__construct(15, 8, 27, $name, $img);
        $this->getDamage($this->intelligence);
        $this->ability = new Ability('Fireball', 200, $this->intelligence * 2);
    }

    function levelUp(): void{
        $this->setStrength(1);
        $this->setAgility(1);
        $this->setIntelligence(6);
        $this->getDamage(6);
        $this->ability->setDamage($this->intelligence * 2);
        $this->level += 1;
    }




}