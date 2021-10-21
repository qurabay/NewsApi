<?php

namespace App\Http\Controllers;

use App\Services\Search\Search;
use App\Services\Search\SearchNews;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $search = new Search($request);
        $search = new SearchNews($search);

        $result = $search->getQuery()->get();

        if ($result) {
            return $this->responseSuccess($result);
        }

        return $this->responseError('','Ничего не найдено', Response::HTTP_NOT_FOUND);
    }
}
