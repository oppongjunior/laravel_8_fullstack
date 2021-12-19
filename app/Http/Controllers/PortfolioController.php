<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Image;

class PortfolioController extends Controller
{
    //contructor function to activate the authentication middle ware for this class
    public function __construct(){
        $this->middleware('auth');
    }
 
    public function index()
    {
        $portfolio = Portfolio::latest()->paginate(5);
        return view('admin.portfolio.portfolio',["portfolio" => $portfolio]);
    }

    //create portfolio
    public function create(){
        return view('admin.portfolio.addportfolio');
    }


    //store portfolio
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:500',
            'description' => 'required|max:10000',
            'category' => 'required|max:256',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $image_file = $request->file("image");
        $image_name = hexdec(uniqid());
        $image_ext = strtolower($image_file->getClientOriginalExtension());

        $image_name = $image_name . '.' . $image_ext;
        $location = "images/portfolio/";
        $saved_image = $location . $image_name;


        //upload image with image intervention
        Image::make($image_file)->resize(400, 266)->save($saved_image);


        //upload image
        //$image_file->move($location, $image_name);


        //insert
        $portfolio = new Portfolio();
        $portfolio->title = $request->input('title');
        $portfolio->description = $request->input('description');
        $portfolio->category = $request->input('category');
        $portfolio->image = $saved_image;
        $portfolio->save();

        return redirect('portfolio/all')->with("success", "Portfolio inserted successfully");
    }

    //show the portfolio edit page
    public function edit($id){
        $portfolio = Portfolio::find($id);
        return view('admin.portfolio.editportfolio',['portfolio'=>$portfolio]);
    }

    //update portfolio
    public function update(Request $request, $id){
        $validate = $request->validate([
            'title' => 'required|max:500',
            'description' => 'required|max:10000',
            'category' => 'required|max:256',
            'image' => 'mimes:png,jpg,jpeg'
        ]);

        $new_image = $request->input('old_image');
        if ($request->file('image')) {
            $image_file = $request->file("image");
            $image_name = hexdec(uniqid());
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $image_name = $image_name . '.' . $image_ext;
            $location = "images/portfolio/";
            $saved_image = $location . $image_name;
            unlink($request->input('old_image'));

            //upload image with image intervention
            Image::make($image_file)->resize(400, 266)->save($saved_image);

            $new_image = $saved_image;
        }

        $portfolio = Portfolio::find($id);
        $portfolio->title = $request->input('title');
        $portfolio->description = $request->input('description');
        $portfolio->category = $request->input('category');
        $portfolio->image = $new_image;
        $portfolio->save();

        return redirect('portfolio/all')->with("success", "Portfolio updated successfully");

    }


    //delete portfolio
    public function destroy($id){

        $portfolio = Portfolio::find($id);
        $portfolio = $portfolio->image;
        unlink($portfolio);
        Portfolio::find($id)->delete();
        return redirect('portfolio/all')->with("success", "Portfolio deleted successfully");
    }
}
