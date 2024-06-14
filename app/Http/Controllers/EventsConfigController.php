<?php

namespace App\Http\Controllers;

use App\Models\EventsConfig;
use Illuminate\Http\Request;

class EventsConfigController extends Controller
{
    // GET: Retrieve all events configurations
    public function index()
    {
        return response()->json(EventsConfig::all());
    }

    // POST: Create a new event configuration
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'hex_color' => 'required|string|max:7', // Assuming hex color format
        ]);

        $eventConfig = EventsConfig::create($validatedData);

        return response()->json($eventConfig, 201);
    }

    // PUT: Update an existing event configuration
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:255',
            'color' => 'sometimes|required|string|max:255',
            'hex_color' => 'sometimes|required|string|max:7', // Assuming hex color format
        ]);

        $eventConfig = EventsConfig::findOrFail($id);
        $eventConfig->update($validatedData);

        return response()->json($eventConfig);
    }
}
