<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Image;

class AboutController extends Controller
{
    //contructor function to activate the authentication middle ware for this class
    public function __construct(){
        $this->middleware('auth');
    }
 
    public function index()
    {
        $about = About::latest()->paginate(5);
        return view('admin.About.about',["about" => $about]);
    }

    //create slider
    public function create(){
        return view('admin.about.addabout');
    }


    //store slider
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'required|max:500',
            'long_description' => 'required|max:10000',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $image_file = $request->file("image");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/about/";
        $saved_image = $location . $image_name;


        //upload image with image intervention
        Image::make($image_file)->resize(400, 266)->save($saved_image);


        //upload image
        //$image_file->move($location, $image_name);


        //insert
        $about = new About();
        $about->title = $request->input('title');
        $about->long_description = $request->input('long_description');
        $about->short_description = $request->input('short_description');
        $about->image = $saved_image;
        $about->save();

        return redirect('admin/about')->with("success", "About inserted successfully");
    }

    //show the about edit page
    public function edit($id){
        $about = About::find($id);
        return view('admin.About.editabout',['about'=>$about]);
    }

    //update about
    public function update(Request $request, $id){
        $validate = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'required|max:500',
            'long_description' => 'required|max:10000',
            'image' => 'mimes:png,jpg,jpeg'
        ]);

        $new_image = $request->input('old_image');
        if ($request->file('image')) {
            $image_file = $request->file("image");
            $image_name = hexdec(uniqid());
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $image_name = $image_name . '.' . $image_ext;
            $location = "images/about/";
            $saved_image = $location . $image_name;
            unlink($request->input('old_image'));

            //upload image with image intervention
            Image::make($image_file)->resize(400, 266)->save($saved_image);

            $new_image = $saved_image;
        }

        $about = About::find($id);
        $about->title = $request->input('title');
        $about->long_description = $request->input('long_description');
        $about->short_description = $request->input('short_description');
        $about->image = $new_image;
        $about->save();

        return redirect('admin/about')->with("success", "About updated successfully");

    }


    //delete slider
    public function destroy($id){

        $slider = About::find($id);
        $image = $slider->image;
        unlink($image);
        About::find($id)->delete();
        return redirect('admin/about')->with("success", "About deleted successfully");
    }
}
