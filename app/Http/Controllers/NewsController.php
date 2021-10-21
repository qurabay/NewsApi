<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\CreateRequest;
use App\Http\Resources\News\NewsCollection;
use App\Http\Resources\News\NewsResource;
use App\UseCases\News\NewsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Exception;
use Psy\Util\Json;

class NewsController extends Controller
{


    private NewsService $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function store(CreateRequest $request): JsonResponse
    {
        try {
            $news = $this->service->create($request);
            return $this->responseSuccess(null,'Успешно добавлено');
        }catch (Exception $exception) {
            return $this->responseError('','Ошибка попробуйте позже');
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $news = $this->service->getById($id);

        if ($news) {
            return $this->responseSuccess(new NewsResource($news));
        }
        return $this->responseError(null,'Ничего не найдено',Response::HTTP_NOT_FOUND);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getByTag($id): JsonResponse
    {
        $news = $this->service->getByTag($id);

        if ($news) {
            return $this->responseSuccess(new NewsCollection($news));
        }
        return $this->responseError(null,'Ничего не найдено');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getByAuthor($id): JsonResponse
    {

        $news = $this->service->getByAuthor($id);

        if ($news) {
            return $this->responseSuccess(new NewsCollection($news));
        }
        return $this->responseError(null,'Ничего не найдено');
    }



}
