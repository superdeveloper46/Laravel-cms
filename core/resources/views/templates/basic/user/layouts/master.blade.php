
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->sitename($page_title ?? '') }}</title>
    <!-- site favicon -->
    <link rel="shortcut icon" type="image/png" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/grid.min.css') }}">
    <!-- bootstrap toggle css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/bootstrap-toggle.min.css')}}">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{asset('assets/global/css/all.min.css')}}">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}">

    @stack('style-lib')

    <link rel="stylesheet" href="{{asset('assets/global/css/select2.min.css')}}">

    @stack('style-lib')

    <link rel="stylesheet" href="{{asset('assets/admin/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/survey.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/user_custom.css')}}">

    @stack('style')

    @stack('css')
</head>
<body>


@yield('content')


<!-- jQuery library -->
<script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset('assets/admin/js/vendor/bootstrap.bundle.min.js')}}"></script>
<!-- bootstrap-toggle js -->
<script src="{{asset('assets/admin/js/vendor/bootstrap-toggle.min.js')}}"></script>
<!-- slimscroll js for custom scrollbar -->
<script src="{{asset('assets/admin/js/vendor/jquery.slimscroll.min.js')}}"></script>

<script src="{{ asset('assets/admin/js/nicEdit.js') }}"></script>
<!-- seldct 2 js -->
<script src="{{asset('assets/global/js/select2.min.js')}}"></script>
@stack('script-lib')
<script src="{{asset('assets/admin/js/app.js')}}"></script>

@include('partials.notify')

{{-- LOAD NIC EDIT --}}
<script>
    "use strict";
    (function($){
        bkLib.onDomLoaded(function() {
            $( ".nicEdit" ).each(function( index ) {
                $(this).attr("id","nicEditor"+index);
                new nicEditor({fullPanel : false}).panelInstance('nicEditor'+index,{hasPanel : true});
            });
        });

        $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain',function(){
            $('.nicEdit-main').focus();
        });
    })(jQuery);
</script>

@stack('script')

@include('partials.plugins')

</body>
</html>


