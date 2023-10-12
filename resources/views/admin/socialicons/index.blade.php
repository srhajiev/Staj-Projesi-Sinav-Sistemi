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
  <div class="dashboard-block">
    <!-- Modal tetikleyici düğme -->
    <div class="margin-bottom">
      <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">
        + Sosyal İkon Ekle
      </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Kapat"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">+ Sosyal İkon Ekle</h4>
          </div>
          <div class="modal-body">
            <form action="{{ route('social.store') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <label for="title">Başlık:</label>
              <input type="text" name="title" value="" placeholder="Başlık Girin" class="form-control"/>
              <br>
              <label for="url">URL:</label>
              <input type="text" name="url" value="" placeholder="örn. http://facebook.com" class="form-control"/>
              <br>
              <label for="url">İkon Seçin:</label>
              <input type="file" name="icon" value="" class="form-control"/>
              <br>
              <label for="status">Durum:</label>
              <input type="checkbox" class="toggle-input" name="status" id="toggle">
              <label for="toggle"></label>
              <br>
              <input type="submit" class="btn btn-md btn-danger" value="+ Ekle">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="box">
      <div class="box-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>SN</th>
              <th>İkon</th>
              <th>Başlık</th>
              <th>URL</th>
              <th><i class="fa fa-trash" aria-hidden="true"></i></th>
              <th>Aktif/Pasif</th>
            </tr>
          </thead>

          <tbody>
            <?php $i=0;?>
            @foreach ($social as $si)
              <?php $i++;?>
              <tr>
                <td><?php echo $i;?> </td>
                <td><img width="32px;" src="{{asset('/images/socialicons/'. $si->icon)}}" alt=""></td>
                <td>{{ $si->title }}</td>
                <td><a title="URL'ye Git" target="_blank" href="{{ $si->url }}">{{ $si->url }}</a></td>
                <td>
                  <form action="{{ route('social.delete', $si->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <button onclick="return confirm('Bu veriyi silmek istediğinizden emin misiniz?')" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i>
                    </button>
                  </form>
                </td>
                <td>
                  @if($si->status=="1")
                    <form action="{{ route('social.deactive',$si->id) }}" method="POST">
                      {{ csrf_field() }}
                      {{method_field('put')}}
                      <input type="submit" class="btn btn-sm btn-success" value="Aktif">
                    </form>
                  @else
                    <form action="{{ route('social.active',$si->id) }}" method="POST">
                      {{ csrf_field() }}
                      {{method_field('put')}}
                      <input type="submit" class="btn btn-sm btn-danger" value="Pasif">
                    </form>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  $(function() {
    $('#toggle-event').change(function() {
      $('#status').val(+ $(this).prop('checked'))
    })
  })
</script>
@endsection
