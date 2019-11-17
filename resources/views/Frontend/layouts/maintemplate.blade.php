<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Header Codes -->

   @include('Frontend.includes.header')

</head>
<body>
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="{{ asset('image/loader.gif')}}"  alt="#"/></div>
       <!-- Navbar Codes -->
       @include('Frontend.includes.navbar')
       @include('Frontend.allinfo.message')

       <!-- All Page Body Conrent -->
       @yield('bodycontent')
       @yield('scripts')

       <!-- Footer Codes --->
       @include('Frontend.includes.footer')

