

  @include('Backend.include.header')
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  @include('Backend.include.navbar')
        <!-- Begin Page Content -->
        <div class="container-fluid">

           @yield('adminpagecontent') 

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     @include('Backend.include.footer')

</body>

</html>
