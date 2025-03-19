<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserFile;
use App\Models\User;

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
                'user_file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
            ]);

            // $all = UserFile::where('user_id', 1);
            // var_dump($all);
            return response()->json(['ok' => 200,'path' => ($path ? $path : "none")]); // ['path' => $path] // , "all" => [$all]
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        
    }

    // public function picture(Request $request){
    //     var_dump('jopa');
    //     $raw = DB::table('user_files')->select([
    //         'user_id',
    //         'user_file_name',
    //         'file_path',
    //     ])->where('id', 2)->get();
    //     // $status = $raw->status();
    //     var_dump($raw[0]->user_id);
    //     $jop = json_decode($raw, true);
    //     var_dump($jop[0]['file_path']);

    //     return response()->json(['ok' => 200,'path' =>  "none"]);
    // }


    // public function picture(Request $request){
    //     var_dump('jopa');
    //     // $raw = User::where('id', 1)->user_files->get();
    //     $comment = User::where('id', Auth::id())->with('user_files')->get();
    //     // $status = $raw->status();
    //     // var_dump($raw[0]->user_id);
    //     // var_dump($comment[0]->id);
    //     // var_dump($comment);

    //     $jop = json_encode($comment, true);
    //     // var_dump($jop[0]['file_path']);
    //     var_dump($jop);

    //     return response()->json(['ok' => 200,'path' => $comment]);
    // }

    public function picture(Request $request){
        var_dump('jopa');
        // $raw = User::where('id', 1)->user_files->get();
        $comment = DB::connection('sqlsrv')->table('Пользователи')->where('id', [844,846])->get();
        // $status = $raw->status();
        // var_dump($raw[0]->user_id);
        // var_dump($comment[0]->id);
        // var_dump($comment);

        $jop = json_encode($comment, true);
        // var_dump($jop[0]['file_path']);
        var_dump($jop);

        return response()->json(['ok' => 200,'path' => $comment]);
    }



}