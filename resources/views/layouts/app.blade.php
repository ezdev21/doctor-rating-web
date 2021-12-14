<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TiruHakim</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="shortcut icon" type="image/x-icon" href="/storage/icons/tiruHakimLogo_title.png">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
        <div>
          <navigation-component @auth user-id="{{Auth::user()->id}}" @endauth />
        </div>
        <main class="container">
            @yield('content')
        </main>
    </div>
  <footer class="p-5" style="background-color: #f0f0f0">
    <div class="md:flex lg:flex xl:flex 2xl:flex justify-between border-b-2 border-tiruhakim ">
      <div class="mx-auto mb-3 w-1/2">
        <img src="/storage/icons/tiruHakimLogo_longform_en.png" class="w-1/2 my-2">
        <p class="text-base w-2/3 my-3">Tiru Hakim is the first rating system for Doctors and Hospitals developed by Estena Foundation</p>
        <div class="flex mt-2">
          <a target="_blank" href="https://www.facebook.com/Tiruhakim-100167249059605">
            <img src="/storage/icons/facebook.png" class="w-6 rounded-lg">
          </a>
          <a target="_blank" href="http://linkedin.com">
            <img src="/storage/icons/linkedin.png" class="w-6 mx-3 rounded-lg">
          </a>
        </div>
      </div>
      <div class="w-1/2 text-tiruhakim flex flex-wrap w-full md:w-3/4 lg:w-2/3 xl:w-2/3 2xl:w-2/3 mx-auto justify-around mb-5">
        <div class="">
          <h2 class="font-bold text-xl mb-3">For Patients</h2>
         <p><a href="/finddoctors" class="text-md lg:text-lg xl:text-lg 2xl:text-xl hover:no-underline">Find a Doctor</a></p>
         <p><a href="/findhospitals" class="text-md lg:text-lg xl:text-lg 2xl:text-xl hover:no-underline">Find a Hospital</a></p>  
        </div>
        <div class="">
           <h2 class="font-bold text-xl mb-3">For MDs</h2>
          <p><a href="/doctor/register" class="text-md lg:text-lg xl:text-lg 2xl:text-xl hover:no-underline">Claim a Profile(doctor)</a></p>
          <p><a href="/hospital/register" class="text-md lg:text-lg xl:text-lg 2xl:text-xl hover:no-underline">Claim a Profile(hospital)</a></p>
          <p><a href="/helpcenter" class="text-md lg:text-lg xl:text-lg 2xl:text-xl hover:no-underline">Help Center</a></p>  
         </div>
         <div class="">
           <h2 class="font-bold text-xl mb-3">Tiru Hakim</h2> 
          <p><a href="/aboutus" class="text-md lg:text-lg xl:text-lg 2xl:text-xl hover:no-underline">About Us</a></p>
          <p><a href="/contactus" class="text-md lg:text-lg xl:text-lg 2xl:text-xl hover:no-underline">Contact Us</a></p>  
         </div>
      </div>
    </div>
      <div>
        <p class="text-base mt-3">
          {{now()->year}}. Tiru Hakim By <a target="_blank" href="http://estenafoundation.org" class="text-tiruhakim">Estena Foundation</a>
        </p>  
      </div>
    </footer>
</body>
</html>