<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Advertising\Company\StoreRequest;
use App\Http\Requests\Admin\Advertising\Company\UpdateRequest;
use App\Models\Advertising\CompanyDesign;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;
use App\Traits\UploadImageTrait;

class CompanyDesignController extends Controller
{
    use ErrorHandlerTrait, UploadImageTrait;

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
        $cmpDesigns = CompanyDesign::latest()->paginate(self::PAGINATE);
        return view('admin.advertising.company.index', compact('cmpDesigns'));
    }

    public function create()
    {
        return view('admin.advertising.company.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            CompanyDesign::create([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'paid_amount' => $request->paid_amount,
                'delivered_date' => $request->delivered_date,
                'photos' => $this->uploadMultipleImages('cmpDesigns', $request->file('photos'))
            ]);
            return $this->redirectIfSuccess('admin.advertising.company');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.advertising.company');
        }
    }

    public function show(int $id)
    {
        try {
            $cmpDesign = CompanyDesign::findOrFail($id);
            if (!isset($cmpDesign)) {
                return $this->redirectIfNotFound('admin.advertising.company');
            }
            return view('admin.advertising.company.show', compact('cmpDesign'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.advertising.company');
        }
    }

    public function edit(int $id)
    {
        try {
            $cmpDesign = CompanyDesign::findOrFail($id);
            if (!isset($cmpDesign)) {
                return $this->redirectIfNotFound('admin.advertising.company');
            }
            return view('admin.advertising.company.edit', compact('cmpDesign'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.advertising.company');
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $cmpDesign = CompanyDesign::findOrFail($id);
            if (!isset($cmpDesign)) {
                return $this->redirectIfNotFound('admin.advertising.company');
            }
            $cmpDesign->update([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'paid_amount' => $request->paid_amount,
                'delivered_date' => $request->delivered_date,
            ]);
            if ($request->has('photos')) {
                $old_images = $cmpDesign->photos;
                // Update new
                $cmpDesign->update([
                    'photos' => $this->uploadMultipleImages('cmpDesigns', $request->file('photos'))
                ]);
                // Remove old images
                $this->removeMultipleImages($old_images);
            }
            return $this->redirectIfSuccess('admin.advertising.company');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.advertising.company');
        }
    }

    public function destroy(int $id)
    {
        try {
            $cmpDesign = CompanyDesign::findOrFail($id);
            if (!isset($cmpDesign)) {
                return $this->redirectIfNotFound('admin.advertising.company');
            }
            $cmpDesign->delete();
            $old_images = $cmpDesign->photos;
            // Remove old images
            $this->removeMultipleImages($old_images);
            return $this->redirectIfSuccess('admin.advertising.company', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.advertising.company');
        }
    }
}
