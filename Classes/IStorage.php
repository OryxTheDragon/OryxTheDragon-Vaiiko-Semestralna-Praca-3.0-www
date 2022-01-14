<?php

namespace Classes;

interface IStorage
{
    public function getAllData();

    public function createUser(User $user);
}