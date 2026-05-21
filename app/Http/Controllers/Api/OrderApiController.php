<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Get All Orders
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $orders = Order::latest()->get()->map(function ($order) {
            return [
                'id' => $order->id,
                'customer_name' => $order->customer_name,
                'product_name' => $order->product_name,
                'quantity' => $order->quantity,
                'price' => $order->price,
                'total' => $order->total,
                'address' => $order->address,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Store Order
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'product_name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
            'address' => 'nullable|string',
        ]);

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->total,
            'address' => $request->address,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'order' => $order
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Store POS Sale
    |--------------------------------------------------------------------------
    */
    public function storeSale(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'product_name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
            'address' => 'nullable|string',
        ]);

       Order::create([
    'user_id' => Auth::id(),   // 🔥 FIX HERE
    'customer_name' => Auth::user()->name,
    'product_name' => $item->shoe->name,
    'quantity' => $item->quantity,
    'price' => $item->shoe->price,
    'total' => $item->quantity * $item->shoe->price,
    'address' => $request->address,
]);

        return response()->json([
            'success' => true,
            'message' => 'POS sale saved successfully',
            'order' => $order
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Order
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully'
        ]);
    }
}