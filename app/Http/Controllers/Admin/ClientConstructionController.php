<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Construction\Client\UpdateRequest;
use App\Http\Requests\Admin\Construction\Client\StoreRequest;
use App\Models\Constructions\ClientConstruction;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;
use App\Traits\UploadImageTrait;

class ClientConstructionController extends Controller
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
        $clientConstructions = ClientConstruction::latest()->paginate(self::PAGINATE);
        return view('admin.constructions.clients.index', compact('clientConstructions'));
    }

    public function create()
    {
        return view('admin.constructions.clients.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            ClientConstruction::create([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'project_address' => $request->project_address,
                'project_details' => $request->project_details,
                'paid_amount' => $request->paid_amount,
                'reaming_amount' => $request->reaming_amount,
                'photos' => $this->uploadMultipleImages('clientsConstructions', $request->file('photos'))
            ]);
            return $this->redirectIfSuccess('admin.constructions.clients');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.constructions.clients');
        }
    }

    public function show(int $id)
    {
        try {
            $clientConstruction = ClientConstruction::findOrFail($id);
            if (!isset($clientConstruction)) {
                return $this->redirectIfNotFound('admin.constructions.clients');
            }
            return view('admin.constructions.clients.show', compact('clientConstruction'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.constructions.clients');
        }
    }

    public function edit(int $id)
    {
        try {
            $clientConstruction = ClientConstruction::findOrFail($id);
            if (!isset($clientConstruction)) {
                return $this->redirectIfNotFound('admin.constructions.clients');
            }
            return view('admin.constructions.clients.edit', compact('clientConstruction'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.constructions.clients');
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $clientConstruction = ClientConstruction::findOrFail($id);
            if (!isset($clientConstruction)) {
                return $this->redirectIfNotFound('admin.constructions.clients');
            }
            $clientConstruction->update([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'project_address' => $request->project_address,
                'project_details' => $request->project_details,
                'paid_amount' => $request->paid_amount,
                'reaming_amount' => $request->reaming_amount,
            ]);
            if ($request->has('photos')) {
                $old_images = $clientConstruction->photos;
                // Update new
                $clientConstruction->update([
                    'photos' => $this->uploadMultipleImages('clientsConstructions', $request->file('photos'))
                ]);
                // Remove old images
                $this->removeMultipleImages($old_images);
            }
            return $this->redirectIfSuccess('admin.constructions.clients');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.constructions.clients');
        }
    }

    public function destroy(int $id)
    {
        try {
            $clientConstruction = ClientConstruction::findOrFail($id);
            if (!isset($clientConstruction)) {
                return $this->redirectIfNotFound('admin.constructions.clients');
            }
            $clientConstruction->delete();
            $old_images = $clientConstruction->photos;
            // Remove old images
            $this->removeMultipleImages($old_images);
            return $this->redirectIfSuccess('admin.constructions.clients', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.constructions.clients');
        }
    }
}
