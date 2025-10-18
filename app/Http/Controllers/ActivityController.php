<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::paginate(10);
        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'points' => 'required',
            'type' => 'required',
            'category' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        Activity::create($request->only([
            'title',
            'content',
            'link',
            'points',
            'type', 
            'category',
            'start_at',
            'end_at',
        ]));

        return redirect()->route('activities.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'points' => 'required',
            'type' => 'required',
            'category' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        $activity->update($request->only([
            'title',
            'content',
            'link',
            'points',
            'type', 
            'category',
            'start_at',
            'end_at',
        ]));

        return redirect()->route('activities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index');
    }
}
