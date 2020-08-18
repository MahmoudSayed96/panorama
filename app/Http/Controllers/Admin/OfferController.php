<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Offer\OfferRequest;
use App\Http\Requests\Admin\Offer\UpdateOfferRequest;
use App\Models\Offer;
use App\Models\Product;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;

class OfferController extends Controller
{
    use ErrorHandlerTrait;

    private const PAGINATE = RouteServiceProvider::PAGINATE_LIMIT;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:read_offers')->only('index');
        $this->middleware('permission:create_offers')->only('create');
        $this->middleware('permission:update_offers')->only('edit');
        $this->middleware('permission:delete_offers')->only('destroy');
    }

    public function index()
    {
        $offers = Offer::latest()->paginate(self::PAGINATE);
        return view('admin.offers.index', compact('offers'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.offers.create', compact('products'));
    }

    public function store(OfferRequest $request)
    {
        try {
            Offer::create([
                'product_id' => $request->product,
                'prod_owner' => $request->prod_owner,
                'prod_owner_phone' => $request->prod_owner_phone,
                'prod_area' => $request->prod_area,
                'prod_price' => $request->prod_price,
                'prod_photo' => uploadMultipleImages('offers', $request->file('photos'))
            ]);
            return $this->redirectIfSuccess('admin.offers');
        } catch (\Exception $ex) {
            return $ex;
            return $this->redirectIfError('admin.offers');
        }
    }

    public function show(int $id)
    {
        try {
            $offer = Offer::findOrFail($id);
            if (!isset($offer)) {
                return $this->redirectIfNotFound('admin.offers');
            }
            return view('admin.offers.show', compact('offer'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.offers');
        }
    }

    public function edit(int $id)
    {
        try {
            $products = Product::all();
            $offer = Offer::findOrFail($id);
            if (!isset($offer)) {
                return $this->redirectIfNotFound('admin.offers');
            }
            return view('admin.offers.edit', compact('products', 'offer'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.offers');
        }
    }

    public function update(UpdateOfferRequest $request, int $id)
    {
        try {
            $offer = Offer::findOrFail($id);
            if (!isset($offer)) {
                return $this->redirectIfNotFound('admin.offers');
            }
            $offer->update([
                'product_id' => $request->product,
                'prod_owner' => $request->prod_owner,
                'prod_owner_phone' => $request->prod_owner_phone,
                'prod_area' => $request->prod_area,
                'prod_price' => $request->prod_price,
            ]);
            if ($request->has('photos')) {
                $old_images = $offer->prod_photo;
                // Update new
                $offer->update([
                    'prod_photo' => uploadMultipleImages('offers', $request->file('photos'))
                ]);
                // Remove old images
                removeMultipleImages($old_images);
            }
            return $this->redirectIfSuccess('admin.offers');
        } catch (\Exception $ex) {
            return $ex;
            return $this->redirectIfError('admin.offers');
        }
    }

    public function destroy(int $id)
    {
        try {
            $offer = Offer::findOrFail($id);
            if (!isset($offer)) {
                return $this->redirectIfNotFound('admin.offers');
            }
            $offer->delete();
            $old_images = $offer->prod_photo;
            // Remove old images
            removeMultipleImages($old_images);
            return $this->redirectIfSuccess('admin.offers', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.offers');
        }
    }
}
