<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Mail;
use App\Mail\TransactionSuccess;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use App\TransactionDetail;
use App\TravelPackage;
use App\User;

use Midtrans\Config;
use Midtrans\Snap;

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
        $transaction_exists = Transaction::where('users_id', Auth::user()->id)
                                ->where('travel_packages_id', $id);

        if ($transaction_exists->exists()) {
            return redirect()->route('checkout', $transaction_exists->first()->id);
        } else {
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
        $transaction = Transaction::with('details', 'travel_package.galleries', 'user')->findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        // Konfigurasi Midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('midtrans.is3ds');

        // Buat konfig untuk dikirim ke midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => 'TEST' . $transaction->id,
                'gross_amount' => (int) $transaction->transaction_total
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email
            ],
            'enable_payments' => ['gopay'],
            'vtweb' => []
        ];

        // Kirim ke midtrans
        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;
            
            // Redirect to Snap Payment Page
            header('Location: ' . $paymentUrl);
        }
            catch (Exception $e) {
            echo $e->getMessage();
        }

        // Kirim email tiket ke user
        // Mail::to($transaction->user)->send(
        //     new TransactionSuccess($transaction)
        // );

        // return view('pages.success');
    }
}
