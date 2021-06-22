<?php


class Easy
{

    private array $ennemies;
    private object $enemy1;
    private object $enemy2;
    private object $enemy3;


    public function __construct($enemy1, $enemy2, $enemy3) {
        $this->ennemies = [$enemy1, $enemy2, $enemy3];
    }

    /**
     * @return array
     */
    public function getEnnemies(): array
    {
        return $this->ennemies;
    }

    /**
     * @param array
     */
    public function setEnnemies(array $ennemies): void
    {
        $this->ennemies = $ennemies;
    }

}
