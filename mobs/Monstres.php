<?php

include_once('RpgEntities.php');


abstract class Monstres extends RpgEntities
{
    protected string $img;
    protected  string $name;


    public function __construct(
        int $level,
        int $hpCoef,
        int $manaCoef,
        float $defenseCoef,
        int $damageMinCoef,
        int $damageMaxCoef,
        float $scoreCriticalStrikeCoef,
        float $criticalDamageCoef,
        string $img,
        string $name
    ) {
        $this->level = $level;
        $this->hp = $hpCoef * $this->level;
        $this->hpMax = $hpCoef * $this->level;
        $this->mana = $manaCoef * $this->level;
        $this->manaMax = $manaCoef * $this->level;
        $this->defense = $defenseCoef * $this->level;
        $this->damageMin = $damageMinCoef * $this->level;
        $this->damageMax = $damageMaxCoef * $this->level;
        $this->scoreCriticalStrike = $scoreCriticalStrikeCoef * $this->level;
        $this->criticalDamage = $criticalDamageCoef;
        $this->img = $img;
        $this->name = $name;
    }

   

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

   /**
     * @return float|int
     */
    public function getDefence()
    {
        return $this->defense;
    }

    /**
     * @return int
     */
    public function getScoreCriticalStrike(): int
    {
        return $this->scoreCriticalStrike;
    }

    /**
     * @return float
     */
    public function getCriticalDamage(): float
    {
        return $this->criticalDamage;
    }

    /**
     * @return int
     */
    public function getDamageMin(): int
    {
        return $this->damageMin;
    }

    /**
     * @return int
     */
    public function getDamageMax(): int
    {
        return $this->damageMax;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg(string $img): void
    {
        $this->img = $img;
    }


    

}