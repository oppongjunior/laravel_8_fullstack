<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use App\Models\Notification;
use Illuminate\Http\Request;
use Image;
use PhpParser\Node\Stmt\Foreach_;

class BrandController extends Controller
{
    //contructor function to activate the authentication middle ware for this class
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        $trashed = Brand::onlyTrashed()->paginate(5);
        return view("admin.Brand.Index", ["brands" => $brands, "trashed" => $trashed]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $image_file = $request->file("brand_image");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/brands/";
        $saved_image = $location . $image_name;


        //upload image with image intervention
        Image::make($image_file)->resize(300, 200)->save($saved_image);

        //upload image
        //$image_file->move($location, $image_name);


        //insert
        $brand = new Brand();
        $brand->brand_name = $request->input('brand_name');
        $brand->brand_image = $saved_image;
        $brand->save();

        //add notification
        $notification = new Notification();
        $notification->type = "brand";
        $notification->message = "New brand has been added";
        $notification->read = 0;

        $notification->save();

        return redirect()->back()->with("success", "Brand insert successfully");
    }

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $brand = Brand::find($id);
        return view("admin.Brand.edit", ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'brand_name' => 'max:255|min:4',
            'brand_image' => 'mimes:png,jpg,jpeg'
        ]);

        $new_image = $request->input('old_image');
        if ($request->file('brand_image')) {
            $image_file = $request->file("brand_image");
            $image_name = hexdec(uniqid());
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $image_name = $image_name . '.' . $image_ext;
            $location = "images/brands/";
            $saved_image = $location . $image_name;
            unlink($request->input('old_image'));

            //upload image with image intervention
            Image::make($image_file)->resize(300, 200)->save($saved_image);


            //upload image
            //$image_file->move($location, $image_name);
            $new_image = $saved_image;
        }

        //insert
        $brand = Brand::find($id);
        $brand->brand_name = $request->input('brand_name');
        $brand->brand_image = $new_image;
        $brand->save();

        return redirect('brand/all')->with("success", "Brand updated successfully");
    }

    //delete to trash
    public function softDelete($id)
    {
        Brand::find($id)->delete();
        return redirect('brand/all')->with("success", "Brand deleted successfully");
    }
    //restore
    public function restore($id)
    {
        Brand::withTrashed()->find($id)->restore();
        return redirect('brand/all')->with("success", "Brand restored successfully");
    }

    /**
     * Remove the specified resource from storage.
     * complete remove image from trash
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $brand = Brand::withTrashed()->find($id);
        $brand_image = $brand->brand_image;
        unlink($brand_image);

        Brand::onlyTrashed()->find($id)->forceDelete();
        return redirect('brand/all')->with("success", "Brand deleted successfully");
    }

    //multipic function
    public function mulitipic()
    {
        $images = Multipic::all();
        return view("admin.multipics.index", ['images' => $images]);
    }

    //store mulitple images function
    public function storeImages(Request $request)
    {


        $image_file = $request->file("images");
        $x = 0;
        foreach ($image_file as $image) {

            $validate = $request->validate([
                "images" => 'required',
                "images.*" => 'mimes:png,jpg,jpeg'
            ]);

            $image_name = hexdec(uniqid());
            $image_ext = strtolower($image->getClientOriginalExtension());

            $image_name = $image_name . '.' . $image_ext;
            $location = "images/multipics/";
            $saved_image = $location . $image_name;


            //upload image with image intervention
            Image::make($image)->resize(400, 266)->save($saved_image);

            //upload image
            //$image_file->move($location, $image_name);

            //insert
            $images = new Multipic();
            $images->image = $saved_image;
            $images->save();

            $x++;
        }
        return redirect()->back()->with("success", "images insert successfully");
    }
}
