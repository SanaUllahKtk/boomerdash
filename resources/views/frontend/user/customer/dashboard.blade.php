@extends('frontend.layouts.user_panel')

@section('panel_content')

<div class="aiz-titlebar mt-2 mb-4">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Dashboard') }}</h1>
        </div>
    </div>
</div>
<div class="row gutters-10" style="display:none;">
    <div class="col" >
        <div class=" bg-grad-1 text-white rounded-lg mb-4 overflow-hidden" style="background: linear-gradient(90deg, rgba(125,37,140,1) 12%, rgba(38,99,242,1) 32%, rgba(54,115,255,1) 42%, rgba(250,237,46,1) 66%, rgba(245,153,41,1) 81%, rgba(217,36,37,1) 99%);">
            <div class="px-3 pt-3">
                @php
                    $user_id = Auth::user()->id;
                    $cart = \App\Models\Cart::where('user_id', $user_id)->get();
                @endphp
                @if(count($cart) > 0)
                <div class="h_pg_text h3 fw-700">
                    {{ count($cart) }} {{ translate('Product(s)') }}
                </div>
                @else
                <div class="h_pg_text h3 fw-700">
                    0 {{ translate('Items') }}
                </div>
                @endif
                <div class="h_pg_text1 opacity-50">{{ translate('in your cart') }}</div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,192L30,208C60,224,120,256,180,245.3C240,235,300,181,360,144C420,107,480,85,540,96C600,107,660,149,720,154.7C780,160,840,128,900,117.3C960,107,1020,117,1080,112C1140,107,1200,85,1260,74.7C1320,64,1380,64,1410,64L1440,64L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
            </svg>
        </div>
    </div>
    <div class="col" >
        <div class=" bg-grad-2 text-white rounded-lg mb-4 overflow-hidden" style="background: linear-gradient(90deg, rgba(125,37,140,1) 12%, rgba(38,99,242,1) 32%, rgba(54,115,255,1) 42%, rgba(250,237,46,1) 66%, rgba(245,153,41,1) 81%, rgba(217,36,37,1) 99%);">
            <div class=" px-3 pt-3">
                @php
                    $orders = \App\Models\Order::where('user_id', Auth::user()->id)->get();
                    $total = 0;
                    foreach ($orders as $key => $order) {
                        $total += count($order->orderDetails);
                    }
                @endphp
                <div class="h_pg_text h3 fw-700 ">{{ count(Auth::user()->wishlists)}} {{ translate('Items') }}</div>
                <div class="h_pg_text1 opacity-50">{{ translate('in your wishlist') }}</div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
            </svg>
        </div>
    </div>
    <div class="col" >
        <div class=" bg-grad-3 text-white rounded-lg mb-4 overflow-hidden" style="background: linear-gradient(90deg, rgba(125,37,140,1) 12%, rgba(38,99,242,1) 32%, rgba(54,115,255,1) 42%, rgba(250,237,46,1) 66%, rgba(245,153,41,1) 81%, rgba(217,36,37,1) 99%);">
            <div class=" px-3 pt-3">
                @php
                    $orders = \App\Models\Order::where('user_id', Auth::user()->id)->get();
                    $total = 0;
                    foreach ($orders as $key => $order) {
                        $total += count($order->orderDetails);
                    }
                @endphp
                <div class="h_pg_text h3 fw-700 ">{{ $total }} {{ translate('Items') }}</div>
                <div class="h_pg_text1 opacity-50">{{ translate('you ordered') }}</div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,192L26.7,192C53.3,192,107,192,160,202.7C213.3,213,267,235,320,218.7C373.3,203,427,149,480,117.3C533.3,85,587,75,640,90.7C693.3,107,747,149,800,149.3C853.3,149,907,107,960,112C1013.3,117,1067,171,1120,202.7C1173.3,235,1227,245,1280,213.3C1333.3,181,1387,107,1413,69.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
            </svg>
        </div>
    </div>
</div>
<div class="row gutters-10">
    <div class="col-md-6">
        <div class="card" style="display:none;">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Default Shipping Address') }}</h6>
            </div>
            <div class="card-body">
                @if(Auth::user()->addresses != null)
                    @php
                        $address = Auth::user()->addresses->where('set_default', 1)->first();
                    @endphp
                    @if($address != null)
                        <ul class="list-unstyled mb-0">
                            <li class=" py-2"><span>{{ translate('Address') }} : {{ $address->address }}</span></li>
                            <li class=" py-2"><span>{{ translate('Country') }} : {{ $address->country->name }}</span></li>
                            <li class=" py-2"><span>{{ translate('State') }} : {{ $address->state->name }}</span></li>
                            <li class=" py-2"><span>{{ translate('City') }} : {{ $address->city->name }}</span></li>
                            <li class=" py-2"><span>{{ translate('Postal Code') }} : {{ $address->postal_code }}</span></li>
                            <li class=" py-2"><span>{{ translate('Phone') }} : {{ $address->phone }}</span></li>
                        </ul>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @if (get_setting('classified_product'))
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Purchased Package') }}</h6>
            </div>
            <div class="card-body text-center">
                @php
                    $customer_package = \App\Models\CustomerPackage::find(Auth::user()->customer_package_id);
                @endphp
                @if($customer_package != null)
                    <img src="{{ uploaded_asset($customer_package->logo) }}" class="img-fluid mb-4 h-110px">
                    <p class="mb-1 text-muted">{{ translate('Product Upload') }}: {{ $customer_package->product_upload }} {{ translate('Times')}}</p>
                    <p class="text-muted mb-4">{{ translate('Product Upload Remaining') }}: {{ Auth::user()->remaining_uploads }} {{ translate('Times')}}</p>
                    <h5 class="fw-600 mb-3 text-primary">{{ translate('Current Package') }}: {{ $customer_package->getTranslation('name') }}</h5>
                @else
                    <h5 class="fw-600 mb-3 text-primary">{{translate('Package Not Found')}}</h5>
                @endif
                    <a href="{{ route('customer_packages_list_show') }}" class="btn btn-success d-inline-block">{{ translate('Upgrade Package') }}</a>
            </div>
        </div>
    </div>
    @endif
