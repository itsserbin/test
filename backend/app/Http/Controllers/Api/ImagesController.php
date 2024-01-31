<?php

namespace App\Http\Controllers\Api;

use App\DTO\Image\UploadImageDTO;
use App\Http\Requests\Image\UploadImageRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\ImagesRepository;
use App\Services\ImagesService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ImagesController extends BaseController
{
    function __construct(
        protected readonly ImagesRepository $imagesRepository,
        protected readonly ImagesService $imagesService
    )
    {
        parent::__construct();
    }

    final function upload(UploadImageRequest $request): JsonResponse
    {
        $dto = (new UploadImageDTO(...$request->validated()))->toArray();
        $this->imagesService->uploadImage($dto['image']);
        dd('asd');
        $data = $this->imagesRepository->list($dto);
        $resource = CategoryResource::collection($data);

        return $this->response([
            'success' => true,
            'data' => $resource
        ]);
    }
}
