<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\CreateRequest;
use App\Http\Requests\Author\UploadFileRequest;
use App\Http\Resources\Author\AuthorCollection;
use App\UseCases\Authors\AuthorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    private AuthorService $service;

    public function __construct(AuthorService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $authors = $this->service->list();

        if ($authors) {
            return $this->responseSuccess(new AuthorCollection($authors));
        }
        return $this->responseError(null,'Ничего не найдено');
    }


    /**
     * @param CreateRequest $request
     * @return JsonResponse
     *
     */
    public function store(CreateRequest $request): JsonResponse
    {
        try {
            $author =  $this->service->create($request);
            return $this->responseSuccess($author);
        }catch (\Exception $exception) {
            return $this->responseError(null,'Попробуйте позже');

        }
    }

    /**
     * @param UploadFileRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function upload(UploadFileRequest $request,$id): JsonResponse
    {
        try {
            $this->service->addPhotos($id,$request);
            return $this->responseSuccess('','Успешно загружено!');
        }catch (\Exception $exception) {
            return $this->responseError(null,'Попробуйте позже');

        }
    }


}
