<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Retrieve the category for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Category::findOrFail($id);
    }
    /**
     * Create a new category instance.
     *
     * @param  Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required|min:3|max:100',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        return $category;
    }
    /**
     * Update the category for the given ID.
     *
     * @param  Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'    => 'required|min:3|max:100',
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');
    
        $category->save();
        
        return $category;
    }
    /**
     * Delete the category for the given ID.
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        $category = Category::find($id);
        return response()->json($category->delete());
    }
    /**
     * List all available categories.
     *
     * @return Response
     */
    public function lists()
    {
        return Category::all();
    }
}
