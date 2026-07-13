<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::all();

        return view('dashboard.schedules', [
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        Schedule::create($validated);

        return redirect('/dashboard/schedules')->with('add-schedule', 'Berhasil menambah schedule baru!');
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
        $schedule = Schedule::findOrFail($id);

        return view('dashboard.schedules.edit', ['schedule' => $schedule]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        // $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        $schedule->update($validated);

        return redirect('/dashboard/schedules')->with('update-schedule', 'Berhasil mengubah schedule!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect('/dashboard/schedules')->with('delete-schedule', 'Berhasil menghapus schedule');
    }
}
