@extends('layouts.admin', [
  'page_header' => 'Yeni FAQ Ekle',
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
    <form class="col-md-8" action="{{ route('faq.store') }}" method="POST">
      {{ csrf_field() }}
      <label for="name">Sıkça Sorulan Soru Başlığı:</label>
      <input required type="text" name="title" class="form-control">
      <br>
      <label for="name">Sıkça Sorulan Soru Detayları:</label>
      <textarea name="details" class="form-control"></textarea>
      <br>
      <button type="submit" class="btn btn-primary btn-md">
        <i class="fa fa-plus"></i> FAQ Oluştur
      </button>
    </form>
    </div>
   


  </div>
@endsection

@section('scripts')
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=9z77wjhpwrx6pvh3r3oeiky25krlx0jzd8m69yte73hjrrgg"></script>
  <script>
  tinymce.init({
                selector: 'textarea',
                plugins: 'table,textcolor,image,lists,link,code,wordcount,advlist, autosave',
                theme: 'modern',
                menubar: 'none',
                height : '200',
                toolbar: 'restoredraft,bold italic underline | fontselect |  fontsizeselect | forecolor backcolor |alignleft aligncenter alignright alignjustify| bullist,numlist | link image'
  });</script>
  <script>
  @endsection
