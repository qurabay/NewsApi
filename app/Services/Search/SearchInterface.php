<?php

namespace App\Services\Search;

interface SearchInterface
{
    public function getQuery();

    public function getFilterData();
}
