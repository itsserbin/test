<?php

namespace App\Traits;

trait QueryDataResourcesTrait
{
    final public function selectQuery(array|null $items): array
    {
        $data = [];
        if (!empty($items)) {
            foreach ($items as $item) {
                $data[$item] = $this->resource[$item];
            }
        }
        return $data;
    }

    final public function withQuery(array|null $items): array
    {
        $data = [];
        if (!empty($items)) {
            foreach ($items as $item) {
                $param = explode(':', $item);
                if (count($param) === 2) {
                    foreach (explode(',', $param[1]) as $selectParam) {
                        $data[$param[0]][$selectParam] = $this->resource->{$param[0]}->{$selectParam};
                    }
                } else {
                    foreach ($this->resource->{$param[0]}->getAttributes() as $key => $value) {
                        $data[$param[0]][$key] = $value;
                    }
                }
            }
        }
        return $data;
    }
}
