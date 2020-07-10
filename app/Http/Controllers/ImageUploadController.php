<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use File;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function index()
    {

        $create = Storage::disk('local')->exists('images.json') ? json_decode(Storage::disk('local')->get('images.json')) : [];
        $path = storage_path() . "\app\images.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $json = json_decode(file_get_contents($path));
        //  $json = json_encode($json);
        //return $json;

        return view("user.image_up", [
            'images' => $json
        ]);

       // return view("user.image");
    }

    function action(Request $request)
    {
        

        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:png|max:5120'
        ]);

        if ($validation->passes()) {
            $image = $request->file('select_file');
            $title = $request->image_name;
            $new_name = $title . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            //store in data.json file
            $contactInfo = Storage::disk('local')->exists('images.json') ? json_decode(Storage::disk('local')->get('images.json')) : [];
            $info = $request->only(['image_name']);
            array_push($contactInfo, $info);
            Storage::disk('local')->put('images.json', json_encode($contactInfo));
            //return redirect('/');

            $path = storage_path() . "\app\images.json"; // ie: /var/www/laravel/app/storage/json/filename.json

            $json = json_decode(file_get_contents($path));

            return response()->json([
                'message'   => 'Image Upload Successfully',
                'data' => $json,
                'class_name'  => 'alert-success'
            ]);
        } else {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }

    public function delete($name)
    {
        $image_path = public_path() . "\images/$name.png";  // Value is not URL but directory file path
        $path = storage_path() . "\app\images.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $json = json_decode(file_get_contents($path), true);
        $arr_index = array();

        foreach ($json as $key => $value) {
            if ($value['image_name'] == $name) {
                $arr_index[] = $key;
            }
        }
        foreach ($arr_index as $i) {
            unset($json[$i]);
        }
        $json_arr = array_values($json);
        file_put_contents($path, json_encode($json_arr));

        //unset($json[$name]);

        //$d = json_encode($json);
        //return "s";
        if (file_exists($image_path)) {
            File::delete($image_path);

            return redirect('/')->with('message', 'Image Deleted Succesfully');
        }
    }
}
