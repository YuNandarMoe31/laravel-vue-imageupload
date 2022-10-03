<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $files = File::latest()->get();
        return Inertia::render('FileUpload', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'file' => ['required'],
        ]);

        if($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $request->file('file')->storeAs('uploads', $fileName, 'public');    
        }

        File::create([
            'title' => $request->title,
            'name' => $fileName
        ]);

        return redirect()->route('file.upload');
//
//        $request->validate([
//            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
//        ]);
//
//        $fileUpload = new File;
//
//        if ($request->file()) {
//            $file_name = time() . '_' . $request->file->getClientOriginalName();
//            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
//
//            $fileUpload->name = time() . '_' . $request->file->getClientOriginalName();
//            $fileUpload->save();
//
//            return redirect()->route('file.upload');
//        }
    }
}
