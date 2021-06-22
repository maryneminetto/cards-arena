<?php

include_once ('Heros.php');
include_once ('Ability.php');

class Warrior extends Heros
{
    public function __construct($name, $img)
    {
        parent::__construct(24, 12, 14, $name, $img);
        $this->getDamage($this->strength);
        $this->ability = new Ability('Heurtoir', 150, $this->strength * 1.8);
    }

    public function levelUp():void{
        $this->setStrength(5);
        $this->setAgility(1);
        $this->setIntelligence(2);
        $this->getDamage(5);
        $this->ability->setDamage($this->strength * 1.8);
        $this->level += 1;
    }



    
}