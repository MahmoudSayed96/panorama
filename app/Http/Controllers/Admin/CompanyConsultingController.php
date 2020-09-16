<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Consulting\Company\StoreRequest;
use App\Http\Requests\Admin\Consulting\Company\UpdateRequest;
use App\Models\Consulting\CompanyConsulting;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;
use App\Traits\UploadImageTrait;

class CompanyConsultingController extends Controller
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
        $cmpConsulting = CompanyConsulting::latest()->paginate(self::PAGINATE);
        return view('admin.consulting.company.index', compact('cmpConsulting'));
    }

    public function create()
    {
        return view('admin.consulting.company.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            CompanyConsulting::create([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'project_name' => $request->project_name,
                'project_number' => $request->project_number,
                'piece_number' => $request->piece_number,
                'suk_number' => $request->suk_number,
                'details' => $request->details,
                'photos' => $this->uploadMultipleImages('companyConsulting', $request->file('photos'))
            ]);
            return $this->redirectIfSuccess('admin.consulting.company');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.consulting.company');
        }
    }

    public function show(int $id)
    {
        try {
            $cmpConsulting = CompanyConsulting::findOrFail($id);
            if (!isset($cmpConsulting)) {
                return $this->redirectIfNotFound('admin.consulting.company');
            }
            return view('admin.consulting.company.show', compact('cmpConsulting'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.consulting.company');
        }
    }

    public function edit(int $id)
    {
        try {
            $cmpConsulting = CompanyConsulting::findOrFail($id);
            if (!isset($cmpConsulting)) {
                return $this->redirectIfNotFound('admin.consulting.company');
            }
            return view('admin.consulting.company.edit', compact('cmpConsulting'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.consulting.company');
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $cmpConsulting = CompanyConsulting::findOrFail($id);
            if (!isset($cmpConsulting)) {
                return $this->redirectIfNotFound('admin.consulting.company');
            }
            $cmpConsulting->update([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'project_name' => $request->project_name,
                'project_number' => $request->project_number,
                'piece_number' => $request->piece_number,
                'suk_number' => $request->suk_number,
                'details' => $request->details,
            ]);
            if ($request->has('photos')) {
                $old_images = $cmpConsulting->photos;
                // Update new
                $cmpConsulting->update([
                    'photos' => $this->uploadMultipleImages('companyConsulting', $request->file('photos'))
                ]);
                // Remove old images
                $this->removeMultipleImages($old_images);
            }
            return $this->redirectIfSuccess('admin.consulting.company');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.consulting.company');
        }
    }

    public function destroy(int $id)
    {
        try {
            $cmpConsulting = CompanyConsulting::findOrFail($id);
            if (!isset($cmpConsulting)) {
                return $this->redirectIfNotFound('admin.consulting.company');
            }
            $cmpConsulting->delete();
            $old_images = $cmpConsulting->photos;
            // Remove old images
            $this->removeMultipleImages($old_images);
            return $this->redirectIfSuccess('admin.consulting.company', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.consulting.company');
        }
    }
}
