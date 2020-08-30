<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Advertising\Client\StoreRequest;
use App\Http\Requests\Admin\Advertising\Client\UpdateRequest;
use App\Models\Advertising\ClientDesign;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;

class ClientDesignController extends Controller
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
        $clientDesigns = ClientDesign::latest()->paginate(self::PAGINATE);
        return view('admin.advertising.clients.index', compact('clientDesigns'));
    }

    public function create()
    {
        return view('admin.advertising.clients.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            ClientDesign::create([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'paid_amount' => $request->paid_amount,
                'delivered_date' => $request->delivered_date,
                'photos' => uploadMultipleImages('clientsDesigns', $request->file('photos'))
            ]);
            return $this->redirectIfSuccess('admin.advertising.clients');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.advertising.clients');
        }
    }

    public function show(int $id)
    {
        try {
            $clientDesign = ClientDesign::findOrFail($id);
            if (!isset($clientDesign)) {
                return $this->redirectIfNotFound('admin.advertising.clients');
            }
            return view('admin.advertising.clients.show', compact('clientDesign'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.advertising.clients');
        }
    }

    public function edit(int $id)
    {
        try {
            $clientDesign = ClientDesign::findOrFail($id);
            if (!isset($clientDesign)) {
                return $this->redirectIfNotFound('admin.advertising.clients');
            }
            return view('admin.advertising.clients.edit', compact('clientDesign'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.advertising.clients');
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $clientDesign = ClientDesign::findOrFail($id);
            if (!isset($clientDesign)) {
                return $this->redirectIfNotFound('admin.advertising.clients');
            }
            $clientDesign->update([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'paid_amount' => $request->paid_amount,
                'delivered_date' => $request->delivered_date,
            ]);
            if ($request->has('photos')) {
                $old_images = $clientDesign->photos;
                // Update new
                $clientDesign->update([
                    'photos' => uploadMultipleImages('clientsDesigns', $request->file('photos'))
                ]);
                // Remove old images
                removeMultipleImages($old_images);
            }
            return $this->redirectIfSuccess('admin.advertising.clients');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.advertising.clients');
        }
    }

    public function destroy(int $id)
    {
        try {
            $clientDesign = ClientDesign::findOrFail($id);
            if (!isset($clientDesign)) {
                return $this->redirectIfNotFound('admin.advertising.clients');
            }
            $clientDesign->delete();
            $old_images = $clientDesign->photos;
            // Remove old images
            removeMultipleImages($old_images);
            return $this->redirectIfSuccess('admin.advertising.clients', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.advertising.clients');
        }
    }
}
