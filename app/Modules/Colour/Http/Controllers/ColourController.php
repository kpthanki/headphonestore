<?php

namespace App\Modules\Colour\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Colour\Models\Colour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ColourController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=colour::where('deleted_at',0)->get();

    	return view('Colour::index',['colour'=>$data]);
    }

    public function edit($id)
    {

    $colour = Colour::find($id);

    return view('Colour::edit', compact('colour'));
    }



    public function update(request $request, $id)
    {
        $request-> validate([
            'name'=>'required',
        ]);

        $colour = Colour::find($id);
        $colour->name=$request->name;
        $colour-> update();
         return back()->with('success','Item Updated successfully!');
         $data=Colour::all();
    }

    public function uniquename(Request $r)
    {
        $colour = Colour::where('id', '!=', $r->id)->where('name', $r->name)->first();
        if (isset($colour)) {
          return json_encode(false);
        } else {
          return json_encode(true);
        }
    }

    public function changestatus(Request $request)
    {
        $status= Colour::find($request->id);
        $status->status=$request->status;
        $status->save();
        return response($request);
    }

    public function formdata(){
        return view('Colour::add');
    }

    public function getdata(Request $request)
    {
        $request-> validate([
            'name'=>'required | max:15 |alpha | unique:colour',
            'status',
        ]);
        $status = $request->status;
        if($status == 'Inactive'){
            $status = 0;
        }else{
            $status = 1;
        }

        $user_id = Auth::user()->id;
         $colour =new Colour;
         $colour->name=$request->name;
         $colour->user_id=$user_id;
         $colour->status=$status;
         $colour->deleted_at=0;
         $colour-> save();
         return back()->with('success','Item created successfully!');
        $data=colour::all();
    }

    function deletedata(Request $request)
    {
        $colour = Colour::find($request->id);
        $colour->deleted_at = 1;
        $colour->save();
        return response($colour);
    }

    function showtrash()
    {
    $colour = Colour::where('deleted_at',1)->get();
    return view('Colour::trash',['colour'=>$colour]);
    }

    function restoretrash(Request $request)
    {
        $affected = DB::table('colour')
                    ->update(['deleted_at' => 0]);
    }

    function restore_data(Request $request)
    {
        $colour = Colour::find($request->id);
        $colour->deleted_at = 0;
        $colour->save();
        return response($colour);
    }
}
