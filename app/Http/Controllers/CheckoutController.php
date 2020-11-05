<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use App\TransactionDetail;
use App\TravelPackage;
use App\User;

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
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'nationality' => Auth::user()->nationality,
            'is_visa' => Auth::user()->is_visa,
            'doe_passport' => Auth::user()->doe_passport
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findOrFail($detail_id);

        $transaction = Transaction::with('details', 'travel_package')
            ->findOrFail($item->transactions_id);

        if ($item->is_visa) {
            $transaction->transaction_total -= 190;
            $transaction->additional_visa -= 190;
        }

        $transaction->transaction_total -= $transaction->travel_package->price;

        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username' => ['required', 'string', 'alpha_dash', 'max:255', 'exists:users,username'],
            'is_visa' => ['required', 'boolean'],
            'doe_passport' => ['required', 'date']
        ]);
        
        $data = $request->all();
        $user = User::where('username', $data['username'])->first();
        $data['doe_passport'] = Carbon::parse($data['doe_passport'])->toDate();
        $data['nationality'] = $user->nationality;
        $data['transactions_id'] = $id;

        TransactionDetail::create($data);

        $transactions = Transaction::with('travel_package')->find($id);

        if ($request->is_visa) {
            $transactions->transaction_total += 190;
            $transactions->additional_visa += 190;
        }

        $transactions->transaction_total += $transactions->travel_package->price;

        $transactions->save();

        return redirect()->route('checkout', $id);
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        return view('pages.success');
    }
}
