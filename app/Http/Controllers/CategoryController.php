<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Categories',
            'flag' => 'list',
            // 'data' => Category::all()
            'data' => Category::where('user_id', Auth::id())->latest()->get()
        ];

        return view('categories', $data);
    }

    // ========================================================================

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // ========================================================================

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
            'name' => 'required|string|max:255',
        ]);

        $data['user_id'] = Auth::id();

        // push to db
        Category::create($data);

        // redirect
        return redirect('/categories')->with('success', 'Category created!');
    }

    // ========================================================================

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

    // ========================================================================

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo $id;
        // echo "<br>";
        // return Category::find($id);
        $data = [
            'title' => 'Categories',
            'flag' => 'edit',
            'entry' => Category::find($id),
            // 'data' => Category::all()
            'data' => Category::where('user_id', Auth::id())->latest()->get()
        ];

        return view('categories', $data);
    }

    // ========================================================================

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
            'name' => 'required|string|max:255',
        ]);

        $data['user_id'] = Auth::id();

        // update in db
        Category::where('id', $id)->update($data);

        // redirect
        return redirect('/categories')->with('success', 'Category updated!');
    }

    // ========================================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('/categories')->with('success', 'Category deleted!');
    }

    // ========================================================================

    // return all categories
    public function read () {
        // return Category::all();
        return Category::where('user_id', Auth::id())->latest()->get();
    }
}
