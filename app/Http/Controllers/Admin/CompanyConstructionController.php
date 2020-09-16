<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Construction\Company\StoreRequest;
use App\Http\Requests\Admin\Construction\Company\UpdateRequest;
use App\Models\Constructions\CompanyConstruction;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;
use App\Traits\UploadImageTrait;

class CompanyConstructionController extends Controller
{
    use ErrorHandlerTrait, UploadImageTrait;

    private const PAGINATE = RouteServiceProvider::PAGINATE_LIMIT;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:read_consulting')->only('index');
        $this->middleware('permission:create_consulting')->only('create');
        $this->middleware('permission:update_consulting')->only('edit');
        $this->middleware('permission:delete_consulting')->only('destroy');
    }

    public function index()
    {
        $cmpConstructions = CompanyConstruction::latest()->paginate(self::PAGINATE);
        return view('admin.constructions.company.index', compact('cmpConstructions'));
    }

    public function create()
    {
        return view('admin.constructions.company.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            CompanyConstruction::create([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'project_address' => $request->project_address,
                'project_details' => $request->project_details,
                'paid_amount' => $request->paid_amount,
                'reaming_amount' => $request->reaming_amount,
                'photos' => $this->uploadMultipleImages('companyConstructions', $request->file('photos'))
            ]);
            return $this->redirectIfSuccess('admin.constructions.company');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.constructions.company');
        }
    }

    public function show(int $id)
    {
        try {
            $cmpConstruction = CompanyConstruction::findOrFail($id);
            if (!isset($cmpConstruction)) {
                return $this->redirectIfNotFound('admin.constructions.company');
            }
            return view('admin.constructions.company.show', compact('cmpConstruction'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.constructions.company');
        }
    }

    public function edit(int $id)
    {
        try {
            $cmpConstruction = CompanyConstruction::findOrFail($id);
            if (!isset($cmpConstruction)) {
                return $this->redirectIfNotFound('admin.constructions.company');
            }
            return view('admin.constructions.company.edit', compact('cmpConstruction'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.constructions.company');
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $cmpConstruction = CompanyConstruction::findOrFail($id);
            if (!isset($cmpConstruction)) {
                return $this->redirectIfNotFound('admin.constructions.company');
            }
            $cmpConstruction->update([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'project_address' => $request->project_address,
                'project_details' => $request->project_details,
                'paid_amount' => $request->paid_amount,
                'reaming_amount' => $request->reaming_amount,
            ]);
            if ($request->has('photos')) {
                $old_images = $cmpConstruction->photos;
                // Update new
                $cmpConstruction->update([
                    'photos' => $this->uploadMultipleImages('companyConstructions', $request->file('photos'))
                ]);
                // Remove old images
                $this->removeMultipleImages($old_images);
            }
            return $this->redirectIfSuccess('admin.constructions.company');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.constructions.company');
        }
    }

    public function destroy(int $id)
    {
        try {
            $cmpConstruction = CompanyConstruction::findOrFail($id);
            if (!isset($cmpConstruction)) {
                return $this->redirectIfNotFound('admin.constructions.company');
            }
            $cmpConstruction->delete();
            $old_images = $cmpConstruction->photos;
            // Remove old images
            $this->removeMultipleImages($old_images);
            return $this->redirectIfSuccess('admin.constructions.company', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.constructions.company');
        }
    }
}
