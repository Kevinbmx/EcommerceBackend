
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <!-- <form role="search" class="navbar-form-custom" method="post" action="/">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search" />
                </div>
            </form> -->
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
            @guest
                            {{-- <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> --}}
                        @else
                            <li class="nav-item dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </button>

                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> --}}
                                </div>
                            </li>
                        @endguest
                    <!-- <a href="{{url('login')}}">
                        <i class="fa fa-sign-out"></i> Cerrar Sesion
                    </a> -->
            </li>
        </ul>
    </nav>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
            <h2>Inicio</h2>
                    <!-- <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">
                            <strong>Layouts</strong>
                        </li>
                    </ol> -->
    </div>
    <div class="col-lg-2">
    </div>
</div>