<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sales\Company\CompanyRequest;
use App\Http\Requests\Admin\Sales\Company\UpdateCompanyRequest;
use App\Models\Product;
use App\Models\Sales\CompanySales;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;

class CompanySalesController extends Controller
{
    use ErrorHandlerTrait;

    private const PAGINATE = RouteServiceProvider::PAGINATE_LIMIT;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:read_sales')->only('index');
        $this->middleware('permission:create_sales')->only('create');
        $this->middleware('permission:update_sales')->only('edit');
        $this->middleware('permission:delete_sales')->only('destroy');
    }

    public function index()
    {
        $companySales = CompanySales::latest()->paginate(self::PAGINATE);
        return view('admin.sales.company.index', compact('companySales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.sales.company.create', compact('products'));
    }

    public function store(CompanyRequest $request)
    {
        try {
            CompanySales::create([
                'product_id' => $request->product,
                'buyer_name' => $request->buyer_name,
                'buyer_phone' => $request->buyer_phone,
                'price' => $request->price,
            ]);

            return $this->redirectIfSuccess('admin.sales.company');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.sales.company');
        }
    }

    public function edit(int $id)
    {
        try {
            $products = Product::all();
            $company = CompanySales::findOrFail($id);
            if (!isset($company)) {
                return $this->redirectIfNotFound('admin.sales.company');
            }
            return view('admin.sales.company.edit', compact('products', 'company'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.sales.company');
        }
    }

    public function update(UpdateCompanyRequest $request, int $id)
    {
        try {
            $company = CompanySales::findOrFail($id);
            if (!isset($company)) {
                return $this->redirectIfNotFound('admin.sales.company');
            }
            $company->update([
                'product_id' => $request->product,
                'buyer_name' => $request->buyer_name,
                'buyer_phone' => $request->buyer_phone,
                'price' => $request->price,
            ]);
            return $this->redirectIfSuccess('admin.sales.company', 'تم تعديل البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.sales.company');
        }
    }

    public function destroy(int $id)
    {
        try {
            $company = CompanySales::findOrFail($id);
            if (!isset($company)) {
                return $this->redirectIfNotFound('admin.sales.company');
            }
            $company->delete();
            return $this->redirectIfSuccess('admin.sales.company', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.sales.company');
        }
    }
}
