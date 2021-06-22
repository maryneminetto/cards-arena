<?php

include_once ('Heros.php');
include_once ('Ability.php');

class Rogue extends Heros
{

    public function __construct($name, $img)
    {
        parent::__construct(13, 26, 11, $name, $img);
        $this->getDamage($this->agility);
        $this->criticalDamage = 1.7;
        $this->ability = new Ability('Embuscade', 110, $this->agility * 1.9);

    }

    public function levelUp():void{
        $this->setStrength(2);
        $this->setAgility(5);
        $this->setIntelligence(1);
        $this->getDamage(5);
        $this->ability->setDamage($this->agility * 1.9);
        $this->level += 1;
    }

    

}