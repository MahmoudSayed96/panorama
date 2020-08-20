<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sales\OutCompany\OutCompanyRequest;
use App\Http\Requests\Admin\Sales\OutCompany\UpdateOutCompanyRequest;
use App\Models\Product;
use App\Models\Sales\OutCompanySales;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;

class OutCompanySalesController extends Controller
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
        $outCompanySales = OutCompanySales::latest()->paginate(self::PAGINATE);
        return view('admin.sales.outCompany.index', compact('outCompanySales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.sales.outCompany.create', compact('products'));
    }

    public function store(OutCompanyRequest $request)
    {
        try {
            OutCompanySales::create([
                'product_id' => $request->product,
                'buyer_name' => $request->buyer_name,
                'buyer_phone' => $request->buyer_phone,
                'price' => $request->price,
                'indication' => $request->indication,
                'wasit' => $request->wasit,
            ]);

            return $this->redirectIfSuccess('admin.sales.out_company');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.sales.out_company');
        }
    }

    public function edit(int $id)
    {
        try {
            $products = Product::all();
            $outCompany = OutCompanySales::findOrFail($id);
            if (!isset($outCompany)) {
                return $this->redirectIfNotFound('admin.sales.out_company');
            }
            return view('admin.sales.outCompany.edit', compact('products', 'outCompany'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.sales.out_company');
        }
    }

    public function update(UpdateOutCompanyRequest $request, int $id)
    {
        try {
            $outCompany = OutCompanySales::findOrFail($id);
            if (!isset($outCompany)) {
                return $this->redirectIfNotFound('admin.sales.out_company');
            }
            $outCompany->update([
                'product_id' => $request->product,
                'buyer_name' => $request->buyer_name,
                'buyer_phone' => $request->buyer_phone,
                'price' => $request->price,
                'indication' => $request->indication,
                'wasit' => $request->wasit,
            ]);
            return $this->redirectIfSuccess('admin.sales.out_company', 'تم تعديل البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.sales.out_company');
        }
    }

    public function destroy(int $id)
    {
        try {
            $outCompany = OutCompanySales::findOrFail($id);
            if (!isset($outCompany)) {
                return $this->redirectIfNotFound('admin.sales.out_company');
            }
            $outCompany->delete();
            return $this->redirectIfSuccess('admin.sales.out_company', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.sales.out_company');
        }
    }
}
