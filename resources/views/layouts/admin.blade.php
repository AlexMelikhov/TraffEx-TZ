<!DOCTYPE html>
<html>
<head>
    <title>Тестовое задание (Админка)</title>


    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,600,300' rel='stylesheet' type='text/css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <style>

        .toppanel {
            background: #000;
        }

        .navbar-brand {
            padding: 5px 50px 0 50px;
        }

        #nav.navbar-nav > li > a {
            font-size: 16px;
            letter-spacing: 0;
            color: #fff;
            font-weight: bold;
        }
        #nav.navbar-nav > li.active > a {
            font-size: 16px;
            letter-spacing: 0;
            color: #000;
        }

        html, body {
            height: 100%;
            font-family: 'Titillium Web', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
        }

        .container {
            text-align: center;
            display: table-cell;
            padding-top: 100px;
        }

        .content {
            text-align: left;
            display: inline-block;
        }

        .title {
            font-size: 36px;
            text-align: center;
        }

        .content p{
            font-size: 15px;
        }
        .table {
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Static navbar -->
    @yield('nav')


    @yield('content')
</div>
</body>
</html>