</div>




<section>
    <div class="container-fluid"style="padding-right: 0px; padding-left: 0px;">
        <div class="px-2 py-4 px-md-4 py-md-3 mobile-spaces">
            <div class="d-flex mb-3 align-items-baseline border-bottom justify-content-between">
                <h3 class="h5 fw-700 mb-0">
                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">
                        {{ translate('Watch') }}
                    </span>
                </h3>
            </div>
            
   
            
<div class="container-fliud" style="padding-right: 0px; padding-left: 0px;">
  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 g-4">
    @foreach(\App\Models\Video::all() as $video)
      <div class="shadows col d-flex " style="padding-right: 0px;padding-left: 5px;"> 
        <div class="card flex-fill" style="background-color: #f2f3f8;">
          <img style="max-height: 210px; min-height: 210px;" class="card-img-top" src="{{ uploaded_asset($video->banner) }}" data-src="{{ uploaded_asset($video->banner) }}" alt="Express Vpn" onerror="this.onerror=null;this.src='http://boomerdash.com/public/assets/img/placeholder.jpg';">
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
    
    
    
    
    <div><a  href="{{ route('videos') }}"  style="width: 100%;
    border: none;
    background: linear-gradient(90deg, rgba(125,37,140,1) 12%, rgba(38,99,242,1) 32%, rgba(54,115,255,1) 42%, rgba(250,237,46,1) 66%, rgba(245,153,41,1) 81%, rgba(217,36,37,1) 99%);
    lor: var(--primary);
    color: var(--white);
    padding: 2%;display: block;
    text-align: center;">View All</a></div>
</section>




<div class="modal fade" id="new-video-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header" style="
    background: transparent;
    border-color: transparent;
">
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





<section>
     <div class="d-flex mb-3 align-items-baseline border-bottom justify-content-between mt-4">
                <h3 class="h5 fw-700 mb-0">
                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">
                        {{ translate('Shop') }}
                    </span>
                </h3>
            </div>
 <div class="row gutters-5 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2 mt-4" >
                       
                            @foreach ($products as $key => $product)
                                <div class="col">
                                    @include('frontend.partials.product_box_1',['product' => $product])
                                </div>
                            @endforeach
                            
                       </div>     
                            
 <div><a  href="{{ route('search') }}"  style="width: 100%;
    border: none;
    background: linear-gradient(90deg, rgba(125,37,140,1) 12%, rgba(38,99,242,1) 32%, rgba(54,115,255,1) 42%, rgba(250,237,46,1) 66%, rgba(245,153,41,1) 81%, rgba(217,36,37,1) 99%);
    lor: var(--primary);
    color: var(--white);
    padding: 2%;display: block;
    text-align: center;">View All</a></div>
</section> 





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
    

     <script type="text/javascript">
            function addToCart(id){
            // if(checkAddToCartValidity()) {
                // $('#addToCart').modal();
                // $('.c-preloader').show();
                $.ajax({
                    type:"POST",
                    url: '{{ route('cart.addToCart') }}',
                    data: {
                    id:id,
                    quantity: 1,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(datas){
                        console.log(datas);
                    //    $('#addToCart-modal-body').html(null);
                    //    $('.c-preloader').hide();
                    //    $('#modal-size').removeClass('modal-lg');
                    //    $('#addToCart-modal-body').html(data.modal_view);
                       AIZ.extra.plusMinus();
                       AIZ.plugins.slickCarousel();
                       updateNavCart(datas.nav_cart_view,datas.cart_count);
                       $('#cart-summary').html(datas.cart_view);
                       AIZ.plugins.notify('success', "{{ translate('Product added to cart') }}");
                    }
                });
            // }
            // else{
            //     AIZ.plugins.notify('warning', "{{ translate('Please choose all the options') }}");
            // }
        }

        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>
    <script type="text/javascript">
        function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
        }

        function updateQuantity(key, element) {
            $.post('{{ route('cart.updateQuantity') }}', {
                _token: AIZ.data.csrf,
                id: key,
                quantity: element.value
            }, function(data) {
                updateNavCart(data.nav_cart_view, data.cart_count);
                $('#cart-summary').html(data.cart_view);
            });
        }

        function showCheckoutModal() {
            $('#login-modal').modal();
        }

        // Country Code
        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if (country.iso2 == 'bd') {
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)); @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if (selectedCountryData.iso2 == 'bd') {
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el) {
            if (isPhoneShown) {
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            } else {
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }
    </script>
@endsection

