<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Property::all();
        $properties = Property::orderBy('created_at', 'desc')->get();
        return view('properties.index', compact('properties'));
    }

    public function create()
{
    return view('properties.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|string',
            'number_of_units' => 'required|integer',
            'rental_cost' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validate each image
        ]);

        $property = Property::create($validated);

        // Store each uploaded image
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $path = $image->store('property_images', 'public'); // Store in public storage
                $property->images()->create(['image_path' => $path]); // Save image record
            }
        }

        return redirect()->route('properties.index')->with('success', 'Property created successfully with images');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $property = Property::findOrFail($id);

        return view('properties.show', compact('property'));

    }

   /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){

        $property = Property::findOrFail($id);
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|string',
            'number_of_units' => 'required|integer',
            'rental_cost' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $property->update($validated);

        // Delete selected images
        if ($request->filled('delete_images')) {
            $imagesToDelete = explode(',', $request->delete_images);
            foreach ($imagesToDelete as $imageId) {
                $image = $property->images()->find($imageId);
                if ($image) {
                    Storage::delete('public/' . $image->image_path);
                    $image->delete();
                }
            }
        }

        // Store each uploaded image
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('property_images', 'public');
                $property->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('properties.index')->with('success', 'Property updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        // return response()->json(['message' => 'Property deleted successfully']);
        return redirect()->route('properties.index')->with('success', 'Property deleted successfully');
    }
}
