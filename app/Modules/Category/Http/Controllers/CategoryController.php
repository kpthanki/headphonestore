<?php

namespace App\Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Category\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{

   /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $data=Category::where('deleted_at',0)->get();
    	return view('Category::welcome',['category'=>$data]);
    }


    public function editdata($id)
    {
        $category = Category::find($id);

        return view('Category::edit', compact('category'));
    }

    public function update(request $request, $id)
    {
        $request-> validate([

            'name'=>'required | unique:category',

        ]);

        $category = Category::find($id);
        $category->name=$request->name;

        $category-> update();
         return back()->with('success','Item Updated successfully!');
         $data=Category::all();
    }

    public function changestatus(Request $request)
    {
        $status= Category::find($request->id);
        $status->status=$request->status;
        $status->save();
        return response($request);
    }

    public function formdata()
    {
        return view('Category::index2');
    }

    public function getdata(Request $request)
    {
       $request-> validate([
            'name'=>'required |min:3 | max:15 | alpha | unique:category'
        ]);
        $status = $request->status;
        if($status == 'Inactive'){
            $status = 0;
        }else{
            $status = 1;
        }
        $user_id = Auth::user()->id;
        $category =new Category;
        $category->name=$request->name;
        $category->user_id=$user_id;
        $category->status=$status;
        $category->deleted_at=0;
        $category-> save();
        return back()->with('success','Item created successfully!');
        $data=category::all();
    }

    function deletedata(Request $request)
    {
        $category = Category::find($request->id);
        $category->deleted_at = 1;
        $category->save();
        return response($category);
    }

    function showtrash()
    {
        $category = Category::where('deleted_at',1)->get();
        return view('Category::trash',['category'=>$category]);
    }

    function restoretrash(Request $request)
    {
        $affected = DB::table('category')
                    ->update(['deleted_at' => 0]);
    }

    function restore_data(Request $request)
    {
        $category = Category::find($request->id);
        $category->deleted_at = 0;
        $category->save();
        return response($category);
    }

    public function uniquename(Request $r)
    {
        $cat = Category::where('id', '!=', $r->id)->where('name', $r->name)->first();
        if (isset($cat)) {
          return json_encode(false);
        } else {
          return json_encode(true);
        }

    }

}
