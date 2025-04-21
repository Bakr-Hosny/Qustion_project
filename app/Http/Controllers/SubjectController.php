<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('dashboard.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('dashboard.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create($request->all());
        return redirect()->route('subjects.index')->with('success', 'Type created successfully');
    }    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     *}

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
        //
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
    public function destroy(Request $request)
    {
        $subject = Subject::find($id);

    if (!$subject) {
        return response()->json(['message' => 'Subject not found'], 404);
    }

    $subject->delete();
    // return $subject;

    return response()->json(['message' => 'Subject deleted successfully']);
        // return $this->Subject->destroy($request);
    }
}
