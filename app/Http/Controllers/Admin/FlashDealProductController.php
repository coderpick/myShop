<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashDealProduct;
use App\Models\Product;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

class FlashDealProductController extends Controller
{
    public function index()
    {
        $flashDealProducts = FlashDealProduct::with('product.images')->get();

        return view('admin.flash_deal.index', compact('flashDealProducts'));
    }

    public function create()
    {
        $products = Product::select('id', 'name')->where('status', 'published')->where('stock', '>', 0)->get();

        return view('admin.flash_deal.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $flashDealProduct = new FlashDealProduct;
        $flashDealProduct->product_id = $validated['product_id'];
        $flashDealProduct->start_date = $validated['start_date'];
        $flashDealProduct->end_date = $validated['end_date'];
        $flashDealProduct->save();

        ToastMagic::success('Flash Deal Product created successfully');

        return redirect()->route('admin.flash_deal.index');
    }

    public function edit($id)
    {
        $flashDealProduct = FlashDealProduct::find($id);
        $products = Product::select('id', 'name')->where('status', 'published')->where('stock', '>', 0)->get();

        return view('admin.flash_deal.edit', compact('flashDealProduct', 'products'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $flashDealProduct = FlashDealProduct::find($id);
        $flashDealProduct->update($validated);

        ToastMagic::success('Flash Deal Product updated successfully');

        return redirect()->route('admin.flash_deal.index');
    }

    public function destroy($id)
    {
        $flashDealProduct = FlashDealProduct::find($id);
        $flashDealProduct->delete();

        ToastMagic::success('Flash Deal Product deleted successfully');

        return redirect()->route('admin.flash_deal.index');
    }
}
