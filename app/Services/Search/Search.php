<?php

namespace App\Services\Search;

use Illuminate\Support\Facades\DB;

class Search implements SearchInterface
{

    protected $filterData;
    protected $query;

    public function __construct($filterData)
    {

        $this->query = DB::table('news')
                       ->leftJoin('news_tags','news.id','=','news_tags.news_id')
                       ->leftJoin('tags','news_tags.tag_id','=','tags.id')
                       ->select('news.title as news_title','tags.name as tag_name','news.published_at');

        $this->filterData = $filterData;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getFilterData()
    {
        return $this->filterData;
    }
}
