<?php

namespace Classes;
class Professions
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProfessionName()
    {
        return $this->profession_name;
    }

    /**
     * @param mixed $profession_name
     */
    public function setProfessionName($profession_name): void
    {
        $this->profession_name = $profession_name;
    }

    private $profession_name;

}