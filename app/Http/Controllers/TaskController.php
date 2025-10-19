<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    private $results_per_page = 10;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fetch all from db
        // $fetched = Task::where('user_id', Auth::id())->latest()->get();
        $fetched = Task::where('user_id', Auth::id())->latest()->simplePaginate($this->results_per_page);
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

        $data['user_id'] = Auth::id();

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

        $data['user_id'] = Auth::id();

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

    // ===========================================================================

    public function search (Request $request) {
        if (!empty($request['term'])) {
            // get search term from url
            $search_term = trim($request['term']);
            // run search aka query db
            $search_results = Task::where('user_id', Auth::id())
                                ->where('title', 'like', "%$search_term%")
                                ->orWhere('description', 'like', "%$search_term%")
                                ->orWhere('category', 'like', "%$search_term%")
                                ->latest()->simplePaginate($this->results_per_page);
        } 
        
        elseif (!empty($request['filterstatus'])) {
            $search_term = trim($request['filterstatus']);
            if ($search_term === 'all') $search_results = Task::where('user_id', Auth::id())->latest()->simplePaginate($this->results_per_page);
            else $search_results = Task::where('user_id', Auth::id())
                                       ->where('status', $search_term)->latest()->simplePaginate($this->results_per_page);
        } 
        
        elseif (!empty($request['filterprio'])) {
            $search_term = trim($request['filterprio']);
            $search_results = Task::where('user_id', Auth::id())->where('priority', $search_term)->latest()->simplePaginate($this->results_per_page);
        }

        elseif (!empty($request['sort'])) {
            $search_term = trim($request['sort']);
            if ($search_term === 'created_desc') $search_results = Task::where('user_id', Auth::id())->latest()->simplePaginate($this->results_per_page);
            elseif ($search_term === 'created_asc') $search_results = Task::where('user_id', Auth::id())->simplePaginate($this->results_per_page);
            elseif ($search_term === 'due_desc') $search_results = Task::where('user_id', Auth::id())->orderBy('due_date', 'desc')->simplePaginate($this->results_per_page);
            elseif ($search_term === 'due_asc') $search_results = Task::where('user_id', Auth::id())->orderBy('due_date', 'asc')->simplePaginate($this->results_per_page);
            elseif ($search_term === 'prio_desc') $search_results = Task::where('user_id', Auth::id())->orderByRaw("FIELD(priority, 'high', 'medium', 'low', 'none')")->simplePaginate($this->results_per_page);
            elseif ($search_term === 'prio_asc') $search_results = Task::where('user_id', Auth::id())->orderByRaw("FIELD(priority, 'none', 'low', 'medium', 'high')")->simplePaginate($this->results_per_page);
        }

        // render search results
        $input_value = $search_term;
        if (!empty($request['filterstatus'])) $input_value = 'status: ' . $search_term;
        if (!empty($request['filterprio'])) $input_value = 'priority: ' . $search_term;
        if (!empty($request['sort'])) $input_value = 'sort: ' . $search_term;
        $data = [
            'count' => $search_results ? count($search_results) : 0,
            'title' => 'Tasks',
            'entries' => $search_results,
            'term' => $input_value,
            'term_clean' => $search_term
        ];
        return view('tasks', $data);
    }
}
