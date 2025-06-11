<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;

class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Iegūst visus braucienus ar saistītajiem vadītājiem un klientiem (ja tādi ir)
        $rides = Ride::with(['driver', 'customer'])->get();

        // Nosūta datus uz skatu
        return view('rides.index', compact('rides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:users,id',
            'route_start' => 'required|string|max:255',
            'route_end' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'ride_date' => 'required|date',
            'status' => 'required|in:planned,ongoing,completed,cancelled',
        ]);

        Ride::create($validated);

        return redirect()->route('rides.index')->with('success', 'Ride created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ride = Ride::findOrFail($id);
        return view('rides.edit', compact('ride'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:users,id',
            'route_start' => 'required|string|max:255',
            'route_end' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'ride_date' => 'required|date',
            'status' => 'required|in:planned,ongoing,completed,cancelled',
        ]);

        $ride = Ride::findOrFail($id);
        $ride->update($validated);

        return redirect()->route('rides.index')->with('success', 'Ride updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ride = Ride::findOrFail($id);
        $ride->delete();

        return redirect()->route('rides.index')->with('success', 'Brauciens veiksmīgi izdzēsts.');
    }

    /**
     * Cancel a ride by ID.
     */
    public function cancel(string $ride)
{
    $ride = Ride::findOrFail($ride);
    $ride->status = 'cancelled';
    $ride->cancelled_at = now();
    $ride->save();

    return redirect()->route('rides.index')->with('success', 'Brauciens veiksmīgi atcelts.');
}

    /**
     * Show a page to select a ride to edit.
     */
    public function selectEdit()
    {
        $rides = Ride::all();

        return view('rides.select-edit', compact('rides'));
    }
}
