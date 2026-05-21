<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderApiController extends Controller
{
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