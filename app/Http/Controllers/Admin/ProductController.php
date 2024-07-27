<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{
    public function __construct(ProductService $service)
    {
        parent::__construct($service);

        $this->middleware(['permission:product-list|product-create|product-edit|product-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:product-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:product-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:product-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->service->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->service->getFormData();
        return view('admin.product.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $request->validated();
        $created_product = $this->service->store($product);

        if (count($product['categories']) > 0) {
            $created_product->categories()->sync($product['categories']);
        }

        $created_product->stocks->create([
            'in_stock' => $product['in_stock'],
            'description' => 'الكمية الافتتاحية',
            'date' => date('Y-m-d'),
            'product_id' => $created_product->id,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with(['success' => 'Added Successfully']);
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->service->show($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->service->show($id);
        $data = $this->service->getFormData();
        return view('admin.product.edit', compact('product','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = $request->validated();
        $updated_product = $this->service->update($id, $product);
        if (count($product['categories']) > 0) {
            $updated_product->categories()->sync($product['categories']);
        }
        return redirect()->back()->with(['success' => 'Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect(route('admin.product.index'))->with(['success' => 'Deleted Successfully']);
    }
}
