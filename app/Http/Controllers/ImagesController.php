<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImagesController extends Controller {

    protected $localPath = "userFile"; // Path to your local storage

    // protected $localPath = "\Debian\home\kogop\server_petProj1\storage\app\private\userFile"; // Path to your local storage
    public function images()
    {
        
        // Check if the file exists
        if (Auth::id() || 1) {
            // $file = $request->file('userFile');
            // var_dump($file);
            $path = "";
            $userId = Auth::id();
            $userId = 1;
            // Process the file (e.g., store it)
            // $path = $file->storePublicly('userFiles'); // Stores in storage/app/public/photos
            // точно, я же могу вот этот path который возвращает сохранка сохранять в базу к файлу и заебись будет
            $imageUrls = [];
            // тут типо отправка в базу с $file->getClientOriginalName() и $path
            $images = DB::table('user_files')->where('user_id', $userId)->get();
            foreach ($images as $key => $value) {
                // return $value->file_path;  // explode("/", $value->file_path)[1]
                if (Storage::disk('local')->exists($value->file_path)) {
                    // return "jop";
                    // return response(Storage::disk('local')->get($value->file_path), 200);

                    $imageUrls[] = [
                        "filepath" => route('images.show', ['file_path' => explode("/",$value->file_path)[1]]), // File::get(
                        // "type" => File::mimeType(Storage::disk('local')->$value->file_path), 
                    ];
                }
            }
            
            // $images = Storage::disk('public')->files('images');
            
    
            // foreach ($images as $image) {
            //     $imageUrls[] = asset('storage/' . $image);
            // }
            return response()->json(['ok' => 200,'images' => ($imageUrls ? $imageUrls : "none")]); // ['path' => $path] 
        } else {
            return response()->json(['error' => 'Not authorized'], 400);
        }
        
    }

    public function show($file_path)
    {
        $filePath = $this->localPath . '\\' . $file_path;

        var_dump($filePath);
        if (Storage::disk('local')->exists($filePath)) {
            abort(404);
        }

        $file = Storage::disk('local')->get($filePath);
        $type = Storage::disk('local')->mimeType($filePath);
        var_dump($type);

        return response($file, 200)->header('Content-Type', $type);
    }



}