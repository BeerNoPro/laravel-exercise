<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class UploadfileController extends Controller
{

    public function index() {
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        $images = [];
        $files = Storage::disk('s3')->files('viet-hung');

        foreach ($files as $file) {
            $images[] = [
                'name' => str_replace('viet-hung/', '', $file),
                'src' => $url . $file
            ];
        }

        return view('uploadfile.index', compact('images'));
    }

    public function create() {
        return view('uploadfile.form');
    }

    // Upload files s3
    public function store(Request $request) {

        if (!$request->hasFile('filenames')) {
            return view('uploadfile.form', ['error' => 'Please enter your file!!']);
        }

        $this->validate($request, [
            'filenames' => 'required',
            'filenames.*' => 'image'
        ]);

        $files = [];
        if ($request->hasFile('filenames')) {

            foreach ($request->file('filenames') as $file) {
                
                $imageName = $file->getClientOriginalName();
                $filePath = 'viet-hung/' . $imageName;
                
                Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');

                $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $filePath;

                $file = new File();
                $file->filenames = $url;
                $file->save();
            }

        }

        return view('uploadfile.form');
    }

    // delete image s3
    public function destroy(Request $request) {
        
        dd($request);
        
        Storage::disk('s3')->delete($request);

        return back()->with('success', 'Image deleted success');
    }

}

