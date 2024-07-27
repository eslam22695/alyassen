<?php


namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductService extends BaseService
{
  private $categoryRepository;

  public function __construct(ProductRepository $repository, CategoryRepository $categoryRepository, Request $request)
  {
    parent::__construct($repository, $request);
    $this->categoryRepository = $categoryRepository;
  }

  public function getFormData()
  {
      return ['categories' => $this->categoryRepository->pluck('title', 'id')];
  }

  public function store($data)
  {
    $record = $this->repository->create($data);

    return $record;
  }
}