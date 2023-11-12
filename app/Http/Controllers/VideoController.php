<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    //
    public function create()
    {
        return view('app.videos.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'videoTitle' => 'required|string|max:255',
            'videoDescription' => 'required|string',
            'videoFile' => 'required|mimes:mp4,mov,avi,wmv|max:102400', // Maximum file size is now 100 MB
            'videoStatus' => 'required|in:active,inactive',
        ]);

        // Handle file upload
        dd($request);
        // $videoPath = $request->file('videoFile')->store('/clinic/videos', 'public');


        // Create a new video record in the database
        $video = Video::create([
            'title' => $request->input('videoTitle'),
            'desc' => $request->input('videoDescription'),
            'status' => $request->input('videoStatus'),
            // 'file_path' => $videoPath,
        ]);

        // Redirect to the video index page or show success message
        // You can customize this based on your application flow
        return redirect()->route('videos.create')->with('success', 'Video uploaded successfully!');
    }

    // Define other methods for managing videos (edit, update, delete, etc.).

}
