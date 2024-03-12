@extends('frontend.layouts.app')

@section('content')
    

<section>
    <div class="container-fluid">
        <div class="px-2 py-4 px-md-0 py-md-3">
            <div class="d-flex mb-3 align-items-baseline border-bottom justify-content-between">
                <h3 class="h5 fw-700 mb-0">
                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">
                        {{ translate('Videos') }}
                    </span>
                </h3>
            </div>
            
            
<div class="container">
  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach(\App\Models\Video::all() as $video)
      <div class="col d-flex pr-0 pl-1"> 
        <div class="card flex-fill">
          <img style="max-height: 170px;min-height: 170px;" class="card-img-top" src="{{ uploaded_asset($video->banner) }}" data-src="{{ uploaded_asset($video->banner) }}" alt="Express Vpn" onerror="this.onerror=null;this.src='http://boomerdash.com/public/assets/img/placeholder.jpg';">
            
          <div class="card-body" style="padding: 20px 10px !important;">
          
            <h4 class="card-title"> {{$video->name}}</h4>
            <p class="card-text" style="color: #7d258c;">
             
                  Earn up to <span style="text-transform:lowercase">  {{$video->point}}  Points
             
            </p>
                              <input type="hidden" class="points" value="{{$video->point}}">
                    <div id="status" class="incomplete" style="display:none">
                        <span>Play status: </span>
                        <span class="status complete">COMPLETE</span>
                        <span class="status incomplete">INCOMPLETE</span>
                        <br />
                    <div>
                    <span id="played">0</span> seconds out of 
                    <span id="duration"></span> seconds. (only updates when the video pauses)
                    </div>
                    </div>
                    
                    
              <button class="btn btn-primary" onClick="newVideoModal('http://boomerdash.com/{{$video->videolink}}',{{$video->point}},'{{$video->name}}',{{$video->id}})">Watch</button>
          
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

            
</section>










<div class="modal fade" id="new-video-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header" style="background: transparent;border-color: transparent;">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close-pressed" onClick="newVideoModalClose()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <video width="480" height="400" controls="false" poster="" id="video" style="width: 100%;">
                        <source type="video/mp4" src="">
                        </source>
                    </video>
                    <input type="hidden" id="points" value="">
                    <input type="hidden" id="videoId" value="">
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        function newVideoModal(url,points,title,id){
            $('#video').attr('src', url);
            $('#points').val(points);
            $('#videoId').val(id);
            $('#exampleModalLabel').html(title);
            $('#new-video-modal').modal('show');
        }
        function newVideoModalClose(url){
            $('#points').val('');
            $('#video').attr('src', '');
        }

        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.auction_products') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#auction_products').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
    <script>
var video = document.getElementById("video");
var timeStarted = -1;
var timePlayed = 0;
var duration = 0;
// If video metadata is laoded get duration
if(video.readyState > 0)
  getDuration.call(video);
//If metadata not loaded, use event to get it
else
{
  video.addEventListener('loadedmetadata', getDuration);
}
// remember time user started the video
function videoStartedPlaying() {timePlayed = 0
  timeStarted = new Date().getTime()/1000;
}
function videoStoppedPlaying(event) {
  // Start time less then zero means stop event was fired vidout start event
  if(timeStarted>0) {
    var playedFor=0;  
    playedFor = new Date().getTime()/1000 - timeStarted;
    timeStarted = -1;
    // add the new ammount of seconds played
    timePlayed+=playedFor;
  }
  document.getElementById("played").innerHTML = Math.round(timePlayed)+"";
  // Count as complete only if end of video was reached
  if(timePlayed>=duration && event.type=="ended") {
    document.getElementById("status").className="complete";
      var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  
var points = document.getElementById("points").value;
var videoId = document.getElementById("videoId").value;
   duration = video.duration;
  xhttp.open("POST", "{{ route('savepointsfromvidoe') }}", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("duration="+Math.round(duration)+"&_vid="+videoId+"&_pnt="+points+"&total_watch="+Math.round(timePlayed)+"&_token={{ csrf_token() }}");
    
  }
}

function getDuration() {
  duration = video.duration;
  document.getElementById("duration").appendChild(new Text(Math.round(duration)+""));
  console.log("Duration: ", duration);
}

video.addEventListener("play", videoStartedPlaying);
video.addEventListener("playing", videoStartedPlaying);

video.addEventListener("ended", videoStoppedPlaying);
video.addEventListener("pause", videoStoppedPlaying);
    </script>
@endsection
