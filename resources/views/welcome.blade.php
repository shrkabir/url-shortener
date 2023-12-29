<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Url Shortener</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('frontend/assets/favicon.ico')}}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-light bg-light static-top">
        <div class="container">
            <a class="navbar-brand" href="#!">Url Shortener</a>
            @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                <div class="row">
                <h4>For click count and history go to Dashboard</h4>
                </div>
                <div class="row">
                    <div class="col-8">
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    </div>

                    <!-- Topbar Navbar -->
                    <div class="col-4">
                        <span class="badge badge-success text-dark">{{Auth::user()->name}}</span>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                @else
                <a class="btn btn-primary" href="{{ route('login') }}">Sign In</a>
                @if (Route::has('register'))
                <a class="btn btn-primary" href="{{ route('register') }}">Sign Up</a>
                @endif
                @endauth
            </div>
            @endif
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="text-center text-white">
                        <!-- Page heading-->
                        <h1 class="mb-5">Generate short url for your convenience!</h1>
                        @if(Session::has('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                        </div>
                        @endif
                        @if(Session::has('warning'))
                        <div class="alert alert-danger">
                            {{Session::get('warning')}}
                        </div>
                        @endif
                        <form action="{{route('url-short')}}" method="POSt">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="full_link" class="form-control" value="{{old('full_link')}}" placeholder="Enter your url here" />
                                    @if($errors->has('full_link'))
                                    <div>
                                        <span class="alert alert-danger">{{ $errors->first('full_link') }}</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-auto"><input type="submit" value="Short Url" class="btn btn-primary"></div>
                            </div>
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    <p>To activate this form, sign up at</p>
                                    <a class="text-white" href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <div class="d-none" id="submitErrorMessage">
                                <div class="text-center text-danger mb-3">Error sending message!</div>
                            </div>
                        </form>
                    </div>
                    @if(Session::has('url'))
                    <div class="bg-light mt-4 long-url-div">
                        <span>Full Url:</span>
                        <span class="m-4"><a href="{{Session::get('url')->full_link}}" target="_blank">{{Session::get('url')->full_link}}</a></span>
                    </div>
                    <div class="bg-light mt-4 short-url-div">
                        <span>Shorten Url:</span>
                        <span class="m-4"><a href="{{url(Session::get('url')->hash)}}" target="_blank">{{url(Session::get('url')->hash)}}</a></span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{asset('frontend/js/scripts.js')}}"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>