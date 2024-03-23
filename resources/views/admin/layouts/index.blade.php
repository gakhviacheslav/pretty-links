<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          rel="stylesheet">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <title>Dashboard</title>
</head>
<body>

<div class="container">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-12 col-lg-2">
            @include('admin.includes.menu')
        </div>
        <div class="col-12 col-lg-10">
            @yield('breadcrumb')

            <div class="content-wrapper mt-6">
                @yield('content')
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script crossorigin="anonymous" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script crossorigin="anonymous" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $(".list-group-item a").each(function () {
            var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
            var link = this.href;
            if (link == location2) {
                $(this).addClass('text-white');
                $(this).parent().addClass('active');
            }
        });
    });
</script>
@yield('scripts')
</body>
</html>
