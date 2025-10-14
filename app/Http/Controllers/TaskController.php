<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fetch all from db
        $fetched = Task::latest()->get();
        $data = [
            'count' => $fetched ? count($fetched) : 0,
            'title' => 'Tasks',
            'entries' => $fetched
        ];
        // return view, pass fetched
        return view('tasks', $data);
    }

    // ===========================================================================

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Add Task',
        ];
        return view('form', $data);
    }

    // ===========================================================================

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Etc/GMT-4');

        // get form data & validate
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string',
            'category' => 'nullable|string',
            'priority' => 'nullable|string|in:none,low,medium,high', // restrict the priority field: only these 4 options are valid
            'due_date' => 'nullable|date',
        ]);

        $data['user_id'] = 1; // CHANGE THIS 

        // push to db
        Task::create($data);
        // redirect
        return redirect('/tasks')->with('success', 'Task created!');
    }

    // ===========================================================================

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    // ===========================================================================

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // fetch one from db
        $task = Task::find($id);
        // return view, pass that one
        $data = [
            'title' => 'Edit Task',
            'data' => $task
        ];
        return view('form', $data);
    }

    // ===========================================================================

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Etc/GMT-4');

        // get form data & validate
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string',
            'category' => 'nullable|string',
            'priority' => 'nullable|string|in:none,low,medium,high', // restrict the priority field: only these 4 options are valid
            'due_date' => 'nullable|date',
        ]);

        $data['user_id'] = 1; // CHANGE THIS 

        // push to db
        Task::where('id', $id)->update($data); // where clause must come first
        // redirect
        return redirect('/tasks')->with('success', 'Task updated!');
    }

    // ===========================================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // query db to delete entry
        Task::destroy($id);
        // redirect
        return redirect('/tasks')->with('success', 'Task deleted!');
    }
}
