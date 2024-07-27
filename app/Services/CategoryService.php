<?php


namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryService extends BaseService
{

  public function __construct(CategoryRepository $repository, Request $request)
  {
    parent::__construct($repository, $request);
  }
}