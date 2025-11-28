<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::where('user_id', Auth::id())->latest()->paginate(10);

        return view('inventories.index', compact('inventories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'condition' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('inventories', 'public');
        }

        Inventory::create($data);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Inventory $inventory)
    {
        return response()->json($inventory);
    }

    public function update(Request $request, Inventory $inventory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'condition' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($inventory->image) {
                Storage::disk('public')->delete($inventory->image);
            }

            $data['image'] = $request->file('image')->store('inventories', 'public');
        }

        $inventory->update($data);

        return redirect()->back()->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Inventory $inventory)
    {
        if ($inventory->image) {
            Storage::disk('public')->delete($inventory->image);
        }

        $inventory->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }
}
