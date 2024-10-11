<?php
namespace App\Http\Controllers;
use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller{
    public function show($id)
    {
        $avis = Avis::where('id_product', $id)->get();
        return response()->json($avis);
    }

    public function add(Request $request)
    {
        // Validate the request data
        $request->validate([
            'description' => 'required|string|max:255',
            'note' => 'required|integer|min:1|max:5',
            'id_product' => 'required|exists:products,id'
        ]);

        // Create a new review (Avis)
        Avis::create([
            'description' => $request->input('description'),
            'note' => $request->input('note'),
            'id_product' => $request->input('id_product')
        ]);

        return response()->json(['message' => 'Review added successfully'], 201);
  
    }
    

    



}
