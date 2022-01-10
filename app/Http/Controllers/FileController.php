<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request){
        $result = $request->file('file')->store('apiDocs');
        
        return response()->json([
            'msg' => 'Success Uploaded',
            'data' => $result
        ]);
    }
}
