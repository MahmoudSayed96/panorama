<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Decorations\CompanyDecoration\StoreRequest;
use App\Http\Requests\Admin\Decorations\CompanyDecoration\UpdateRequest;
use App\Models\Decoration\CompanyDecoration;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;

class CompanyDecorationController extends Controller
{

    use ErrorHandlerTrait;

    private const PAGINATE = RouteServiceProvider::PAGINATE_LIMIT;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:read_decorations')->only('index');
        $this->middleware('permission:create_decorations')->only('create');
        $this->middleware('permission:update_decorations')->only('edit');
        $this->middleware('permission:delete_decorations')->only('destroy');
    }

    public function index()
    {
        $cmpDecorations = CompanyDecoration::latest()->paginate(self::PAGINATE);
        return view('admin.decorations.company.index', compact('cmpDecorations'));
    }

    public function create()
    {
        return view('admin.decorations.company.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            CompanyDecoration::create([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'paid_amount' => $request->paid_amount,
                'delivered_date' => $request->delivered_date,
                'photos' => uploadMultipleImages('cmpDecorations', $request->file('photos'))
            ]);
            return $this->redirectIfSuccess('admin.decorations.company');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.decorations.company');
        }
    }

    public function show(int $id)
    {
        try {
            $cmpDecoration = CompanyDecoration::findOrFail($id);
            if (!isset($cmpDecoration)) {
                return $this->redirectIfNotFound('admin.decorations.company');
            }
            return view('admin.decorations.company.show', compact('cmpDecoration'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.decorations.company');
        }
    }

    public function edit(int $id)
    {
        try {
            $cmpDecoration = CompanyDecoration::findOrFail($id);
            if (!isset($cmpDecoration)) {
                return $this->redirectIfNotFound('admin.decorations.company');
            }
            return view('admin.decorations.company.edit', compact('cmpDecoration'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.decorations.company');
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $cmpDecoration = CompanyDecoration::findOrFail($id);
            if (!isset($cmpDecoration)) {
                return $this->redirectIfNotFound('admin.decorations.company');
            }
            $cmpDecoration->update([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'paid_amount' => $request->paid_amount,
                'delivered_date' => $request->delivered_date,
            ]);
            if ($request->has('photos')) {
                $old_images = $cmpDecoration->photos;
                // Update new
                $cmpDecoration->update([
                    'photos' => uploadMultipleImages('cmpDecorations', $request->file('photos'))
                ]);
                // Remove old images
                removeMultipleImages($old_images);
            }
            return $this->redirectIfSuccess('admin.decorations.company');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.decorations.company');
        }
    }

    public function destroy(int $id)
    {
        try {
            $cmpDecoration = CompanyDecoration::findOrFail($id);
            if (!isset($cmpDecoration)) {
                return $this->redirectIfNotFound('admin.decorations.company');
            }
            $cmpDecoration->delete();
            $old_images = $cmpDecoration->photos;
            // Remove old images
            removeMultipleImages($old_images);
            return $this->redirectIfSuccess('admin.decorations.company', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.decorations.company');
        }
    }
}
