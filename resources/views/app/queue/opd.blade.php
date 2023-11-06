@extends('layouts.app_queue')

@section('content')
    <div class="container-fluid" style="height: 100vh;">
        <div class="row" style="height: 63%!important;;" height: 65%!important;>
            <div class="col-7" style="height: 63%;">
                <div class="p-2">
                    {{ Widget::run('opdQueueCard') }}
                </div>
            </div>
            <div class="col-5 mt-3 " style="height: 63%;">
                <!-- Content for the col-3 section -->
                <div id="videoContainer" style="width: 100%; height: 700px; overflow: hidden;">
                    <video id="videoPlayer" width="100%" height="auto" controls autoplay loop muted>
                        <source src="{{ asset('desk_image/videos/1.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>

            <script>
                // Unmute the video after 5 seconds
                const videoPlayer = document.getElementById('videoPlayer');


                // videoPlayer.muted = false;

                // const videoPlayer = document.getElementById('videoPlayer');
                const videoSources = [
                    '{{ asset('desk_image/videos/1.mp4') }}',
                    '{{ asset('desk_image/videos/2.mp4') }}',
                    '{{ asset('desk_image/videos/3.mp4') }}'
                ];
                let currentVideoIndex = 0;

                videoPlayer.addEventListener('ended', playNextVideo);

                function playNextVideo() {
                    if (currentVideoIndex < videoSources.length - 1) {
                        currentVideoIndex++;
                        videoPlayer.src = videoSources[currentVideoIndex];
                        videoPlayer.load();
                        videoPlayer.play();
                    } else {
                        // All videos have played
                        // You can add any further actions here, like looping back to the first video
                    }
                }

                // Start playing the first video
                videoPlayer.play();
            </script>

        </div>
        <div class="col-md-12 bg-info" style="height: 35%;">
            <!-- Content for the bottom section -->
            <div class="p-2">
                {{ Widget::run('opdQueueTable') }}
            </div>
        </div>
    </div>
@endsection
