<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Investments\OutInvestment\OutInvestmentRequest;
use App\Http\Requests\Admin\Investments\OutInvestment\UpdateOutInvestmentRequest;
use App\Models\Investments\OutInvestment;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;

class OutInvestmentController extends Controller
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
        $outInvestments = OutInvestment::latest()->paginate(self::PAGINATE);
        return view('admin.investments.outInvestments.index', compact('outInvestments'));
    }

    public function create()
    {
        return view('admin.investments.outInvestments.create');
    }

    public function store(OutInvestmentRequest $request)
    {
        try {
            OutInvestment::create([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'client_photo' => uploadImage('investments', $request->file('client_photo')),
                'income_details' => $request->income_details,
                'paid_amount' => $request->paid_amount,
                'total_amount' => $request->total_amount
            ]);

            return $this->redirectIfSuccess('admin.investments.out_investments');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.out_investments');
        }
    }

    public function edit(int $id)
    {
        try {
            $outInvestment = OutInvestment::findOrFail($id);
            if (!isset($outInvestment)) {
                return $this->redirectIfNotFound('admin.investments.out_investments');
            }
            return view('admin.investments.outInvestments.edit', compact('outInvestment'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.out_investments');
        }
    }

    public function update(UpdateOutInvestmentRequest $request, int $id)
    {
        try {
            $outInvestment = OutInvestment::findOrFail($id);
            if (!isset($outInvestment)) {
                return $this->redirectIfNotFound('admin.investments.out_investments');
            }
            $outInvestment->update([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'income_details' => $request->income_details,
                'paid_amount' => $request->paid_amount,
                'total_amount' => $request->total_amount
            ]);
            if ($request->has('client_photo')) {
                $old_photo = $outInvestment->getPhoto();
                // remove old image
                removeImage($old_photo);
                $outInvestment->update([
                    'client_photo' => uploadImage('investments', $request->file('client_photo')),
                ]);
            }
            return $this->redirectIfSuccess('admin.investments.out_investments', 'تم تعديل البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.out_investments');
        }
    }

    public function destroy(int $id)
    {
        try {
            $outInvestment = OutInvestment::findOrFail($id);
            if (!isset($outInvestment)) {
                return $this->redirectIfNotFound('admin.investments.out_investments');
            }
            $outInvestment->delete();
            $old_photo = $outInvestment->getPhoto();
            // remove old image
            removeImage($old_photo);
            return $this->redirectIfSuccess('admin.investments.out_investments', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.out_investments');
        }
    }
}
