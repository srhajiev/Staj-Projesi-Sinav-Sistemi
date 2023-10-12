@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
@endsection

@section('top_bar')
  <nav class="navbar navbar-default navbar-static-top">
    <div class="logo-main-block">
      <div class="container">
        @if ($setting)
          <a href="{{ url('/') }}" title="{{$setting->welcome_txt}}">
            <img src="{{asset('/images/logo/'. $setting->logo)}}" class="img-responsive" alt="{{$setting->welcome_txt}}">
          </a>
        @endif
      </div>
    </div>
    <div class="nav-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="navbar-header">
              <!-- Marka Görseli -->
              @if($setting)
                <a class="tt" title="Quick Quiz Anasayfa" href="{{url('/')}}"><h4 class="heading">{{$setting->welcome_txt}}</h4></a>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Sağdaki Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Kimlik Doğrulama Bağlantıları -->
                @guest
                  <li><a href="{{ route('login') }}" title="Giriş Yap">Giriş Yap</a></li>
                  <li><a href="{{ route('register') }}" title="Kayıt Ol">Kayıt Ol</a></li>
                @else
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      @if ($auth->role == 'A')
                        <li><a href="{{url('/admin')}}" title="Yönetim Paneli">Yönetim Paneli</a></li>
                      @elseif ($auth->role == 'S')
                        <li><a href="{{url('/admin/my_reports')}}" title="Yönetim Paneli">Yönetim Paneli</a></li>
                      @endif
                      <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Çıkış
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                      </li>
                    </ul>
                  </li>
                 
                  <li><a href="{{ route('faq.get') }}">SSS</a></li>
                @endguest
                  <li><a href="{{url('pages/nasil-calisir')}}">Nasıl ÇaLışır</a></li>
                  <li><a href="{{url('pages/hakkimizda')}}">Hakkımızda</a></li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('content')
  <div class="container">
    @foreach(App\FAQ::all() as $key=> $f)
      <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $f->id }}" aria-expanded="true" aria-controls="collapseOne">
          <i class="fa fa-question-circle"></i> {{ $f->title }}
        </a>
      </h4>
    </div>
    <div id="collapse{{ $f->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        {!! $f->details !!}
      </div>
    </div>
  </div>
    @endforeach
  </div>
@endsection
