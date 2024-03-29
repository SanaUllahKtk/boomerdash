<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    //

    public function store(Request $request)
    {
        // Validate the uploaded file
        // $request->validate([
        //     'file' => 'required|file|mimes:jpeg,jpg,png,mp4', // Example validation rules
        // ]);

        // Store the file in a public directory
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);

        // Get the full URL of the uploaded file
        $filePath = 'uploads/' . $filename;

        // Return the file path in the response
        return response()->json(['success' => 'File uploaded successfully', 'filePath' => $filePath]);
    }
}
