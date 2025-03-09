<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{

    public function store(Request $request)
    {
        
   // Check if the file exists
        if ($request->hasFile('userFile')) {
            $file = $request->file('userFile');
            // var_dump($file);

            // Process the file (e.g., store it)
            $path = $file->storePubliclyAs('userFiles', $file->getClientOriginalName()); // Stores in storage/app/public/photos
            return response()->json(['ok' => 200,'path' => $path]); // ['path' => $path]
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        
    }


}