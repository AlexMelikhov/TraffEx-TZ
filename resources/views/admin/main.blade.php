@extends('layouts.admin')

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
        <div class="title">Админка (статистика)</div>
        <div class="title">Страница: "{{$statOfPage}}"</div>

        <ul class="nav nav-pills">
            <?=$statNav?>
        </ul>


            <?=$content?>

    </div>
@stop