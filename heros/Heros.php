<?php

include_once('RpgEntities.php');

abstract class Heros extends RpgEntities
{

    protected string $name;
    protected int $strength = 0;
    protected int $agility = 0;
    protected int $intelligence = 0;
    protected int $level;
    protected string $img;

   

    public function __construct(int $strength, int $agility, int $intelligence, string $name, string $img)
    {
        $this->level = 1;
        $this->scoreCriticalStrike = 12.0;
        $this->criticalDamage = 1.5;
        $this->setIntelligence($intelligence);
        $this->setAgility($agility);
        $this->setStrength($strength);
        $this->name = $name;
        $this->img = $img;

    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    public function setStrength($strength)
    {
        $this->strength += $strength;
        $this->hp += $strength*19;
        $this->hpMax += $strength*19;
    }

    /**
     * @return int
     */
    public function getAgility(): int
    {
        return $this->agility;
    }

    public function setAgility($agility)
    {
        $this->agility += $agility;
        $this->defense += round($agility/6, 2);
    }

    /**
     * @return int
     */
    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    public function setIntelligence($intelligence)
    {
        $this->intelligence += $intelligence;
        $this->mana += $intelligence*17;
        $this->manaMax += $intelligence*17;
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



    public function getDamage(int $carac){
        $this->damageMin += $carac*1.2;
        $this->damageMax += $carac*1.4;
        $this->scoreCriticalStrike += $carac*0.08;

    }

    abstract function levelUp(): void;

    public function setLevel(int $newLevel):void {
        if ($newLevel > $this->level) {
            for ($i=$this->level; $i < $newLevel; $i++){
                $this->levelUp();
            }
        }
        $this->level = $newLevel;
    }

    /**
     * @return Ability
     */
    public function getAbility()
    {
        return $this->ability->getName();
    }


}