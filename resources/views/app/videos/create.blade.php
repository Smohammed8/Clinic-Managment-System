@extends('layouts.app')

@section('content')
    <div class="container">


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="videoTitle" class="form-label">Video Title</label>
                <input type="text" class="form-control" id="videoTitle" name="videoTitle" required>
            </div>

            <div class="mb-3">
                <label for="videoDescription" class="form-label">Video Description</label>
                <textarea class="form-control" id="videoDescription" name="videoDescription" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="videoFile" class="form-label">Video File</label>
                <input type="file" class="form-control" id="videoFile" name="videoFile" required>
            </div>

            <div class="mb-3">
                <label for="videoStatus" class="form-label">Video Status</label>
                <select class="form-select" id="videoStatus" name="videoStatus" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Upload Video</button>
        </form>
        <div class="video-preview" style="display: none;">
            <h4>Video Preview:</h4>
            <video id="preview" width="320" height="240" controls></video>
        </div>
    </div>
@endsection
