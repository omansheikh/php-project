<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User; // Import the User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\SharedFile;
use Illuminate\Support\Facades\Mail; // Import the Mail facade
use App\Mail\ShareFileNotification; // Import your ShareFileNotification mail class

class FileUploadController extends Controller
{
    public function create()
    {
        return view('file.create'); // Create a view for the file upload form
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpg,png,pdf|max:2048', // Example file validation rules (adjust as needed)
        ], [
            'file.required' => 'Please select a file to upload.',
            'file.mimes' => 'Only JPG, PNG, and PDF files are allowed.',
            'file.max' => 'File size should not exceed 2MB.',
        ]);

        $user = Auth::user();
        $file = $request->file('file');

        // Store the uploaded file in the 'uploads' directory within the storage/app/public folder
        $filePath = $file->store('uploads', 'public');

        // Create a database record for the uploaded file
        File::create([
            'user_id' => $user->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function share(Request $request, $fileId)
{
    // Retrieve the file from the database
    $file = File::find($fileId);

    if (!$file) {
        return redirect()->back()->with('error', 'File not found.');
    }

    // Find the user by email
    $recipientEmail = $request->input('recipient_email');
    $recipientUser = User::where('email', $recipientEmail)->first();

    if (!$recipientUser) {
        return redirect()->back()->with('error', 'User not found with this email.');
    }

    // Create a shared file record
    SharedFile::create([
        'file_id' => $fileId,
        'user_id' => $recipientUser->id,
        'permission_level' => $request->input('permission_level'),
    ]);

    // Notify the recipient user via email (You need to implement your email logic)
    // You can use the $recipientEmail and $file details to send an email notification

    return redirect()->back()->with('success', 'File shared successfully.');
}


    public function destroy($id)
    {
        // Fetch the file by ID
        $file = File::findOrFail($id);

        // Check authorization or ownership before deletion
        if ($file->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized to delete this file.');
        }

        // Delete the file from storage
        Storage::disk('public')->delete($file->file_path);

        // Delete the file record from the database
        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function index()
    {
        $user = Auth::user();

        // Retrieve all files uploaded by the authenticated user
        $files = File::where('user_id', $user->id)->get();

        return view('file.list', compact('files'));
    }

    public function download($id)
    {
        // Fetch the file by ID
        $file = File::findOrFail($id);

        // Check if the file exists in storage
        if ($file && Storage::disk('public')->exists($file->file_path)) {
            // Get the file path
            $filePath = Storage::disk('public')->path($file->file_path);

            // Set the file's MIME type for download
            $mimeType = mime_content_type($filePath);

            // Return the file as a downloadable response
            return response()->download($filePath, $file->file_name, ['Content-Type' => $mimeType]);
        }

        // Handle if the file doesn't exist
        return redirect()->back()->with('error', 'File not found.');
    }
}
