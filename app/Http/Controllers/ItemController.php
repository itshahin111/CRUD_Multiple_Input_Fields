<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the items.
     */
    public function index()
    {
        $items = Item::all();
        return view('index', compact('items'));
    }

    public function create()
    {
        return view('create');
    }

    /**
     * Store multiple items.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'inputs.*.name' => 'required|string|max:255',
            'inputs.*.description' => 'required|string|max:255',
            'inputs.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'inputs.*.quantity' => 'nullable|integer|min:0'
        ]);

        // Iterate through the inputs and store each item
        foreach ($request->inputs as $input) {
            $imagePath = null;

            // Handle image upload if present
            if (isset($input['image']) && $input['image']->isValid()) {
                $imageName = time() . '-' . uniqid() . '.' . $input['image']->getClientOriginalExtension();
                $imagePath = $input['image']->storeAs('public/images', $imageName);
                $imagePath = str_replace('public/', '', $imagePath);
            }

            // Create a new item record
            Item::create([
                'name' => $input['name'],
                'description' => $input['description'],
                'image' => $imagePath,
                'quantity' => $input['quantity'],
            ]);
        }

        return redirect()->route('items.index')->with('success', 'Items added successfully!');
    }


    public function update(Request $request, Item $item)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'nullable|integer|min:0'
        ]);

        $imagePath = $item->image;

        // Handle image upload if present
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = time() . '-' . $request->name . '.' . $request->image->getClientOriginalExtension();
            $imagePath = $request->image->storeAs('public/images', $imageName);
            $imagePath = str_replace('public/', '', $imagePath);
        }

        // Update the item record
        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'image' => $imagePath,
        ]);

        return redirect()->route('items.show', $item->id)->with('success', 'Item updated successfully!');
    }


    /**
     * Show a single item.
     */
    public function show(Item $item)
    {
        return view('show', compact('item'));
    }

    /**
     * Edit an item.
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('edit', compact('item'));
    }

    /**
     * Delete an item.
     */
    public function destroy(Item $item)
    {
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}