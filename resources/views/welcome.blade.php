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
                <li><a href="/sitepage1">Page1</a></li>
                <li><a href="/sitepage2">Page2</a></li>
                <li><a href="/sitepage3">Page3</a></li>
                <li><a href="/sitepage4">Page4</a></li>
                <li><a href="/sitepage5">Page5</a></li>
                <li><a href="/sitepage6">Page6</a></li>
                <li><a href="/sitepage7">Page7</a></li>
                <li><a href="/sitepage8">Page8</a></li>
                <li><a href="/sitepage9">Page9</a></li>
                <li><a href="/sitepage10">Page10</a></li>
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
        <div class="title">Тестовое задание</div>

        <p><br />
            Различные страницы сайта в верхнем меню (или url: /sitepage%pagenum% (1-10)) <br />

            Доступ к статистике: правый верхний угол меню (или <a href="/admin/">Админка</a>)
        </p>
    </div>
@stop