<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_categories')->only(['index']);
        $this->middleware('permission:create_categories')->only(['create','store']);
        $this->middleware('permission:update_categories')->only(['edit','update']);
        $this->middleware('permission:delete_categories')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $categories = Category::whenSearch(request()->search)->paginate(5);
        $categories = Category::whenSearch(request()->search)
        ->withCount('movies')->paginate(5);
        return view('dashboard.categories.index', compact('categories'));

    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {

        $category = Category::findOrFail($request->category_id);
        $category->status = $request->status;
        $category->save();

        // return response()->json(['message' => 'User status updated successfully.']);
        return response()->json(['success' => 'Status change successfully.']);
        // session()->flash('success', 'Status change successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'status' => 'required'
        ]);

        Category::create($request->all());
        /* Category::create($request->all());*/

        session()->flash('success', 'Data Added successfully');
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $category = Category::findOrFail($id);
        $request->validate([
            'name' => ['required',
                Rule::unique('categories', 'name')->ignore($category->id)],
            'status' => 'required'
        ]);


        $category->update($request->all());

        session()->flash('success', __('Data updated successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //////////////////////////////
        $category = Category::findOrFail($id);

        //////////////////////////////
        $category->delete();
        session()->flash('success', 'Data deleted successfully');
        return redirect()->route('dashboard.categories.index');
    }

}
