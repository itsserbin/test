<?php

namespace App\DTO;

use App\Contracts\BaseDTOInterface;

class BaseDTO implements BaseDTOInterface
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
