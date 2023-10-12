@extends('layouts.admin', [
  'page_header' => 'Telif Hakkı Metni',
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
		@foreach($ct as $c)
		<form action="{{ route('copyright.update',$c->id) }}" method="POST" class="col-md-6">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="form-group {{$errors->has('copyright') ? 'has error' : '' }}">
				
			
			<label for="copy">Telif Hakkı:</label>
			<input type="text" value="{{ $c ->name}}" name="name" class="form-control" placeholder="Telif Hakkı Metnini Girin">
			</div>
			<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Ayarı Kaydet</button>

		</form>
		@endforeach
	</div>
</div>
@endsection
