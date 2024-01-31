<?php

namespace App\DTO;

class IdDTO extends BaseDTO
{
    function __construct(
        public readonly int $id,
    )
    {
    }
}
