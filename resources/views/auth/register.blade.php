@extends('layouts.main')

@section('nav')
        <!-- Static navbar -->
<nav class="navbar navbar-default  navbar-fixed-top toppanel">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><img alt="Traffic Exchange" src="//www.traff-ex.com/images/logo.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav" id="nav">

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="/auth/register/">Register </a></li>
                <li class="active"><a href="/admin/">Admin Panel <span class="sr-only">(current)</span></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
@stop

@section('content')
    <div class="content">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="title">Регистрация</div>
        </div>

        <div class="col-lg-8 col-lg-offset-2">

            <form method="POST" action="/auth/register">
                {!! csrf_field() !!}

                <div class="form-group col-lg-6 col-lg-offset-3">
                    <label for="name">Name</label>

                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                </div>

                <div class="form-group col-lg-6 col-lg-offset-3">
                    <label for="email">Email</label>

                    <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                </div>

                <div class="form-group col-lg-6 col-lg-offset-3">
                    <label for="password">Password</label>

                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <div class="form-group col-lg-6 col-lg-offset-3">
                    <label for="password_confirmation">Confirm Password</label>

                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                </div>

                <div class="form-group col-lg-6 col-lg-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">Register</button>
                </div>

            </form>

        </div>


    </div>
@stop

