<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('user_type', 'user')->withCount('orders')->latest()->get();

        return view('admin.customer.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = User::findOrFail($id)->load('orders');

        return view('admin.customer.show', compact('customer'));
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);

        // Delete customer's orders
        $customer->orders()->delete();

        // Delete customer
        $customer->delete();

        ToastMagic::success('Customer deleted successfully');

        return redirect()->route('admin.customer.index');
    }
}
