<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class PostController extends Controller
{
    public function imageUploadPost()

    {
        request()->validate([

            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $imageName = time() . '.' . request()->file->getClientOriginalExtension();
        request()->file->move(public_path('avatar_temp'), $imageName);
        return response()->json([
            'status' => 'success',
            'file' => $imageName
        ], 200);
        /*return back()

            ->with('status','success')

            ->with('file',$imageName);*/

    }
    public function deleteTempImage(Request $request){
        $param1= $request->get('tempImage');
        $tempImage= isset($param1)?$param1:"";
        File::delete(public_path('avatar_temp') . '/' . $tempImage);
        return response()->json([
            'status' => 'success',

        ], 200);
    }
}
