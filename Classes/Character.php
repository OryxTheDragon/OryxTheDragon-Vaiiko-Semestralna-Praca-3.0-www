<?php

namespace Classes;
use character_id;

class Character
{
    private $character_id;
    private $user_id;
    private $nickname;
    private $character_prof_id;
    private $character_spec_id;
    private $character_race_id;
    private $character_gender_id;


    /**
     * @param character_id
     * @param $user_id
     * @param $nickname
     * @param $character_prof_id
     * @param $character_spec_id
     * @param $character_race_id
     */
    public function __construct($user_id, $nickname, $character_prof_id, $character_spec_id, $character_race_id, $character_gender_id)
    {
        $this->user_id = $user_id;
        $this->nickname = $nickname;
        $this->character_prof_id = $character_prof_id;
        $this->character_spec_id = $character_spec_id;
        $this->character_race_id = $character_race_id;
        $this->character_gender_id = $character_gender_id;
    }


    /**
     * @return integer
     */
    public function getCharacterRaceId()
    {
        return $this->character_race_id;
    }

    /**
     * @param integer $character_race_id
     */
    public function setCharacterRaceId($character_race_id): void
    {
        $this->character_race_id = $character_race_id;
    }

    /**
     * @return integer
     */
    public function getCharacter_id()
    {
        return $this->character_id;
    }

    /**
     * @param integer $character_id
     */
    public function setCharacter_id($character_id): void
    {
        $this->character_id = $character_id;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param integer $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     */
    public function setNickname($nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return integer
     */
    public function getCharacterprofId()
    {
        return $this->character_prof_id;
    }

    /**
     * @param integer $character_prof_id
     */
    public function setCharacterprofId($character_prof_id): void
    {
        $this->character_prof_id = $character_prof_id;
    }

    /**
     * @return integer
     */
    public function getCharacterSpecId()
    {
        return $this->character_spec_id;
    }

    /**
     * @param integer $character_spec_id
     */
    public function setCharacterSpecId($character_spec_id): void
    {
        $this->character_spec_id = $character_spec_id;
    }

    /**
     * @return integer
     */
    public function getCharacterGenderId()
    {
        return $this->character_gender_id;
    }

    /**
     * @param integer $character_gender_id
     */
    public function setCharacterGenderId($character_gender_id): void
    {
        $this->character_gender_id = $character_gender_id;
    }
}