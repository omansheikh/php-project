<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use App\Models\SharedFile;
use App\Models\User; // Assuming you have a User model

class FileSharingController extends Controller
{
    public function share(Request $request, $fileId)
    {
        // Retrieve the file from the database
        $file = File::find($fileId);

        if (!$file) {
            return redirect()->back()->with('error', 'File not found.');
        }

        // Validate the recipient's email
        $request->validate([
            'recipient_email' => 'required|email',
        ]);

        // Find the recipient user by email
        $recipientEmail = $request->input('recipient_email');
        $recipientUser = User::where('email', $recipientEmail)->first();

        if (!$recipientUser) {
            return redirect()->back()->with('error', 'User not found with this email.');
        }

        // Create a shared file record
        $sharedFile = SharedFile::create([
            'file_id' => $fileId,
            'user_id' => $recipientUser->id,
            "shared_with_email" => $recipientEmail
        ]);

        if (!$sharedFile) {
            return redirect()->back()->with('error', 'Failed to share the file. Please try again.');
        }

        return redirect()->back()->with('success', 'The file was successfully shared with ' . $recipientEmail);
    }
}
