<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Messages::orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Messages::create($validated);

        return response()->json(['message' => "Thanks for reaching out — I will get back to you soon."], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Messages $message)
    {
        return $message;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
