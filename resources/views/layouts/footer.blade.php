@php
    $catFooter = isset($catHeader) ? $catHeader : App\Models\Category::all();

    $categories = [
        [
            'title' => '',
            'items' => $catFooter->take(12),
        ],
        [
            'title' => '',
            'items' => $catFooter->skip(12)->take(12),
        ],
    ];

    $links = [
        ['url' => '/', 'text' => 'Inicio'],
        ['url' => url('registrar-comercio'), 'text' => 'Registra Tu Negocio'],
        ['url' => url('empleos'), 'text' => 'Empleos'],
        ['url' => url('planes'), 'text' => 'Planes'],
        ['url' => url('faq'), 'text' => 'FAQ'],
        ['url' => url('nosotros'), 'text' => 'Nosotros'],
        ['url' => url('blog'), 'text' => 'Blog'],
        ['url' => url('privacidad'), 'text' => 'privacidad'],
    ];
@endphp
<!-- START FOOTER -->
<footer class="footer_dark">
    <div class="footer_top">
        <div class="container">
            <div class="row">
            	<div class="col-12">
                	<div class="pb-4 mb-4 mb-md-5 border_bottom_tran">
        				<div class="row align-items-center justify-content-between">	
                            <div class="col-lg-8 col-md-8">
                                <div class="heading_s1">
                                    <h3 style="text-transform: none;">Forma parte de CiudadGPS</h3>
                                </div>
                                <p>Registra tu negocio en CiudadGPS y se parte de la comunidad de comercios más grande de América Latina: <strong>Crece, conéctate y destaca con CiudadGPS</strong></p>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <a href="{{ url('registrar-comercio') }}" class="btn btn-fill-out btn-block">                                    
                                    <i class="linearicons-rocket" style="font-size: 25px;"></i> Afíliate ya!
                                </a>
                            </div>
                        </div>
            		</div>
            	</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="footer_logo">
                            <a href="/"><img src="{{asset('assets/logo_gps_blanco.png')}}" width="150px" alt="CiudadGPS logotipo light"/></a>
                        </div>
                        <p>Somos la App que te conecta! <br> Descubre locales comerciales en todo el país<br>Tu Comunidad de Comercios en línea.</p>
                    </div>
                    <div class="widget">
                        <ul class="social_icons social_white">
                            <li><a href="https://www.instagram.com/ciudadgps" target="blank"><i class="ion-social-instagram-outline" style="font-size:30px;"></i></a></li>
                            <li><a href="https://www.tiktok.com/@ciudadgps" target="blank"><i class="fab fa-tiktok" style="font-size:25px;"></i></a></li>
                            <li><a href="https://api.whatsapp.com/send?phone=584129749348" target="blank"><i class="ion-social-whatsapp-outline" style="font-size:30px;"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/ciudadgps" target="blank"><i class="fab fa-linkedin-in" style="font-size:30px;"></i></a></li>
                        </ul>
                    </div>
                </div>
                @foreach($categories as $category)
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div class="widget">
                            @if(strlen($category['title']) > 0)<h6 class="widget_title">{{ $category['title'] }}</h6>@endif
                            <ul class="widget_links">
                                @foreach($category['items'] as $ca)
                                    <li><a href="{{ url('comercios/slug-categorias/' . $ca->slug) }}" class="category-link">{{$ca->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">Enlaces:</h6>
                        <ul class="widget_links">
                            @foreach($links as $link)
                                <li><a href="{{ $link['url'] }}">{{ $link['text'] }}</a></li>
                            @endforeach
                            @guest
                                <li><a href="{{route('login')}}">Inicia Sesión</a></li>
                                <li><a href="{{route('register')}}">Regístrate</a></li>
                            @else
                                <li><a href="{{url('mi-cuenta')}}">Mi Cuenta</a></li>
                                <li><a href="{{url('favoritos')}}">Favoritos</a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">Contacto</h6>
                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:ventas@ciudadgps.com">ventas@ciudadgps.com</a>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:info@ciudadgps.com">info@ciudadgps.com</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <a href="tel:584129749348">+58 (412)974-9348</a>
                            </li>
                            <li>
                                <i class="ion-social-whatsapp-outline" style="margin-top: -2px;"></i>
                                <a href="https://api.whatsapp.com/send?phone=584129749348">+58 (412)974-9348</a>
                            </li>
                        </ul>
                    </div>
                    <div class="widget">
                        <div class="row mt-4">
                            <div class="col-6 pr-1">
                                <a 
                                    href="https://play.google.com/store/apps/details?id=com.ciudadgps.app" 
                                    target="blank">
                                    <img 
                                        src="{{ asset('appButtons/play_store.png') }}" 
                                        alt="Botón de descarga de Google Play Store" 
                                    />
                                </a>
                            </div>
                            <div class="pl-1 col-6">
                                <a 
                                    href="https://apps.apple.com/us/app/ciudadgps/id1643027976"
                                    target="blank">
                                    <img 
                                        src="{{ asset('appButtons/app_store.png') }}" 
                                        alt="Botón de descarga de App Store" 
                                    />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-md-0 text-center">Producciones Plus {{date('Y')}} © Todos los Derechos Reservados</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

@if(!request()->is('/'))
    <script src="{{ asset('assetsPublic/js/jquery-3.6.0.min.js') }}"></script> 
    <script src="{{ asset('assetsPublic/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.form.js')}}"></script>
    <script src="{{ asset('assetsPublic/js/popper.min.js') }}"></script>
    <script src="{{ asset('assetsPublic/bootstrap/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('assetsPublic/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assetsPublic/js/magnific-popup.min.js') }}"></script> 
    <script src="{{ asset('assetsPublic/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assetsPublic/js/parallax.js') }}"></script> 
    <script src="{{ asset('assetsPublic/js/jquery.countdown.min.js') }}"></script> 
    <script src="{{ asset('assetsPublic/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assetsPublic/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assetsPublic/js/jquery.dd.min.js') }}"></script>
    <script src="{{ asset('assetsPublic/js/slick.min.js') }}"></script>
    <script src="{{ asset('assetsPublic/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('assetsPublic/js/select2.min.js') }}"></script>
    <script src="{{ asset('assetsPublic/js/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="{{ asset('assetsPublic/js/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.js') }}"></script>
    <script src="{{ asset('assetsPublic/js/scripts.js?v=1') }}"></script>
    <script src="{{ asset('assets/js/script.js?v=4') }}"></script>
@else
    <script src="{{asset('assetsPublic/js/script.min.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>    
@endif

@if(session()->has('error'))
<script>
	var colorError = '#dc3545';
    Swal.fire({icon:'error', title:'Ha ocurrido un error!', text: "{{session('error')}}", confirmButtonText: "OK", confirmButtonColor: colorError})
</script>
@endif

@if(session()->has('message'))
<script>
    var colorSuccess = '#28a745';
    Swal.fire({icon:'success', title:'', text: "{{session('message')}}", confirmButtonText: 'OK', confirmButtonColor: colorSuccess})
</script>
@endif

<script>
    $('#order').on('input', function(){
        $('#formOrder').submit();
    })

    $('#avatar').on('input', function(){
        var filename = $('#avatar').val().replace(/C:\\fakepath\\/i, '')
        $('#avatarCaption').html(filename);
    })
</script>

@yield('stripe')
@yield('map')

<script>
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      console.log("Geolocation is not supported by this browser.");
    }

    function showPosition(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;

      $.ajax({
        url: '/save-location',
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        data: {latitude, longitude},
        success: function(response) {
            $('.category-link').each(function () {
                var href = $(this).attr('href');
                if (href.includes('?order=id')) {
                    href = href.replace('?order=id', '?order=distance');
                    $(this).attr('href', href);
                }
            });  

            $('.link_all').each(function () {
                var href = $(this).attr('href');
                if (href.includes('?order=id')) {
                    href = href.replace('?order=id', '?order=distance');
                    $(this).attr('href', href);
                }
            });
            
            $('#search-form input[name="order"]').val('distance');    
        },
        error: function(xhr, status, error) {
          console.log("Error sending geolocation to backend: " + error);
        }
      });
    }
</script>


