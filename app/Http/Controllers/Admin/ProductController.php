<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;

class ProductController extends Controller
{
    use ErrorHandlerTrait;

    private const PAGINATE = RouteServiceProvider::PAGINATE_LIMIT;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:read_products')->only('index');
        $this->middleware('permission:create_products')->only('create');
        $this->middleware('permission:update_products')->only('edit');
        $this->middleware('permission:delete_products')->only('destroy');
    }

    public function index()
    {
        $products = Product::latest()->paginate(self::PAGINATE);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(ProductRequest $request)
    {
        try {
            Product::create([
                'name' => $request->name,
                'slug' => slug($request->name)
            ]);
            return $this->redirectIfSuccess('admin.products');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.products');
        }
    }

    public function edit(int $id)
    {
        try {
            $product = Product::findOrFail($id);
            if (isset($product)) {
                return view('admin.products.edit', compact('product'));
            }
            return $this->redirectIfNotFound('admin.products');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.products');
        }
    }

    public function update(UpdateProductRequest $request, int $id)
    {

        try {
            $product = Product::findOrFail($id);
            if (!isset($product)) {
                return $this->redirectIfNotFound('admin.products');
            }
            $product->update([
                'name' => $request->name,
                'slug' => slug($request->name)
            ]);
            return $this->redirectIfSuccess('admin.products', 'تم تعديل البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.products');
        }
    }

    public function destroy(int $id)
    {
        try {
            $product = Product::findOrFail($id);
            if (!isset($product)) {
                return $this->redirectIfNotFound('admin.products');
            }
            $product->delete();
            return $this->redirectIfSuccess('admin.products', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.products');
        }
    }
}
