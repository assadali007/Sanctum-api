<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Symfony\Component\HttpFoundation\Response;



class CategoryController extends Controller
{
     /**
     * @OA\Get(
     *      path="/categories",
     *      tags={"Categories"},
     *      summary="Get list of categories",
     *      description="Returns list of categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {

        $categories = Category::all();
        return  CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
      return new CategoryResource($category);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
             'photo' => 'required',

        ]);
         $data = $request->all();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = 'categories/' . uniqid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $data['photo'] = $name;
        }
        $category = Category::create($data);

        return new CategoryResource($category);
    }

    public function update(Category $category,Request $request)
    {
        $request->validate([
            'name' => 'required',
             'photo' => 'required',
        ]);
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

    /*
    * Search for a name
    *
    */

    public function search($name)
    {
        return Category::where('name','like', '%'.$name.'%')->get();
    }

}
