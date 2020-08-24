<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Investments\Rent\RentRequest;
use App\Http\Requests\Admin\Investments\Rent\UpdateRentRequest;
use App\Models\Product;
use App\Models\Investments\Rent;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;

class RentController extends Controller
{
    use ErrorHandlerTrait;

    private const PAGINATE = RouteServiceProvider::PAGINATE_LIMIT;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:read_investments')->only('index');
        $this->middleware('permission:create_investments')->only('create');
        $this->middleware('permission:update_investments')->only('edit');
        $this->middleware('permission:delete_investments')->only('destroy');
    }

    public function index()
    {
        $rents = Rent::latest()->paginate(self::PAGINATE);
        return view('admin.investments.rents.index', compact('rents'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.investments.rents.create', compact('products'));
    }

    public function store(RentRequest $request)
    {
        try {
            Rent::create([
                'product_id' => $request->product,
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'contract_type' => $request->contract_type,
                'price' => $request->price,
            ]);

            return $this->redirectIfSuccess('admin.investments.rents');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.rents');
        }
    }

    public function edit(int $id)
    {
        try {
            $products = Product::all();
            $rent = Rent::findOrFail($id);
            if (!isset($rent)) {
                return $this->redirectIfNotFound('admin.investments.rents');
            }
            return view('admin.investments.rents.edit', compact('products', 'rent'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.rents');
        }
    }

    public function update(UpdateRentRequest $request, int $id)
    {
        try {
            $rent = Rent::findOrFail($id);
            if (!isset($rent)) {
                return $this->redirectIfNotFound('admin.investments.rents');
            }
            $rent->update([
                'product_id' => $request->product,
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'contract_type' => $request->contract_type,
                'price' => $request->price,
            ]);
            return $this->redirectIfSuccess('admin.investments.rents', 'تم تعديل البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.rents');
        }
    }

    public function destroy(int $id)
    {
        try {
            $rent = Rent::findOrFail($id);
            if (!isset($rent)) {
                return $this->redirectIfNotFound('admin.investments.rents');
            }
            $rent->delete();
            return $this->redirectIfSuccess('admin.investments.rents', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.rents');
        }
    }
}
