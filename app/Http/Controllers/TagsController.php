<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\CreateRequest;
use App\UseCases\Tags\TagsService;

class TagsController extends Controller
{
    private TagsService $service;

    public function __construct(TagsService $service)
    {
        $this->service = $service;
    }

    public function store(CreateRequest $request)
    {
        try {

            $this->service->create($request);
            return $this->responseSuccess('','Успешно добавлено');
        }catch (\Exception $exception) {
            return $this->responseError($exception,'Ошибка попробуйте позже');
        }
    }

}
