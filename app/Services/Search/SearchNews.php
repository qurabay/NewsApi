<?php

namespace App\Services\Search;

class SearchNews implements SearchInterface
{

    protected $filterData;
    protected $query;

    public function __construct(SearchInterface $filterData)
    {
        $this->query = $filterData->getQuery();
        $this->filterData = $filterData->getFilterData();
    }

    public function getQuery()
    {
        $this->query = $this->query
                       ->where('news.title', 'LIKE','%'.$this->filterData['query'].'%')
                       ->orWhere('tags.name','LIKE','%'.$this->filterData['query'].'%');

        return $this->query;
    }


    public function getFilterData()
    {
        // TODO: Implement getFilterData() method.
    }
}
