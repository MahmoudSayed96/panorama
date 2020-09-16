<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Consulting\Client\StoreRequest;
use App\Http\Requests\Admin\Consulting\Client\UpdateRequest;
use App\Models\Consulting\ClientConsulting;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;
use App\Traits\UploadImageTrait;

class ClientConsultingController extends Controller
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
        $clientConsulting = ClientConsulting::latest()->paginate(self::PAGINATE);
        return view('admin.consulting.clients.index', compact('clientConsulting'));
    }

    public function create()
    {
        return view('admin.consulting.clients.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            ClientConsulting::create([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'project_name' => $request->project_name,
                'project_number' => $request->project_number,
                'piece_number' => $request->piece_number,
                'suk_number' => $request->suk_number,
                'details' => $request->details,
                'photos' => $this->uploadMultipleImages('clientsConsulting', $request->file('photos'))
            ]);
            return $this->redirectIfSuccess('admin.consulting.clients');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.consulting.clients');
        }
    }

    public function show(int $id)
    {
        try {
            $clientConsulting = ClientConsulting::findOrFail($id);
            if (!isset($clientConsulting)) {
                return $this->redirectIfNotFound('admin.consulting.clients');
            }
            return view('admin.consulting.clients.show', compact('clientConsulting'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.consulting.clients');
        }
    }

    public function edit(int $id)
    {
        try {
            $clientConsulting = ClientConsulting::findOrFail($id);
            if (!isset($clientConsulting)) {
                return $this->redirectIfNotFound('admin.consulting.clients');
            }
            return view('admin.consulting.clients.edit', compact('clientConsulting'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.consulting.clients');
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $clientConsulting = ClientConsulting::findOrFail($id);
            if (!isset($clientConsulting)) {
                return $this->redirectIfNotFound('admin.consulting.clients');
            }
            $clientConsulting->update([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'project_name' => $request->project_name,
                'project_number' => $request->project_number,
                'piece_number' => $request->piece_number,
                'suk_number' => $request->suk_number,
                'details' => $request->details,
            ]);
            if ($request->has('photos')) {
                $old_images = $clientConsulting->photos;
                // Update new
                $clientConsulting->update([
                    'photos' => $this->uploadMultipleImages('clientsConsulting', $request->file('photos'))
                ]);
                // Remove old images
                $this->removeMultipleImages($old_images);
            }
            return $this->redirectIfSuccess('admin.consulting.clients');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.consulting.clients');
        }
    }

    public function destroy(int $id)
    {
        try {
            $clientConsulting = ClientConsulting::findOrFail($id);
            if (!isset($clientConsulting)) {
                return $this->redirectIfNotFound('admin.consulting.clients');
            }
            $clientConsulting->delete();
            $old_images = $clientConsulting->photos;
            // Remove old images
            $this->removeMultipleImages($old_images);
            return $this->redirectIfSuccess('admin.consulting.clients', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.consulting.clients');
        }
    }
}
