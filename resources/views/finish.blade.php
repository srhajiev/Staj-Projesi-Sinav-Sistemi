@extends('layouts.app')

@section('head')
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
              <!-- Branding Image -->
              @if($setting)
                <a   class="tt" href="{{ url('/') }}"><h4 class="heading">{{$setting->welcome_txt}}</h4></a>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">             
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                  <li><a href="{{ route('login') }}" title="Login">Giriş</a></li>
                  <li><a href="{{ route('register') }}" title="Register">Kayıt</a></li>
                @else
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      @if ($auth->role == 'A')
                        <li><a href="{{url('/admin')}}" title="Dashboard">Panel</a></li>
                      @elseif ($auth->role == 'S')
                        <li><a href="{{url('/admin/my_reports')}}" title="Dashboard">Panel</a></li>
                      @endif
                      <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                      </li>
                    </ul>
                 </li>
                @endguest
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
  @if ($auth)
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="home-main-block">

               

        @if($topic->show_ans==1)
        
         <div class="question-block">
            <h2 class="text-center main-block-heading">{{$topic->title}} CEVABI RAPOR ET</h2>
            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>Soru</th>                  
                  <th style="color: green;">Doğru cevap</th>
                  <th style="color: red;">Cevabın</th>
                  <th>Cevap Açıklaması</th>
                </tr>
              </thead>
              <tbody>
                @php
                 $answers = App\Answer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->get();
                @endphp             
               
                @php
                $x = $count_questions;               
                $y = 1;
                @endphp
                @foreach($answers as $key=> $a)
                
                  @if($a->user_answer != "0" && $topic->id == $a->topic_id)
                    <tr>
                      <td>{{ $a->question->question }}</td>
                      <td>{{ $a->answer }}</td>
                      <td>{{ $a->user_answer }}</td>
                      <td>{{ $a->question->answer_exp }}</td>
                    </tr>
                    @php                
                      $y++;
                      if($y > $x){                 
                        break;
                      }
                    @endphp
                  @endif
                @endforeach              
               
              </tbody>
            </table>
            
          </div>

          @endif



          <div class="question-block">
            <h2 class="text-center main-block-heading">{{$topic->title}} Result</h2>
            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>Toplam Sorular</th>
                  <th>Benim Seçimlerim</th>
                  <th>Soru İşareti Başına</th>
                  <th>Toplam puan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$count_questions}}</td>
                  <td>
                    @php
                      $mark = 0;
                      $correct = collect();
                    @endphp
                    @foreach ($answers as $answer)
                      @if ($answer->answer == $answer->user_answer)
                        @php
                        $mark++;
                        @endphp
                      @endif
                    @endforeach
                    @php
                      $correct = $mark*$topic->per_q_mark;
                    @endphp
                    {{$correct}}
                  </td>
                  <td>{{$topic->per_q_mark}}</td>
                  <td>{{$topic->per_q_mark*$count_questions}}</td>
                </tr>
              </tbody>
            </table>
            <h2 class="text-center">Teşekkürler!</h2>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function(){
      history.pushState(null, null, document.URL);
      window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
      });
    });
  </script>
@endsection
