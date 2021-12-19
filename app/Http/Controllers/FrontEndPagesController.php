<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Brand;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontEndPagesController extends Controller
{
    //
    public function Home(){
        $clients = Brand::latest()->get();
        $sliders = Slider::latest()->get();
        $about = About::first();
        $services = Service::all();
        $portfolio = Portfolio::all();
        return view("frontend.pages.home",['clients'=>$clients,'sliders'=>$sliders,'about'=>$about,'services'=>$services,'portfolio'=>$portfolio]);
    }
     //contact
     public function contact(){
        return view("frontend.pages.contact");
    }
}
