<?php

namespace App\DTO;

use Illuminate\Support\Collection;

class NewsDTOCollection
{
    public static function fromCollection(Collection $data)
    {
        $collection = [];
        foreach ($data as $item) {
            $collection[] = NewsDTO::make($item);
        }

        return $collection;
    }
}
