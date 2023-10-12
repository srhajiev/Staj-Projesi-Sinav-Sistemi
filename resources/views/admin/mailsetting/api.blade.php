@extends('layouts.admin', [
  'page_header' => 'Kontrol Paneli',
  'dash' => 'active',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
<h3>API Ayarları</h3>
<div class="dashboard-block col-md-8">
   
  <form action="{{ route('api.update') }}" method="POST">
    {{ csrf_field() }}
   
    <label for="STRIPE_KEY">STRIPE Anahtarı:</label>
    <input type="text" name="STRIPE_KEY" value="{{ $env_files['STRIPE_KEY'] }}"  class="form-control">
    <br>
    <label for="STRIPE_SECRET">STRIPE Gizli Anahtar:</label>
    <input type="text" name="STRIPE_SECRET" value="{{ $env_files['STRIPE_SECRET'] }}" class="form-control">
    <br>
 
    <label for="MAILCHIMP_APIKEY">MAILCHIMP API Anahtarı:</label>
    <input type="text" name="MAILCHIMP_APIKEY" value="{{ $env_files['MAILCHIMP_APIKEY'] }}" class="form-control">
    <br>
    <label for="MAILCHIMP_LIST_ID">MAILCHIMP Liste Kimliği:</label>
    <input type="text" name="MAILCHIMP_LIST_ID" value="{{ $env_files['MAILCHIMP_LIST_ID'] }}" class="form-control">
    <br>
    <label for="TMDB_API_KEY">TMDB API Anahtarı:</label>
    <input type="text" name="TMDB_API_KEY" value="{{ $env_files['TMDB_API_KEY'] }}" class="form-control">
    <br>
    <label for="PAYPAL_CLIENT_ID">PAYPAL Müşteri Kimliği:</label>
    <input type="text" name="PAYPAL_CLIENT_ID" value="{{ $env_files['PAYPAL_CLIENT_ID'] }}" class="form-control">
    <br>
    <label for="PAYPAL_SECRET_ID">PAYPAL Gizli Kimlik:</label>
    <input type="text" value="{{ $env_files['PAYPAL_SECRET_ID'] }}" name="PAYPAL_SECRET_ID" class="form-control">
    <br>
    <label for="PAYPAL_MODE">PAYPAL Modu:</label>
    <input type="text" value="{{ $env_files['PAYPAL_MODE'] }}" name="PAYPAL_MODE" class="form-control">
    <br>
    <label for="PAYU_METHOD">PAYU Metodu:</label>
    <input type="text" value="{{ $env_files['PAYU_METHOD'] }}" name="PAYU_METHOD" class="form-control">
    <br>
    <label for="PAYU_DEFAULT">PAYU Varsayılan:</label>
    <input type="text" value="{{ $env_files['PAYU_DEFAULT'] }}" name="PAYU_DEFAULT" class="form-control">
    <br>
    <label for="PAYU_MERCHANT_KEY">PAYU Satıcı Anahtarı:</label>
    <input type="text" value="{{ $env_files['PAYU_MERCHANT_KEY'] }}" name="PAYU_MERCHANT_KEY" class="form-control">
    <br>
    <label for="PAYU_MERCHANT_SALT">PAYU Satıcı Tuz:</label>
    <input type="text" value="{{ $env_files['PAYU_MERCHANT_SALT'] }}" name="PAYU_MERCHANT_SALT" class="form-control">
    <br>
    <input type="submit" class="btn btn-md btn-success">
    
  </form>

</div>
@endsection
