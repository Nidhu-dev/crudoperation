<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    // it is use for show products.
    public function index() {

     // Fetch all items from the database
    $Product = Product::orderBy('created_at', 'DESC')->paginate(5);

    // Pass the items to the view
    return view('products.display', [
        'products' => $Product
    ]);
    }

    // it is use for add new products.
    public function create()
    {

        return view('products.create');
    }

    // it is use for add product data in  database.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);


        // insert the form data in database.
        $Product = new Product();
        $Product->name = $validatedData['name'];
        $Product->description = $validatedData['description'];
        $Product->status =  $validatedData['status'];

        // insert images
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Saves to storage/app/public/images
            $Product->image = $imagePath; // Only stores the relative path
        }
        
        $Product->save();                                                                                                                                                                                                                                                                                                                   

        return redirect()->route('products.index')->with('success', 'Product added  successfully!');
    }

    // it is use for show edit page.
    public function edit($id) {
        $product = Product::findOrfail($id);
        return view('products.edit',[
            'product' => $product
        ]);
    }

    // it is use for update the product detail .
    public function update($id, Request $request) {
        $Product = Product::findOrfail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);


        // update  the form data in database.
        $Product->name = $validatedData['name'];
        $Product->description = $validatedData['description'];
        $Product->status =  $validatedData['status'];

        // insert images
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Saves to storage/app/public/images
            $Product->image = $imagePath; // Only stores the relative path
        }
        
        $Product->save();                                                                                                                                                                                                                                                                                                                   

        return redirect()->route('products.index')->with('success', 'product update  successfully!');
    }

    // it is use for delete  the product detail .
    public function destroy($id) {
        $Product = Product::findOrfail($id);

        // delete image
        if ($Product->image && Storage::disk('public')->exists($Product->image)) {
            Storage::disk('public')->delete($Product->image);
        }

        // Delete the product record from the database
    $Product->delete();

    // Redirect back with a success message
    return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    
    }

 
}
