<style type="text/css">

.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top: 50px;
  margin: otomatik;
}

</style>
@extends('layouts.admin', [
  'page_header' => 'E-posta Ayarları',
  'dash' => 'active',
  'quiz' => '',
  'users' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')

<div class="box">
  <div class="box-body">
    <div class="row">
  
  <form action="{{ route('mail.update') }}" method="POST">
    {{ csrf_field() }}
    <div class="col-md-6">
      <label for="MAIL_FROM_NAME">Gönderen Adı: <small>(ör. John)</small></label>
    <input type="text" name="MAIL_FROM_NAME" value="{{ $env_files['MAIL_FROM_NAME'] }}"  class="form-control">
    <br>
    <label for="MAIL_FROM_ADDRESS">Adres: <small>(info@test.com)</small></label>
    <input type="text" name="MAIL_FROM_ADDRESS" value="{{ $env_files['MAIL_FROM_ADDRESS'] }}" class="form-control">
    <br>
    <label for="MAIL_DRIVER">E-posta Sürücüsü: <small>(ör. sendmail, smtp, mail)</small></label>
    <input type="text" name="MAIL_DRIVER" value="{{ $env_files['MAIL_DRIVER'] }}" class="form-control">
    <br>
    <label for="MAIL_HOST">E-posta Sunucusu: <small>(ör. smtp.gmail.com)</small></label>
    <input type="text" name="MAIL_HOST" value="{{ $env_files['MAIL_HOST'] }}" class="form-control">
    </div>
  

    <div class="col-md-6">
    <label for="MAIL_PORT">E-posta Portu: <small>(567, 487)</small></label>
    <input type="text" name="MAIL_PORT" value="{{ $env_files['MAIL_PORT'] }}" class="form-control">
    <br>
    <label for="MAIL_USERNAME">Kullanıcı Adı: <small>(ör. username@gmail.com)</small></label>
    <input type="text" name="MAIL_USERNAME" value="{{ $env_files['MAIL_USERNAME'] }}" class="form-control">
    <br>

    <label for="MAIL_PASSWORD">Şifre:</label>
    <input type="password" value="{{ $env_files['MAIL_PASSWORD'] }}" name="MAIL_PASSWORD" class="form-control" id="password-field">
     <div class="col-md-12">
     <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
    </div>


    <br>
    <label for="MAIL_ENCRYPTION">E-posta Şifreleme: <small>(TLS, SSL)</small></label>
    <input type="text" value="{{ $env_files['MAIL_ENCRYPTION'] }}" name="MAIL_ENCRYPTION" class="form-control">
    <br>
  
</div>
    <div class="col-md-12">
    <button type="submit" class="btn btn-md btn-success"><i class="fa fa-save"></i> Ayarları Kaydet</button>
      
    </div>

</form>
</div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  
  $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

</script>

@endsection
