@extends('layouts.admin', [
  'page_header' => "Sorular / {$topic->title} ",
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'questions' => 'active',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
  <div class="margin-bottom">
    <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#createModal">Soru Ekle</button>
    <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#importQuestions">Soruları İçe Aktar</button>
  </div>
  <!-- Ekleme Modalı -->
  <div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Soru Ekle</h4>
        </div>
        {!! Form::open(['method' => 'POST', 'action' => 'QuestionsController@store', 'files' => true]) !!}
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                {!! Form::hidden('topic_id', $topic->id) !!}
                <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">                  
                  {!! Form::label('question', 'Soru') !!}
                  <span class="required">*</span>
                  {!! Form::textarea('question', null, ['class' => 'form-control', 'placeholder' => 'Lütfen soruyu girin', 'rows'=>'8', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('question') }}</small>
                </div>
                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                    {!! Form::label('answer', 'Doğru Cevap') !!}
                    <span class="required">*</span>
                    {!! Form::select('answer', array('A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D'),null, ['class' => 'form-control select2', 'required' => 'required', 'placeholder'=>'']) !!}
                    <small class="text-danger">{{ $errors->first('answer') }}</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group{{ $errors->has('a') ? ' has-error' : '' }}">
                  {!! Form::label('a', 'A - Seçenek') !!}
                  <span class="required">*</span>
                  {!! Form::text('a', null, ['class' => 'form-control', 'placeholder' => 'Lütfen A seçeneğini girin', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('a') }}</small>
                </div>
                <div class="form-group{{ $errors->has('b') ? ' has-error' : '' }}">
                  {!! Form::label('b', 'B - Seçenek') !!}
                  <span class="required">*</span>
                  {!! Form::text('b', null, ['class' => 'form-control', 'placeholder' => 'Lütfen B seçeneğini girin', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('b') }}</small>
                </div>
                <div class="form-group{{ $errors->has('c') ? ' has-error' : '' }}">
                  {!! Form::label('c', 'C - Seçenek') !!}
                  <span class="required">*</span>
                  {!! Form::text('c', null, ['class' => 'form-control', 'placeholder' => 'Lütfen C seçeneğini girin', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('c') }}</small>
                </div>
                <div class="form-group{{ $errors->has('d') ? ' has-error' : '' }}">
                  {!! Form::label('d', 'D - Seçenek') !!}
                  <span class="required">*</span>
                  {!! Form::text('d', null, ['class' => 'form-control', 'placeholder' => 'Lütfen D seçeneğini girin', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('d') }}</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group{{ $errors->has('code_snippet') ? ' has-error' : '' }}">
                    {!! Form::label('code_snippet', 'Kod Parçacıkları') !!}
                    {!! Form::textarea('code_snippet', null, ['class' => 'form-control', 'placeholder' => 'Lütfen kod parçacıklarını girin', 'rows' => '5']) !!}
                    <small class="text-danger">{{ $errors->first('code_snippet') }}</small>
                </div>
                <div class="form-group{{ $errors->has('answer_ex') ? ' has-error' : '' }}">
                    {!! Form::label('answer_exp', 'Cevap Açıklaması') !!}
                    {!! Form::textarea('answer_exp', null, ['class' => 'form-control', 'placeholder' => 'Lütfen cevap açıklamasını girin', 'rows' => '4']) !!}
                    <small class="text-danger">{{ $errors->first('answer_ex') }}</small>
                </div>
              </div>
              <div class="col-md-12">
                <div class="extras-block">
                  <h4 class="extras-heading">Soruya Video ve Resim Ekle</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">
                        {!! Form::label('question_video_link', 'Soruya Video Ekle') !!}
                        {!! Form::text('question_video_link', null, ['class' => 'form-control', 'placeholder'=>'https://myvideolink.com/embed/..']) !!}
                        <small class="text-danger">{{ $errors->first('question_video_link') }}</small>
                        <p class="help">YouTube ve Vimeo Video Desteği (Yalnızca Gömme Kodu Bağlantısı)</p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('question_img') ? ' has-error' : '' }}">
                        {!! Form::label('question_img', 'Soruya Resim Ekle') !!}
                        {!! Form::file('question_img') !!}
                        <small class="text-danger">{{ $errors->first('question_img') }}</small>
                         <p class="help">Lütfen yalnızca .JPG, .JPEG ve .PNG dosyalarını seçin</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="btn-group pull-right">
              {!! Form::reset("Sıfırla", ['class' => 'btn btn-default']) !!}
              {!! Form::submit("Ekle", ['class' => 'btn btn-wave']) !!}
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <!-- Soruları İçe Aktar Modalı -->
  <div id="importQuestions" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Soruları İçe Aktar (Veritabanı Alanının Tam Başlığı ile Excel Dosyası)</h4>
        </div>
        {!! Form::open(['method' => 'POST', 'action' => 'QuestionsController@importExcelToDB', 'files' => true]) !!}
          <div class="modal-body">
            {!! Form::hidden('topic_id', $topic->id) !!}
            <div class="form-group{{ $errors->has('question_file') ? ' has-error' : '' }}">
              {!! Form::label('question_file', 'Excel Dosyası ile Soru İçe Aktar', ['class' => 'col-sm-3 control-label']) !!}
              <span class="required">*</span>
              <div class="col-sm-9">
                {!! Form::file('question_file', ['required' => 'required']) !!}
                <p class="help-block">Sadece Excel Dosyası (.CSV ve .XLS)</p>
                <small class="text-danger">{{ $errors->first('question_file') }}</small>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="btn-group pull-right">
              {!! Form::reset("Sıfırla", ['class' => 'btn btn-default']) !!}
              {!! Form::submit("İçe Aktar", ['class' => 'btn btn-wave']) !!}
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <div class="box">
    <div class="box-body table-responsive">
      <table id="questions_table" class="table table-hover table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Sorular</th>
            <th>A - Seçenek</th>
            <th>B - Seçenek</th>
            <th>C - Seçenek</th>
            <th>D - Seçenek</th>
            <th>Doğru Cevap</th>
            <th>Kod Parçacığı</th>
            <th>Cevap Açıklaması</th>
            <th>Resim</th>
            <th>Video Bağlantısı</th>
            <th>İşlemler</th>
          </tr>
        </thead>
        <tbody>
          @if ($questions)
            @foreach ($questions as $key => $question)
              @php
                $answer = strtolower($question->answer);
              @endphp
              <tr>
                <td>
                  {{$key+1}}
                </td>
                <td>{{$question->question}}</td>
                <td>{{$question->a}}</td>
                <td>{{$question->b}}</td>
                <td>{{$question->c}}</td>
                <td>{{$question->d}}</td>
                <td>{{$question->$answer}}</td>
                <td>
                  <pre>
                    {{{$question->code_snippet}}}
                  </pre>
                </td>
                <td>
                  {{$question->answer_exp}}
                </td>
                <td>
                  <img src="{{asset('/images/questions/'.$question->question_img)}}" class="img-responsive" alt="resim">
                </td>
                <td>
                  {{$question->question_video_link}}
                </td>
                <td>
                  <!-- Düzenle Butonu -->
                  <a type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#{{$question->id}}EditModal"><i class="fa fa-edit"></i> Düzenle</a>
                  <!-- Silme Butonu -->
                  <a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#{{$question->id}}deleteModal"><i class="fa fa-close"></i> Sil</a>
                  <div id="{{$question->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                    <!-- Silme Modalı -->
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="delete-icon"></div>
                        </div>
                        <div class="modal-body text-center">
                          <h4 class="modal-heading">Emin misiniz?</h4>
                          <p>Bu kayıtları gerçekten silmek istiyor musunuz? Bu işlem geri alınamaz.</p>
                        </div>
                        <div class="modal-footer">
                          {!! Form::open(['method' => 'DELETE', 'action' => ['QuestionsController@destroy', $question->id]]) !!}
                            {!! Form::reset("Hayır", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                            {!! Form::submit("Evet", ['class' => 'btn btn-danger']) !!}
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <!-- Düzenleme modeli -->
              <div id="{{$question->id}}EditModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Soruyu Düzenle</h4>
                    </div>
                    {!! Form::model($question, ['method' => 'PATCH', 'action' => ['QuestionsController@update', $question->id], 'files' => true]) !!}
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-4">
                            {!! Form::hidden('topic_id', $topic->id) !!}
                            <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                              {!! Form::label('question', 'Soru') !!}
                              <span class="required">*</span>
                              {!! Form::textarea('question', null, ['class' => 'form-control', 'placeholder' => 'Lütfen Soruyu Girin', 'rows'=>'8', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('question') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                {!! Form::label('answer', 'Doğru Cevap') !!}
                                <span class="required">*</span>
                                {!! Form::select('answer', array('A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D'),null, ['class' => 'form-control select2', 'required' => 'required', 'placeholder'=>'']) !!}
                                <small class="text-danger">{{ $errors->first('answer') }}</small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group{{ $errors->has('a') ? ' has-error' : '' }}">
                              {!! Form::label('a', 'A - Seçenek') !!}
                              <span class="required">*</span>
                              {!! Form::text('a', null, ['class' => 'form-control', 'placeholder' => 'Lütfen A Seçeneğini Girin', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('a') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('b') ? ' has-error' : '' }}">
                              {!! Form::label('b', 'B - Seçenek') !!}
                              <span class="required">*</span>
                              {!! Form::text('b', null, ['class' => 'form-control', 'placeholder' => 'Lütfen B Seçeneğini Girin', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('b') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('c') ? ' has-error' : '' }}">
                              {!! Form::label('c', 'C - Seçenek') !!}
                              <span class="required">*</span>
                              {!! Form::text('c', null, ['class' => 'form-control', 'placeholder' => 'Lütfen C Seçeneğini Girin', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('c') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('d') ? ' has-error' : '' }}">
                              {!! Form::label('d', 'D - Seçenek') !!}
                              <span class="required">*</span>
                              {!! Form::text('d', null, ['class' => 'form-control', 'placeholder' => 'Lütfen D Seçeneğini Girin', 'required' => 'required']) !!}
                              <small class="text-danger">{{ $errors->first('d') }}</small>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group{{ $errors->has('code_snippet') ? ' has-error' : '' }}">
                                {!! Form::label('code_snippet', 'Kod Parçacığı') !!}
                                {!! Form::textarea('code_snippet', null, ['class' => 'form-control', 'placeholder' => 'Lütfen Kod Parçacığını Girin', 'rows' => '5']) !!}
                                <small class="text-danger">{{ $errors->first('code_snippet') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('answer_ex') ? ' has-error' : '' }}">
                                {!! Form::label('answer_exp', 'Cevap Açıklaması') !!}
                                {!! Form::textarea('answer_exp', null, ['class' => 'form-control',  'placeholder' => 'Lütfen Cevap Açıklamasını Girin',  'rows' => '4']) !!}
                                <small class="text-danger">{{ $errors->first('answer_ex') }}</small>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="extras-block">
                              <h4 class="extras-heading">Soruya Resim ve Video Ekle</h4>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">
                                    {!! Form::label('question_video_link', 'Soruya Video Ekle') !!}
                                    {!! Form::text('question_video_link', null, ['class' => 'form-control', 'placeholder'=>'https://myvideolink.com/embed/..']) !!}
                                    <small class="text-danger">{{ $errors->first('question_video_link') }}</small>
                                    <p class="help">YouTube ve Vimeo Video Desteği (Yalnızca Gömme Kodu Bağlantısı)</p>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group{{ $errors->has('question_img') ? ' has-error' : '' }}">
                                    {!! Form::label('question_img', 'Soruya Resim Ekle') !!}
                                    {!! Form::file('question_img') !!}
                                    <small class="text-danger">{{ $errors->first('question_img') }}</small>
                                     <p class="help">Lütfen yalnızca .JPG, .JPEG ve .PNG dosyalarını seçin</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <div class="btn-group pull-right">
                          {!! Form::submit("Güncelle", ['class' => 'btn btn-wave']) !!}
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
@endsection
