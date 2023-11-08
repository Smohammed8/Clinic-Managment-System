@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="description">Video Description:</label>
                <input type="text" name="description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status">Video Status:</label>
                <input type="text" name="status" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="video">Upload Video:</label>
                <input type="file" name="video" class="form-control" required>
            </div>
            <div class="progress" style="display: none;">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary">Upload Video</button>
            </div>
        </form>
        <div class="video-preview" style="display: none;">
            <h4>Video Preview:</h4>
            <video id="preview" width="320" height="240" controls></video>
        </div>
    </div>
@section('scripts')
    <script>
        const form = document.querySelector('form');
        const progressBar = document.querySelector('.progress');
        const progressBarInner = document.querySelector('.progress-bar');
        const videoPreview = document.querySelector('#preview');
        const videoPreviewContainer = document.querySelector('.video-preview');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            progressBar.style.display = 'block';

            const formData = new FormData(form);
            const response = await axios.post(form.action, formData, {
                onUploadProgress: (progressEvent) => {
                    const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent
                        .total);
                    progressBarInner.style.width = percentCompleted + '%';
                },
            });

            progressBar.style.display = 'none';

            if (response.status === 200) {
                videoPreview.src = response.data.file_path;
                videoPreviewContainer.style.display = 'block';
            }
        });
    </script>
@endsection

@endsection
