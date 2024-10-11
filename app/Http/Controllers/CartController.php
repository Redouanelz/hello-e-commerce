<?php
namespace App\Http\Controllers;

use App\Models\Cart;

use COM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
     // Get all cart items for user with ID 1 and include the related products
     $cartItems = Cart::where('user_id', 1)->with('product')->get();

     return response()->json($cartItems);
    }
    
    public function show($id)
    {
        $cartItems = Cart::where('user_id', $id)->with('product')->get();
        if (!$cartItems) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($cartItems);
    }


    public function add(Request $request)
    {
        // Validate the incoming request to ensure we have product_id and user_id
        $request->validate([
            'product_id' => 'required|exists:products,id', // Ensure product exists
            'user_id' => 'required|exists:users,id', // Ensure user exists
        ]);

        $productId = $request->input('product_id');
        $userId = $request->input('user_id');

        // Check if the product is already in the cart for the user
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // If product is already in the cart, you could increase the quantity (optional)
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // If not in the cart, create a new cart entry
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1, // Initial quantity
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully']);
    }


    public function remove(Request $request)
    {
        // Validate the incoming request to ensure we have product_id and user_id
        $request->validate([
            'product_id' => 'required|exists:products,id', // Ensure product exists
            'user_id' => 'required|exists:users,id', // Ensure user exists
        ]);

        $productId = $request->input('product_id');
        $userId = $request->input('user_id');

        // Find the cart item by user_id and product_id
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Remove the item from the cart
            $cartItem->delete();
            return response()->json(['message' => 'Product removed from cart successfully']);
        } else {
            return response()->json(['message' => 'Product not found in cart'], 404);
        }
    }


    // Increase Quantity
    public function increaseQuantity(Request $request)
    {
        $cartItem = Cart::where('user_id', $request->user_id)
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
            return response()->json(['message' => 'Quantity increased', 'cartItem' => $cartItem]);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }

    // Decrease Quantity
    public function decreaseQuantity(Request $request)
    {
        $cartItem = Cart::where('user_id', $request->user_id)
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
            return response()->json(['message' => 'Quantity decreased', 'cartItem' => $cartItem]);
        }

        return response()->json(['message' => 'Item not found or quantity cannot be less than 1'], 404);
    }


    
    public function clear(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
        ]);
    
        // Delete all items in the cart for the given user_id
        $deleted = Cart::where('user_id', $validatedData['user_id'])->delete();
    
        // Check if any items were deleted
        if ($deleted) {
            return response()->json(['success' => 'Cart cleared successfully'], 200);
        } else {
            return response()->json(['error' => 'No items found in the cart for this user'], 404);
        }
    }



}
