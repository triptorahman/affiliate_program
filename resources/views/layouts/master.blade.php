<!doctype html>
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    
     @include('layouts.top') {{-- css --}}
     
  

</head>
<body>


        <!-- Left Panel -->

    @include('layouts.navigation')

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
@include('layouts.header')
        <!-- Header-->

@yield('content') 

@yield('script') 

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

@include('layouts.bottom')
</body>
</html>
