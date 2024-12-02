<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;


class FileController extends Controller
{
    // Show the file upload form
    public function create()
    {
        return view('file.create');
    }

    // Handle the file upload and storage
    public function store(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Define the folder name based on the company's name
        $folderName = 'TeeRex Company Technology CO.,LTD';
        
        // Sanitize the folder name
        $sanitizedFolderName = preg_replace('/[^a-zA-Z0-9_-]/', '-', $folderName);

        if ($request->hasFile('file')) {
            // Store the file in S3
            $filePath = $request->file('file')->storeAs(
                'Templates/' . $sanitizedFolderName,
                $request->file('file')->getClientOriginalName(),
                's3'
            );

            // Generate the public URL of the uploaded file
            $fileUrl = Storage::disk('s3')->url($filePath);

            // Store file information in the database
            $file = File::create([
                'original_name' => $request->file('file')->getClientOriginalName(),
                's3_path' => $filePath,
                'url' => $fileUrl,
            ]);

            return back()->with('success', 'File uploaded successfully! URL: ' . $fileUrl);
        }

        return back()->withErrors('File upload failed.');
    }
    // Read (Display All Files)
    public function index()
    {
        $files = File::all(); // Get all files from the database
        return view('file.index', compact('files'));
    }

    // Update (Change file or metadata)
    public function edit($id)
    {
        $file = File::findOrFail($id);
        return view('file.edit', compact('file'));
    }

    public function update(Request $request, $id)
    {
        $file = File::findOrFail($id);

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Define the folder name based on the company's name
        $folderName = 'TeeRex Company Technology CO.,LTD';
        $sanitizedFolderName = preg_replace('/[^a-zA-Z0-9_-]/', '-', $folderName);

        // Delete the old file from S3
        Storage::disk('s3')->delete($file->s3_path);

        if ($request->hasFile('file')) {
            // Store the new file in S3
            $filePath = $request->file('file')->storeAs(
                'Templates/' . $sanitizedFolderName,
                $request->file('file')->getClientOriginalName(),
                's3'
            );

            // Generate the public URL of the new file
            $fileUrl = Storage::disk('s3')->url($filePath);

            // Update file information in the database
            $file->update([
                'original_name' => $request->file('file')->getClientOriginalName(),
                's3_path' => $filePath,
                'url' => $fileUrl,
            ]);

            return redirect()->route('files.index')->with('success', 'File updated successfully!');
        }

        return back()->withErrors('File update failed.');
    }

    // Delete (Remove file from S3 and database)
    public function destroy($id)
    {
        $file = File::findOrFail($id);

        // Delete the file from S3
        Storage::disk('s3')->delete($file->s3_path);

        // Delete the file record from the database
        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully!');
    }
}
