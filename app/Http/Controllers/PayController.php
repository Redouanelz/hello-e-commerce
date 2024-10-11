<?php
namespace App\Http\Controllers;
use App\Models\Order;
use COM;
use Illuminate\Http\Request;

class PayController extends Controller{
    public function show($id)
    {
        $orders = Order::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        if (!$orders) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($orders);
    }

    public function add(Request $request)
    {
        
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'total_amount' => 'required|numeric',
        ]);

        // Create a new order
        $order = new Order();
        $order->user_id = $validatedData['user_id'];
        $order->total_amount = $validatedData['total_amount'];
        $order->save();

        return response()->json(['success' => 'Order created successfully', 'order' => $order], 201);
    }
    

    



}
