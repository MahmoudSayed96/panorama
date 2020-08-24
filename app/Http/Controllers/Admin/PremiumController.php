<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Investments\Premium\PremiumRequest;
use App\Http\Requests\Admin\Investments\Premium\UpdatePremiumRequest;
use App\Models\Investments\Premium;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;

class PremiumController extends Controller
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
        $premiums = Premium::latest()->paginate(self::PAGINATE);
        return view('admin.investments.premiums.index', compact('premiums'));
    }

    public function create()
    {
        return view('admin.investments.premiums.create');
    }

    public function store(PremiumRequest $request)
    {
        try {
            Premium::create([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'details' => $request->details,
                'alqist_amount' => $request->alqist_amount,
                'remaining_amount' => $request->remaining_amount,
                'end_amount_date' => $request->end_amount_date,
            ]);

            return $this->redirectIfSuccess('admin.investments.premiums');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.premiums');
        }
    }

    public function edit(int $id)
    {
        try {
            $premium = Premium::findOrFail($id);
            if (!isset($premium)) {
                return $this->redirectIfNotFound('admin.investments.premiums');
            }
            return view('admin.investments.premiums.edit', compact('premium'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.premiums');
        }
    }

    public function update(UpdatePremiumRequest $request, int $id)
    {
        try {
            $premium = Premium::findOrFail($id);
            if (!isset($premium)) {
                return $this->redirectIfNotFound('admin.investments.premiums');
            }
            $premium->update([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'details' => $request->details,
                'alqist_amount' => $request->alqist_amount,
                'remaining_amount' => $request->remaining_amount,
                'end_amount_date' => $request->end_amount_date,
            ]);
            return $this->redirectIfSuccess('admin.investments.premiums', 'تم تعديل البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.premiums');
        }
    }

    public function destroy(int $id)
    {
        try {
            $premium = Premium::findOrFail($id);
            if (!isset($premium)) {
                return $this->redirectIfNotFound('admin.investments.premiums');
            }
            $premium->delete();
            return $this->redirectIfSuccess('admin.investments.premiums', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.investments.premiums');
        }
    }
}
