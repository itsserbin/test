<?php

namespace App\Contracts;

interface BaseDTOInterface
{
    public function toArray(): array;

    public function toJson(): string;
}
