<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Image;

class ServiceController extends Controller
{
    //contructor function to activate the authentication middle ware for this class
    public function __construct(){
        $this->middleware('auth');
    }
 
    public function index()
    {
        $services = Service::latest()->paginate(5);
        return view('admin.Service.service',["services" => $services]);
    }

    //create slider
    public function create(){
        return view('admin.Service.addservice');
    }


    //store slider
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:500',
            'description' => 'required|max:10000',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $image_file = $request->file("image");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/services/";
        $saved_image = $location . $image_name;


        //upload image with image intervention
        Image::make($image_file)->resize(400, 266)->save($saved_image);


        //upload image
        //$image_file->move($location, $image_name);


        //insert
        $service = new Service();
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->image = $saved_image;
        $service->save();

        return redirect('service/all')->with("success", "Service inserted successfully");
    }

    //show the about edit page
    public function edit($id){
        $service = Service::find($id);
        return view('admin.Service.editservice',['service'=>$service]);
    }

    //update about
    public function update(Request $request, $id){
        $validate = $request->validate([
            'title' => 'required|max:500',
            'description' => 'required|max:10000',
            'image' => 'mimes:png,jpg,jpeg'
        ]);

        $new_image = $request->input('old_image');
        if ($request->file('image')) {
            $image_file = $request->file("image");
            $image_name = hexdec(uniqid());
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $image_name = $image_name . '.' . $image_ext;
            $location = "images/services/";
            $saved_image = $location . $image_name;
            unlink($request->input('old_image'));

            //upload image with image intervention
            Image::make($image_file)->resize(400, 266)->save($saved_image);

            $new_image = $saved_image;
        }

        $service = Service::find($id);
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->image = $new_image;
        $service->save();

        return redirect('service/all')->with("success", "Service updated successfully");

    }


    //delete slider
    public function destroy($id){

        $service = Service::find($id);
        $service = $service->image;
        unlink($service);
        Service::find($id)->delete();
        return redirect('service/all')->with("success", "Service deleted successfully");
    }
}
