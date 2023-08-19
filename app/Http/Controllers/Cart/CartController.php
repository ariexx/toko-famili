<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartStoreRequest;
use App\Http\Services\CartService;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService)
    {
    }

    public function index() {
        $userCarts = $this->cartService->getUserCart();
        $totalProduct = $userCarts->count();
        $subTotal = $this->cartService->getUserCart()->map(function($e) {
            return $e->product->price * $e->quantity;
        });
        $total = rupiah($subTotal->sum());
        return view('user.pages.cart.index', compact('userCarts', 'totalProduct', 'total'));
    }

    public function store(CartStoreRequest $request)
    {
        if(!$request->ajax()) return response()->json(['success' => false], 500);
        $validated = $request->validated();
        $insert = $this->cartService->store($validated);
        if(!$insert) return response()->json(['success' => false], 500);
        return response()->json(['success' => true]);
    }
}
