<?php

namespace App\Domain\Interfaces;

interface IUserFactory
{
    /**
     * @param array $attributes
     */
    public function make(array $attributes = []): IUserEntity;
}

