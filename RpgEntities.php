<?php

abstract class RpgEntities{
    protected int $hp = 0;

    protected int $hpMax = 0;

    protected int $mana = 0;

    protected int $manaMax = 0;

    protected float $defense = 0.0;

    protected float $scoreCriticalStrike = 0.0;

    protected float $criticalDamage = 0.0;

    protected int $damageMin = 0;

    protected int $damageMax = 0;

    protected Ability $ability;


    /**
     * @return float|int
     */
    public function getScoreCriticalStrike()
    {
        return $this->scoreCriticalStrike;
    }

    /**
     * @param int $hp
     * @return RpgEntity
     */
    public function setHp(int $hp): RpgEntities
    {
        $this->hp = $hp;
        return $this;
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
     * @return int
     */
    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    /**
     * @return int
     */
    public function getAgility(): int
    {
        return $this->agility;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @return int
     */
    public function getHp(): int
    {
        return $this->hp;
    }

    /**
     * @return int
     */
    public function getHpMax(): int
    {
        return $this->hpMax;
    }

    /**
     * @return int
     */
    public function getMana(): int
    {
        return $this->mana;
    }

    /**
     * @param int $mana
     */
    public function setMana(int $mana): void
    {
        $this->mana = $mana;
    }



    /**
     * @return int
     */
    public function getManaMax(): int
    {
        return $this->manaMax;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getDefense(): float
    {
        return $this->defense;
    }

    /**
     * Une RpgEntity attaque une autre RpgEntity
     *
     * @param RpgEntities $rpgEntity
     */
   /* public function attack(RpgEntities $rpgEntities): void
    {

        $damage = rand($this->damageMin, $this->damageMax);
        if(mt_rand(1,100)<=$this->scoreCriticalStrike){
            $damage *= $this->criticalDamage;
            echo $damage."cc"."<br>";
        }echo $damage." pour ".$rpgEntities->getName()."<br>";

       $rpgEntities->setHp($rpgEntities->hp - $damage* (1 - ($rpgEntities->defense / 100)));

    }*/

    public function isDead(): bool
    {
        return $this->getHp() <= 0;
    }

    /**
     * @return int
     */
    public function getDamages(): int
    {
        return rand($this->damageMin, $this->damageMax);
    }

    /**
     * @return float
     */
    public function getCoefficientDefense(): float
    {
        return ((100 - $this->defense) / 100);
    }

    /**
     * Une RpgEntity attaque une autre RpgEntity
     *
     * @param RpgEntity $rpgEntityTarget
     * @return bool
     */
    public function attack(RpgEntities $rpgEntityTarget): bool
    {
        // On v??rifit si les points de vie de la cible ou de mon $this sont inf??rieur ou ??gale ?? 0
        // Si oui, on arr??te de suite la fonction
        if ($rpgEntityTarget->isDead() || $this->isDead()) {
            return false;
        }
        // get_class : renvoie le nom de la classe en param??tre sous forme de chaine de caract??res
        $name = get_class($this);
        // instanceof permet de conna??tre le type de l'objet qui le suit
        if ($this instanceof Hero) {
            $name = $this->getName();
        }
        $nameTarget = get_class($rpgEntityTarget);
        if ($rpgEntityTarget instanceof Hero) {
            $nameTarget = $rpgEntityTarget->getName();
        }
        if (isset($this->ability)) { // ability non null
            if ($this->useAbility($rpgEntityTarget, $name, $nameTarget)) {
                return true;
            }
            $this->ability->setTurn($this->ability->getTurn() - 1);
        }
        // D??terminer les d??g??ts du h??ro courant (?? partir de ses damagesMin et Max)
        $damage = $this->getDamages();
        $isCritical = false;

        // D??terminer si le h??ro courant critique ou non (?? partir de l'attribut scoreCriticalStrike)
        // mt_rand : permet d'avoir un nombre al??atoire compris entre les 2 nombres, mais il inclue les float
        if (mt_rand(1, 100) <= $this->scoreCriticalStrike) {
            $damage *= $this->criticalDamage;
            $isCritical = true;
        }

        // D??terminer la r??duction de la d??fense de $rpgEntity (d??fense est en % !!!)
        // D??terminer les d??g??ts inflig?? apr??s r??duction de la d??fense
        $damage *= $rpgEntityTarget->getCoefficientDefense();

        // R??duire les points de vie de $rpgEntity du montant de d??g??t inflig??s
        $rpgEntityTarget->hp -= $damage;

        // Affichage de l'information des d??g??ts
        $string = $name . ' a attaqu?? ' . $nameTarget . ' pour ' . $damage . ' d??g??ts (Il reste ' . $rpgEntityTarget->hp . ' ?? ' . $nameTarget . ')';
        if ($isCritical) {
            $string .= '(Coup critique !)';
        }
        echo $string . '<br>';
        return true;
    }

    /**
     * @param RpgEntity $rpgEntityTarget
     * @param string $name
     * @param string $nameTarget
     * @return bool
     */
    private function useAbility(RpgEntities $rpgEntityTarget, string $name, string $nameTarget): bool
    {
        if ($this->ability->getTurn() === 0 && $this->ability->getManaCost() <= $this->mana) {
            $this->ability->setTurn(3);
            $rpgEntityTarget->hp -= $this->ability->getDamage();
            $this->mana -= $this->ability->getManaCost();
            $string = $name . ' a attaqu?? ' . $nameTarget . ' pour ' . $this->ability->getDamage() . ' d??g??ts avec '. $this->ability->getName().'(Il reste ' . $rpgEntityTarget->hp . ' ?? ' . $nameTarget . ')<br>';
            echo $string;
            return true;
        }

        return false;

    }



}