<?php

namespace App\Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\multipleimage;
use App\Modules\Category\Models\Category;
use App\Modules\Colour\Models\Colour;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Product::where('deleted_at',0)->get();

    	return view('Product::index',['product'=>$data]);
    }

     public function edit($id)
    {

    $product = Product::find($id);
    $images=Multipleimage::where('product_id',$id)->get();
    return view('Product::edit', compact('product','images'));
    }

    public function changestatus(Request $request)
    {
        $status= Product::find($request->id);
        $status->status=$request->status;
        $status->save();
        return response($request);
    }

    public function formdata(){
        $category = Category::where('deleted_at',0)
                         ->where('status',1)->get();
        $colour=Colour::where('deleted_at',0)
                        ->where('status',1)->get();
        return view ('Product::add',compact('category','colour'));
        // return view('Product::add');
    }

    public function update(request $request, $id)

    {


        $request-> validate([


            'price'=>'required | numeric' ,
            'stock'=>'required |numeric',
        ]);

        $product = Product::find($id);
        $product->name=$request->name;
        $product->url=$request->url;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->upc = $request->upc;
        $product->discription = $request->Description;
        if($request->hasfile('image'))
        {
            $destination = "uploads/products/".$product->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file=$request->file('image');
            $extension=$file->getclientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/products',$filename);
            $product->image=$filename;
        }
        // dd($request->all);
        if($request->hasFile('sub_img'))
        {
            foreach($request->file('sub_img')as $key=>$insert)
            {
                $subImg = multipleimage::where('product_id',$product->id)->where('sort',$request->input('sort'))->first();
                $destination = "uploads/products/".$subImg->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $imageName = $subImg->image;
                $insert->move('uploads/products/',$imageName);
                // $imgid = $request->image_id[$key];
                // DB::table('image')->where('id',$imgid)->update($save_sub_image);
            }

        }


        $product-> update();
         return back()->with('success','Item Updated successfully!');
         $data=Product::all();
    }
    public function getdata(Request $request)
    {
        $request-> validate([
            'name'=>'required | unique:product',
            'image'=>'required | image | mimes:jpg,png,svg |max:2048',
            'price'=>'required | numeric' ,
            'stock'=>'required |numeric',
            'upc'=>'required |min:12',
            'url',
            'category'=>'required',
            'colour'=>'required',
        ]);
            $status = 1;
        $path = $request->file('image')->store('uploads/products');

        $user_id = Auth::user()->id;
         $product =new Product;
         $product->name=$request->name;
         $product->user_id=$user_id;
         $product->url=$request->url;
         $product->status =$status;
         $product->colour_id =$request->colour;
         $product->category_id =$request->category;
         $product->deleted_at=0;
         if ($request->hasfile('image')){
            $file =$request->file('image');
            $extension= $file->getclientOriginalExtension();
            $filename= time() . '.' .$extension;
            $file->move('uploads/products/',$filename);
            $product->image=$filename;
        }else{
            return $request;
            $product->image= '';
        }
         $product->path = $path;
         $product->price = $request->price;
         $product->stock = $request->stock;
         $product->upc = $request->upc;
         $product->discription = $request->Description;
         $product-> save();

         if($request->hasFile('subimage'))
         {
             foreach($request->file('subimage')as $key=>$insert)
             {
                 $imageName=time().'-'.$insert->getClientoriginalName();
                 $insert->move('uploads/products/',$imageName);
                 $save_sub_image=[

                     'product_id' =>$product->id,
                     'image' => $imageName,
                     'sort'=>$request->input('sort')[$key],

                 ];
                 DB::table('multipleimage')->insert($save_sub_image);
             }

         }


         return back()->with('success','Item created successfully!');
        $data=Product::all();
    }

    function deletedata(Request $request)
    {
        $product = Product::find($request->id);
        $product->deleted_at = 1;
        $product->save();
        return response($product);
    }

    function showtrash()
    {
    $product = Product::where('deleted_at',1)->get();
    return view('Product::trash',['product'=>$product]);
    }

    function restoretrash(Request $request)
    {
        $affected = DB::table('product')
                    ->update(['deleted_at' => 0]);
    }

    function restore_data(Request $request)
    {
        $product = Product::find($request->id);
        $product->deleted_at = 0;
        $product->save();
        return response($product);
    }
    public function checkUrl(Request $request)
    {
//        return $request;
        $product=Product::where('id','!=',$request->id)->where('access_url',$request->url)->first();
        if(isset($product))
        {
            return json_encode(false);
        }
        else {
            return json_encode(true);
        }
    }
}
