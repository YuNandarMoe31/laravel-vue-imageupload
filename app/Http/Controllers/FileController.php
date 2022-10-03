<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
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
            'title' => 'required',
            'file' => 'required|mimes:jpg,png|max:2048',
        ]);

        if($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $request->file('file')->storeAs('uploads', $fileName, 'public');    
        }

        File::create([
            'title' => $request->title,
            'image' => $fileName
        ]);

        return redirect()->route('file.upload');
    }
}
