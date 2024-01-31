<?php

namespace App\DTO\Category;

use App\DTO\BaseDTO;

class ListCategoriesDTO extends BaseDTO
{
    public function __construct(
        public readonly array       $with = [],
        public readonly array       $select = [],
        public readonly string|null $orderBy = null,
        public readonly string|null $orderType = null,
    )
    {
    }
}
