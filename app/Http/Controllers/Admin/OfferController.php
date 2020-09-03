<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Marketing\Offer\OfferRequest;
use App\Http\Requests\Admin\Marketing\Offer\UpdateOfferRequest;
use App\Models\Offer;
use App\Models\Product;
use App\Providers\RouteServiceProvider;
use App\Traits\ErrorHandlerTrait;
use App\Traits\UploadImageTrait;

class OfferController extends Controller
{
    use ErrorHandlerTrait, UploadImageTrait;

    private const PAGINATE = RouteServiceProvider::PAGINATE_LIMIT;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:read_marketing')->only('index');
        $this->middleware('permission:create_marketing')->only('create');
        $this->middleware('permission:update_marketing')->only('edit');
        $this->middleware('permission:delete_marketing')->only('destroy');
    }

    public function index()
    {
        $offers = Offer::latest()->paginate(self::PAGINATE);
        return view('admin.marketing.offers.index', compact('offers'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.marketing.offers.create', compact('products'));
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
                'prod_photo' => $this->uploadMultipleImages('offers', $request->file('photos'))
            ]);
            return $this->redirectIfSuccess('admin.marketing.offers');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.marketing.offers');
        }
    }

    public function show(int $id)
    {
        try {
            $offer = Offer::findOrFail($id);
            if (!isset($offer)) {
                return $this->redirectIfNotFound('admin.marketing.offers');
            }
            return view('admin.marketing.offers.show', compact('offer'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.marketing.offers');
        }
    }

    public function edit(int $id)
    {
        try {
            $products = Product::all();
            $offer = Offer::findOrFail($id);
            if (!isset($offer)) {
                return $this->redirectIfNotFound('admin.marketing.offers');
            }
            return view('admin.marketing.offers.edit', compact('products', 'offer'));
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.marketing.offers');
        }
    }

    public function update(UpdateOfferRequest $request, int $id)
    {
        try {
            $offer = Offer::findOrFail($id);
            if (!isset($offer)) {
                return $this->redirectIfNotFound('admin.marketing.offers');
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
                    'prod_photo' => $this->uploadMultipleImages('offers', $request->file('photos'))
                ]);
                // Remove old images
                $this->removeMultipleImages($old_images);
            }
            return $this->redirectIfSuccess('admin.marketing.offers');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.marketing.offers');
        }
    }

    public function destroy(int $id)
    {
        try {
            $offer = Offer::findOrFail($id);
            if (!isset($offer)) {
                return $this->redirectIfNotFound('admin.marketing.offers');
            }
            $offer->delete();
            $old_images = $offer->prod_photo;
            // Remove old images
            $this->removeMultipleImages($old_images);
            return $this->redirectIfSuccess('admin.marketing.offers', 'تم حذف البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.marketing.offers');
        }
    }
}
