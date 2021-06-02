<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="{{ $site_info->favicon }}">
	@if (isset($site_info->index_google))
		<meta name="robots" content="{{ $site_info->index_google == 1 ? 'index, follow' : 'noindex, nofollow' }}">
	@else
		<meta name="robots" content="noindex, nofollow">
	@endif
	{!! SEO::generate() !!}

	<meta property="og:url" content="{{ url('/') }}" />

	@yield('meta_tags')

	<meta http-equiv="content-language" content="vi" />
	<meta name="geo.region" content="VN" />
    <meta name="geo.placename" content="Đà Nẵng" />
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
 	<meta name="_token" content="{{csrf_token()}}" />
 	<link rel="canonical" href="{{ \Request::fullUrl() }}">
	<meta name="google-site-verification" content="5xFn_j2i9XDlTO7wOVnKI2qEhiWmIFFaWsB8_WtHql4" />
 	<!--link css-->
   
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/slick.min.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/slick-theme.min.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css//jquery.fancybox.min.css" />
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/jquery.mmenu.all.css"> 
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/style.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/custom.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/responsive.css">
    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/plugin/jquery.toast.min.css">

    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/jquery.min.js"></script>

 	@if (!empty($site_info->google_analytics))
 		{!! $site_info->google_analytics !!}
 	@endif

 	<script>
 		var base_url = "{{ __BASE_URL__ }}";
 		var base = "{{ url('/') }}";
 	</script>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-PDQ6S2C');</script>
	<!-- End Google Tag Manager -->
</head> 

	<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PDQ6S2C"
					  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
		<div class="loadingcover" style="display: none;">
		    <p class="csslder">
		        <span class="csswrap">
		            <span class="cssdot"></span>
		            <span class="cssdot"></span>
		            <span class="cssdot"></span>
		        </span>
		    </p>
		</div>

		@include('frontend.teamplate.header')
			<main>
				@yield('main')
				@include('frontend.teamplate.parts.showroom')
			</main>

		@include('frontend.teamplate.footer')

		<!--Link js-->
		<script type="text/javascript" src="{{ __BASE_URL__ }}/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{ __BASE_URL__ }}/js/slick.min.js"></script>
		<script type="text/javascript" src="{{ __BASE_URL__ }}/js/jquery.fancybox.min.js"></script>
		<script type="text/javascript" src="{{ __BASE_URL__ }}/js/jquery.mmenu.all.js"></script>
		<script type="text/javascript" src="{{ __BASE_URL__ }}/js/private.js"></script>
		<script type="text/javascript" src="{{ __BASE_URL__ }}/plugin/jquery.toast.min.js"></script>
		<script type="text/javascript" src="{{ __BASE_URL__ }}/plugin/lazysizes.min.js"></script>

		@yield('script')

		@if (!empty($site_info->script))
			{!! $site_info->script !!}
		@endif

		@if (Session::has('toastr'))
			<script>
				jQuery(document).ready(function($) {
					showToast('{{ Session::get('toastr') }}', 'Thông báo');
				});
			</script>
		@endif

		<script>
			jQuery(document).ready(function($) {
				$('body').on('keyup', '#query-search', function(event) {
					var query = $(this).val();
					if(query.length == 0){
						$('.list-search').hide().html('');
					}else{
						var btn = $('#icon-search');
						var classIconSearch = 'fa-spin fa fa-spinner';
						var classIcon = 'fa fa-search';
						$('#icon-search i').removeClass(classIcon).addClass(classIconSearch);
						$.get('{{ route('home.search') }}', { q: query } , function(data) {
							$('#icon-search i').removeClass(classIconSearch).addClass(classIcon);
							if(data.trim() != ''){
								$('.list-search').show().html(data)
							}
						});
					}
					
				});
			});
		</script>
	</body>
</html>