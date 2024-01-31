<?php

namespace App\Http\Controllers\Api;

use App\DTO\Category\ItemCategoryDTO;
use App\DTO\Category\ListCategoriesDTO;
use App\DTO\IdDTO;
use App\Http\Requests\Category\IdCategoryRequest;
use App\Http\Requests\Category\ItemCategoryRequest;
use App\Http\Requests\Category\ListCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoriesRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoriesController extends BaseController
{
    function __construct(
        protected readonly CategoriesRepository $categoriesRepository
    )
    {
        parent::__construct();
    }

    /**
     * @param ListCategoryRequest $request
     * @return JsonResponse
     */
    final function list(ListCategoryRequest $request): JsonResponse
    {
        $dto = (new ListCategoriesDTO(...$request->validated()))->toArray();
        $data = $this->categoriesRepository->list($dto);
        $resource = CategoryResource::collection($data);

        return $this->response([
            'success' => true,
            'data' => $resource
        ]);
    }

    /**
     * @param ItemCategoryRequest $request
     * @return JsonResponse
     */
    final public function create(ItemCategoryRequest $request): JsonResponse
    {
        $dto = (new ItemCategoryDTO(...$request->validated()))->toArray();
        $data = $this->categoriesRepository->create($dto);
        $resource = new CategoryResource($data);

        return $this->response([
            'success' => true,
            'data' => $resource
        ], Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @param ItemCategoryRequest $request
     * @return JsonResponse
     */
    final public function update(int $id, ItemCategoryRequest $request): JsonResponse
    {
        $dto = (new ItemCategoryDTO(...$request->validated()))->toArray();
        $data = $this->categoriesRepository->update($id, $dto);
        $resource = new CategoryResource($data);

        return $this->response([
            'success' => true,
            'data' => $resource
        ]);
    }

    /**
     * @param IdCategoryRequest $request
     * @return JsonResponse
     */
    final public function destroy(IdCategoryRequest $request): JsonResponse
    {
        $dto = (new IdDTO(...$request->validated()));
        $result = $this->categoriesRepository->destroy($dto->id);

        return $this->response([
            'success' => $result
        ]);
    }

    /**
     * @param IdCategoryRequest $request
     * @return JsonResponse
     */
    final public function show(IdCategoryRequest $request): JsonResponse
    {
        $dto = (new IdDTO(...$request->validated()));
        $data = $this->categoriesRepository->findById($dto->id);
        $resource = new CategoryResource($data);

        return $this->response([
            'success' => true,
            'data' => $resource
        ]);
    }
}
