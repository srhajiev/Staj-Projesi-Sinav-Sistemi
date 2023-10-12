@extends('layouts.admin', [
  'page_header' => 'Öğrenciler',
  'dash' => '',
  'quiz' => '',
  'users' => 'active',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
@include('message')
  @if ($auth->role == 'A')
    <div class="margin-bottom">
      <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#createModal">Öğrenci Ekle</button>
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#AllDeleteModal">Tüm Öğrencileri Sil</button>
    </div>
    <!-- Tümünü Silme Butonu -->
    <div id="AllDeleteModal" class="delete-modal modal fade" role="dialog">
      <!-- Tüm Silme Modal -->
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="delete-icon"></div>
          </div>
          <div class="modal-body text-center">
            <h4 class="modal-heading">Emin misiniz?</h4>
            <p>"Tüm bu kayıtları" silmek istiyor musunuz? Bu işlem geri alınamaz.</p>
          </div>
          <div class="modal-footer">
            {!! Form::open(['method' => 'POST', 'action' => 'DestroyAllController@AllUsersDestroy']) !!}
                {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <!-- Create Modal -->
    <div id="createModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Öğrenci Ekle</h4>
          </div>
          {!! Form::open(['method' => 'POST', 'action' => 'UsersController@store']) !!}
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                   <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', 'Öğrenci Adı') !!}
                    <span class="required">*</span>
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Adınızı Girin']) !!}
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'E-posta Adresi') !!}
                    <span class="required">*</span>
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'örn: bilgi@ornek.com', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', 'Şifre') !!}
                    <span class="required">*</span>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder'=>'Şifrenizi Girin', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                      {!! Form::label('role', 'Kullanıcı Rolü') !!}
                      <span class="required">*</span>
                      {!! Form::select('role', ['S' => 'Öğrenci', 'A'=>'Yönetici'], null, ['class' => 'form-control select2', 'required' => 'required']) !!}
                      <small class="text-danger">{{ $errors->first('role') }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    {!! Form::label('mobile', 'Mobil No.') !!}
                    {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'örn: 0123456789']) !!}
                    <small class="text-danger">{{ $errors->first('mobile') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                    {!! Form::label('city', 'Şehir Girin') !!}
                    {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'örn: Ankara']) !!}
                    <small class="text-danger">{{ $errors->first('city') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    {!! Form::label('address', 'Adres') !!}
                    {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'örn: Merkez Mah. Örnek Sk. No:5/1']) !!}
                    <small class="text-danger">{{ $errors->first('address') }}</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="btn-group pull-right">
                {!! Form::reset("Reset", ['class' => 'btn btn-default']) !!}
                {!! Form::submit("Add", ['class' => 'btn btn-wave']) !!}
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <div class="content-block box">
      <div class="box-body table-responsive">
        <table id="example1" class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
             <th>Öğrenci Adı</th>
          <th>E-posta</th>
          <th>Mobil No.</th>
          <th>Şehir</th>
          <th>Adres</th>
          <th>Kullanıcı Rolü</th>
          <th>İşlemler</th>
            </tr>
          </thead>
          <tbody>
            @if ($users)
              @php($n = 1)
              @foreach ($users as $key => $user)
                <tr>
                  <td>
                    {{$n}}
                    @php($n++)
                  </td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->mobile}}</td>
                  <td>{{$user->city}}</td>
                  <td>{{$user->address}}</td>
                  <td>{{$user->role == 'S' ? 'Student' : '-'}}</td>
                  <td>
                    <!-- Edit Button -->
                    <a type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#{{$user->id}}EditModal"><i class="fa fa-edit"></i> Düzenle</a>
                    <!-- Delete Button -->
                    <a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#{{$user->id}}deleteModal"><i class="fa fa-close"></i> Sil</a>
                    <div id="{{$user->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                      <!-- Delete Modal -->
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading">Eminmisn ?</h4>
                                      <p>Gerçekten bu kayıtları silmek istiyor musunuz? Bu işlem geri alınamaz.</p>

                          </div>
                          <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['UsersController@destroy', $user->id]]) !!}
                                {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <!-- edit model -->
                <div id="{{$user->id}}EditModal" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                               <h4 class="modal-title">Öğrenciyi Düzenle</h4>

                      </div>
                      {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user->id]]) !!}
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Adı') !!}
    <span class="required">*</span>
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Adınızı girin']) !!}
    <small class="text-danger">{{ $errors->first('name') }}</small>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'E-posta Adresi') !!}
    <span class="required">*</span>
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'örn: bilgi@ornek.com', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('email') }}</small>
</div>

{{-- <label for="">Parolayı Değiştir: </label>
<input type="checkbox" name="changepass"> --}}
{{-- <input type="radio" value="1" name="changepass" id="ch1">&nbsp;Evet
<input type="radio" value="0" name="changepass" checked id="ch2">&nbsp;Hayır --}}
<br>

<div id="pass" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!! Form::label('password', 'Parola') !!}
    <span class="required">*</span>
    <input class="form-control" type="password" value="" placeholder="Yeni parola girin" name="password">
    <small class="text-danger">{{ $errors->first('password') }}</small>
</div>

<div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
    {!! Form::label('role', 'Kullanıcı Rolü') !!}
    {!! Form::select('role', ['S' => 'Öğrenci', 'A' => 'Yönetici'], null, ['class' => 'form-control select2', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('role') }}</small>
</div>

<div class="col-md-6">
    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
        {!! Form::label('mobile', 'Mobil No.') !!}
        {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'örn: +91-123-456-7890']) !!}
        <small class="text-danger">{{ $errors->first('mobile') }}</small>
    </div>
    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
        {!! Form::label('city', 'Şehir Girin') !!}
        {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Şehrinizi girin']) !!}
        <small class="text-danger">{{ $errors->first('city') }}</small>
    </div>
    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        {!! Form::label('address', 'Adres') !!}
        {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Adresinizi girin']) !!}
        <small class="text-danger">{{ $errors->first('address') }}</small>
    </div>
</div>

                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <div class="btn-group pull-right">
                            {!! Form::submit("Update", ['class' => 'btn btn-wave']) !!}
                          </div>
                        </div>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  @endif
@endsection
@section('scripts')


<script>
  $('#ch1').click(function(){
    $('#pass').show();
  });

  $('#ch2').click(function(){
    $('#pass').hide();
  });
</script>

@endsection
