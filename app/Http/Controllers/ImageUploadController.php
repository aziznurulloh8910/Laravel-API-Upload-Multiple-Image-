<?php

namespace App\Http\Controllers;

use App\Models\ImageUpload;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'image' => 'required|array',
            'image.*' => 'required|mimes:jpg,jpeg,png,bmp',
        ]);
        
        $images = $request->file('image');

        $imgName = [];
        foreach($images as $image){
            $new_name = rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/images'),$new_name);
            $imgName[] = $new_name;
            
            ImageUpload::create([
                'title' => $new_name,
                'path' => $new_name
            ]);
        }
        
        $imagedb = $imgName;

        return response()->json([
            'msg' => 'Image Successfuly Uploaded',
            'file' => $imagedb,
        ]);

    }
}
