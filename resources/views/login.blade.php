<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{asset('/js/app.js')}}"></script>
        
    </head>
    <body>
        <div style="background-color: #EEE; height: 200px">
            <div style="float: right"><a href="{{url()->current()}}">Sign in </a>||<a href=""> Sign up</a></div>
        </div>
        <div style="width: 20%; min-height: 500px; background-color: bisque;float: left"></div>

        <div style="float: left;align-items: center; width: 60%;background-color: #f5f5f5; min-height: 500px">
            <h1 style="text-align: center">Login</h1>
            <form method="post" action='login'>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div style="text-align: left; margin-left: 400px">
                    <div style="">User name</div>
                    <div style="display: inline;text-align: center"><input type="text" name="userName" id="userName"/></div>
                    <div style="">Password</div>
                    <div><input type="password" name="password" id="password"/></div>
                    <input style="align-content: center;" type="submit" value="Login"/>
                </div>
                <!--<input style="margin-left: 50px;" type="submit" value="login" onclick="login(document.getElementById('userName').value, document.getElementById('password').value)" />-->
            </form>
        </div>
        
        <div style="width: 20%; min-height: 500px; background-color: bisque; float: right"></div>
    </body>

    <script>
        function login(userName, password)
        {
            var url = '{{url()->current()}}';
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '{{url()->current()}}', // This is the url we gave in the route
                data: {'userName': userName,
                    'password': password}, // a JSON object to send back
                success: function (response) { // What to do if we succeed
                    console.log(response + "successful");

                    alert("successfuls" + url);
                },
                error: function (jqXHR, textStatus, errorThrown) { // What to do if we fail
                    alert(url);
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }
        
    </script>
</html>
