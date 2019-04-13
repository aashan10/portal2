<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

<!-- Scripts -->

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
    
    <style>
        .dropdown-toggle::after {
            display: none;
        }
        @media only screen and (max-width : 767px){
            .votes{
                width : 80px !important;
                margin : 0;
                float:left;
            }
            .post-content {
                float: left;
                overflow: auto;
                max-width:calc(100% - 82px);
                padding-left: 10px !important;
            }
            .post-options-button{
                background-color: #fff !important;
            }
            .post-options{
                margin-left:-130px !important;
                margin-top:5px !important;
            }
            
        }
        img{
            max-width:100% !important;
        }
        .tox-statusbar{
                display : none !important;
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="{{ asset('images/logo-blue.png') }}" width="30" height="30" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

            <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 mb-3">
                    @stack('sidebar-left')
                </div>
                <div class="col-md-6">
                    @include('components.notifications')
                        {{-- @include('users.post') --}}
                    @yield('content')
                    
                </div>
                <div class="col-md-3">
                    @stack('sidebar-right')
                </div>
            </div>
        </div>
    </main>
</div>
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="col-md-12 mt-3">
                <h4 id="fileName"></h4>
            </div>
            <div class="container bg-secondary" style="position:relative; display:block; width : 100%;">
                <iframe src="" id="attachmentPreviewIframe" width="100%" height="100%" style="position : relative;top:0; left : 0; height : 500px;" frameborder="0"></iframe>
            </div>
            <div class="col-md-12 mb-3 mt-3">
                <a href="{{ route('file-download', ':hash') }}" id="attachmentDownloadButton" class="btn btn-outline-primary">
                    <i class="fa fa-download"></i> Download
                </a>

                <button class="btn float-right btn-outline-secondary" onClick="$('#previewModal').modal('hide');">
                    <i class="fa fa-close"></i> Close
                </button>
                <a class="btn btn-info text-white" id="downloadAsZip" href="{{ route('zip-download' , ':post_id') }}">
                    <i class="fa fa-file-archive-o"></i>  Download All Attachments
                </a>
            </div>
        </div>
    </div>
</div>
    

<script src="{{ asset('/js/app.js') }}"></script>
@stack('scripts')
<script>
        $('.attachmentPreview').click(function(event){
            event.preventDefault();
            $('#attachmentPreviewIframe').html('');
            $('#downloadAsZip').attr('href',$('#downloadAsZip').attr('href').replace(':post_id', $(this).data('attachment').post_id));
            $('#attachmentDownloadButton').attr('href', $('#attachmentDownloadButton').attr('href').replace(':hash', $(this).data('attachment').hash));
            $('#attachmentPreviewIframe').attr('src',$(this).data('attachment').url);
            $('#fileName').html($(this).data('attachment').original_name);
            $('#previewModal').modal();
        });
        $('.upvoteButton').click(function(){
            var id = $(this).parent().data('id');
            var downvotebutton = $(this).siblings('.downvoteButton');
            var url = '{{ route("post.upvote", ":id") }}';
            url = url.replace(":id", id);
            var self = this;
            $.ajax({
                url : url,
                method : 'POST',
                data : {
                    _token : '{{ csrf_token() }}',
                },
                beforeSend : function(){
                    $(self).addClass('disabled');
                    $(self).attr('disabled', true);
                },
                success : function(response){
                    $(self).addClass('btn-primary');
                    $(self).removeClass('btn-outline-primary');
                    $(self).removeClass('disabled');
                    $(self).attr('disabled',false);
                    downvotebutton.removeClass('btn-primary');
                    downvotebutton.addClass('btn-outline-primary');
                    $(self).siblings('.votesCount').html(response.data.votes_count+"<br/> Votes");
                },
                error : function(response){

                }
            });
        });

        $('.downvoteButton').click(function(){
            var id = $(this).parent().data('id');
            var upvoteButton = $(this).siblings('.upvoteButton');
            var url = '{{ route("post.downvote", ":id") }}';
            url = url.replace(":id", id);
            console.log(url);
            var self = this;
            $.ajax({
                url : url,
                method : 'POST',
                data : {
                    _token : '{{ csrf_token() }}',
                },
                beforeSend : function(){
                    $(self).addClass('disabled');
                    $(self).attr('disabled', true);
                },
                success : function(response){
                    $(self).addClass('btn-primary');
                    $(self).removeClass('btn-outline-primary');
                    $(self).removeClass('disabled');
                    $(self).attr('disabled',false);
                    upvoteButton.removeClass('btn-primary');
                    upvoteButton.addClass('btn-outline-primary');
                    $(self).siblings('.votesCount').html(response.data.votes_count+"<br/> Votes");
                },
                error : function(response){

                }
            });
        });
    </script>
</body>
</html>
