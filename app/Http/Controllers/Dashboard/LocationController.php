<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LocationController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::paginate(10);
        return view('dashboard.location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',  // Assuming image is a URL or file path
            'link' => 'nullable|string|url', // 'url' rule validates it's a valid link
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('location', 'public');
            $validated['image'] = $imagePath;
        }

        Location::create([
            'name' => $validated['name'],
            'address'=> $validated['address'],
            'image' => $validated['image'],
            'link'=> $validated['link'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
        ]);

        return redirect()->route('dashboard.location.index')->with('success', 'Location created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('dashboard.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|string|url',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($location->image && \Storage::disk('public')->exists($location->image)) {
                \Storage::disk('public')->delete($location->image);
            }

            $imagePath = $request->file('image')->store('location', 'public');
            $validated['image'] = $imagePath;
        }

        $location->update($validated);

        return redirect()->route('dashboard.location.index')
                        ->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('dashboard.location.index')
            ->with('success', 'Location deleted successfully.');
    }
}
