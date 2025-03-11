<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class FileUploadController extends Controller
{

    // надо для красоты валидацию реквеста сделать
    public function store(Request $request)
    {
        
        // Check if the file exists
        if ($request->hasFile('userFile')) {
            $file = $request->file('userFile');
            // var_dump($file);
            $path = "";
            $userId = Auth::id();
            // Process the file (e.g., store it)
            $path = $file->storePublicly('userFiles'); // Stores in storage/app/public/photos
            // точно, я же могу вот этот path который возвращает сохранка сохранять в базу к файлу и заебись будет

            // тут типо отправка в базу с $file->getClientOriginalName() и $path
            DB::table('user_files')->insert([
                'user_id' => $userId,
                'file_path' => $path
            ]);
            return response()->json(['ok' => 200,'path' => ($path ? $path : "none")]); // ['path' => $path]
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        
    }


}