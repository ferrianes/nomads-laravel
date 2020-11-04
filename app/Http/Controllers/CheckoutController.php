<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TravelPackage;
use App\TransactionDetail;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with('details', 'travel_package', 'user')->findOrFail($id);
        return view('pages.checkout', [
            'item' => $item
        ]);
    }

    public function process(Request $request, $id)
    {
        $travel_package = TravelPackage::findOrFail($id);

        $transaction = Transaction::create([
            'travel_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'additional_visa' => 0,
            'transaction_total' => $travel_package->price,
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'username' => Auth::user()->username,
            'nationality' => Auth::user()->nationality,
            'is_visa' => Auth::user()->is_visa,
            'doe_passport' => Auth::user()->doe_passport
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        
    }

    public function success(Request $request)
    {
        return view('pages.success');
    }
}
