<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skills;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skills::all()->groupBy('category');
        return $skills;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request 
        $request = $request->validate([
            'name'=>'required|string',
            'category'=>'required'
        ]);

        $skill=Skills::create($request);
        return response()->json($request, 200);
    }

     /* Display the specified resource.
     */
    public function show(Skills $skill)
    {
        return $skill;

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skills $skill)
    {
        $request =$request->validate([
            "name"=>"sometimes|string",
            "category"=>"sometimes"
        ]);

        $skill->update($request);
        return response()->json($skill, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skills $skill)
    {
        $skill->delete();
        return response()->json(null, 204);
    }
}
