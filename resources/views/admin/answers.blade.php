{{-- @extends('layouts.admin', [
  'page_header' => "Tüm Öğrenci Cevapları",
  'dash' => '',
  'users' => '',
  'questions' => '',
  'answers' => 'aktif',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
  <div class="content-block box">
    <div class="box-body table-responsive">
      <table id="example1" class="table table-striped table-bordered">
        <thead class="info">
          <tr>
            <th>#</th>
            <th>Öğrenci Adı</th>
            <th>Soru</th>
            <th>Öğrenci Cevabı</th>
            <th>Doğru Cevap</th>
            <th>Sil</th>
          </tr>
        </thead>
        <tbody>
          @if ($answers)
            @php($n = 1)
            @foreach ($answers as $key => $answer)
              <tr>
                <td>
                  {{$n}}
                  @php($n++)
                </td>
                <td>{{$answer->user->name}}</td>
                <td>{{$answer->question->question}}</td>
                <td>{{$answer->user_answer}}</td>
                <td>{{$answer->answer}}</td>
                <td>
                  <!-- Silme Butonu -->
                  <a type="button" class="btn btn-info btn-xs btn-danger" data-toggle="modal" data-target="#{{$answer->id}}deleteModal"><i class="fa fa-close"></i> Sil</a>
                  <div id="{{$answer->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                    <!-- Silme Modalı -->
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="delete-icon"></div>
                        </div>
                        <div class="modal-body text-center">
                          <h4 class="modal-heading">Emin misiniz ?</h4>
                          <p>Bu kayıtları gerçekten silmek istiyor musunuz? Bu işlem geri alınamaz.</p>
                        </div>
                        <div class="modal-footer">
                          {!! Form::open(['method' => 'DELETE', 'action' => ['AnswersController@destroy', $answer->id]]) !!}
                                {!! Form::reset("Hayır", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                {!! Form::submit("Evet", ['class' => 'btn btn-danger']) !!}
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection --}}
