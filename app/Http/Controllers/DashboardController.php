<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

use App\TransactionDetail;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        // $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])->whereHas('product', function($product){
        //     $product->where('users_id', Auth::user()->id);
        // });

        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])->whereHas('product', function($product){
            $product->where('users_id', Auth::user()->id);
        });

        $revenue = $transactions->get()->reduce(function ($carry, $item){
            return $carry + $item->price;
        });

        $customer = TransactionDetail::with(['transaction.user', 'product.galleries'])->whereHas('product', function($product){
            $product->where('users_id', Auth::user()->id);
        })->count();

        return view('pages.dashboard', [
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
            'revenue' => $revenue,
            'customer' => $customer,
        ]);
    }
}
