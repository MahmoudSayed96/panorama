<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Decorations\ClientDecoration\StoreRequest;
use App\Http\Requests\Admin\Decorations\ClientDecoration\UpdateRequest;
use App\Models\Decoration\ClientDecoration;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;

class ClientDecorationController extends Controller
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
        $clientDecorations = ClientDecoration::latest()->paginate(self::PAGINATE);
        return view('admin.decorations.clients.index', compact('clientDecorations'));
    }

    public function create()
    {
        return view('admin.decorations.clients.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            ClientDecoration::create([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'paid_amount' => $request->paid_amount,
                'delivered_date' => $request->delivered_date,
                'photos' => uploadMultipleImages('clientsDecorations', $request->file('photos'))
            ]);
            return $this->redirectIfSuccess('admin.decorations.clients');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.decorations.clients');
        }
    }

    public function show(int $id)
    {
        try {
            $clientDecoration = ClientDecoration::findOrFail($id);
            if (!isset($clientDecoration)) {
                return $this->redirectIfNotFound('admin.decorations.clients');
            }
            return view('admin.decorations.clients.show', compact('clientDecoration'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.decorations.clients');
        }
    }

    public function edit(int $id)
    {
        try {
            $clientDecoration = ClientDecoration::findOrFail($id);
            if (!isset($clientDecoration)) {
                return $this->redirectIfNotFound('admin.decorations.clients');
            }
            return view('admin.decorations.clients.edit', compact('clientDecoration'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.decorations.clients');
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        try {
            $clientDecoration = ClientDecoration::findOrFail($id);
            if (!isset($clientDecoration)) {
                return $this->redirectIfNotFound('admin.decorations.clients');
            }
            $clientDecoration->update([
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'paid_amount' => $request->paid_amount,
                'delivered_date' => $request->delivered_date,
            ]);
            if ($request->has('photos')) {
                $old_images = $clientDecoration->photos;
                // Update new
                $clientDecoration->update([
                    'photos' => uploadMultipleImages('clientsDecorations', $request->file('photos'))
                ]);
                // Remove old images
                removeMultipleImages($old_images);
            }
            return $this->redirectIfSuccess('admin.decorations.clients');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.decorations.clients');
        }
    }

    public function destroy(int $id)
    {
        try {
            $clientDecoration = ClientDecoration::findOrFail($id);
            if (!isset($clientDecoration)) {
                return $this->redirectIfNotFound('admin.decorations.clients');
            }
            $clientDecoration->delete();
            $old_images = $clientDecoration->photos;
            // Remove old images
            removeMultipleImages($old_images);
            return $this->redirectIfSuccess('admin.decorations.clients', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.decorations.clients');
        }
    }
}
