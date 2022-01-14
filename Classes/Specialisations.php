<?php

namespace Classes;
class Specialisations
{
    private $specialisation_id;
    private $specialisation_name;
    private $profession_prof_id;

    /**
     * @return mixed
     */
    public function getSpecialisationId()
    {
        return $this->specialisation_id;
    }

    /**
     * @param mixed $specialisation_id
     */
    public function setSpecialisationId($specialisation_id): void
    {
        $this->specialisation_id = $specialisation_id;
    }

    /**
     * @return mixed
     */
    public function getSpecialisationName()
    {
        return $this->specialisation_name;
    }

    /**
     * @param mixed $specialisation_name
     */
    public function setSpecialisationName($specialisation_name): void
    {
        $this->specialisation_name = $specialisation_name;
    }

    /**
     * @return mixed
     */
    public function getProfessionProfId()
    {
        return $this->profession_prof_id;
    }

    /**
     * @param mixed $profession_prof_id
     */
    public function setProfessionProfId($profession_prof_id): void
    {
        $this->profession_prof_id = $profession_prof_id;
    }


}