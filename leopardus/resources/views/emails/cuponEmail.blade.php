<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="col-xs-12">
            <img src="{{asset('assets/img/logo-light.png')}}" height="80" alt="">
        </div>
        <br>
        Your gift coupon is this: {{$cupon}}
        <br>
        It can be delivered to some user of your network.
        <br>
        Valid for one time only
    </body>
</html>