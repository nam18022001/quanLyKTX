@extends('page.view.sinhvien.layout.master')
@section('title')
    Gửi phản ánh
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
    <style>
      ul{
        list-style-type: none ;
      }
      .submit{
        cursor: deffault;
        pointer-events: none;
      }
    </style>
@endsection
@section('content')
<form action="{{url('thong-bao/gui')}}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  
  <div class="col-md-12">
    @if (count($errors) > 0)
        @foreach ($errors->all() as $err)
          <div class="alert alert-danger">
            {{ $err}}
          </div>
        @endforeach
    @endif
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Phản ánh</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <input class="form-control" value="Gửi tới: QuanLyKTX@greendormitory.com" disabled>
          </div>
          <div class="form-group">
            <input class="form-control" type="text" required name="tieude" placeholder="Tiêu đề:">
          </div>
          <div class="form-group">
              <textarea id="compose-textarea" id="summernote" class="form-control" name="noidung" style="height: 300px"></textarea>
              <input type="text" name="tomtat" style="display:none" id="tomtat" value="">
          </div>
          <div class="form-group">
            <div class="btn btn-default btn-file">
              <i class="fas fa-paperclip"></i> Tệp đính kèm
            <input type="file" id="file" name="files[]" multiple onchange="javascript:updateList()">

            </div>

            <p class="help-block" id="list"></p>
            <p class="help-block">Tối đa. 39MB</p>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="float-right">
            <button type="submit" class="btn btn-default" name="discard" onclick="myFunction();" id="mybutton"><i class="fas fa-pencil-alt"></i> Bản nháp</button>
            <button type="submit" id="aaaaa" name="send" class="btn btn-default" onclick="myFunction();"><i class="far fa-paper-plane"></i> Gửi</button>
          </div>
          <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Hủy bỏ</button>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
</form>
@endsection

@section('script')
<script>
  updateList = function() {
    var input = document.getElementById('file');
    var output = document.getElementById('list');
    var hihi = document.getElementById('aaaaa');
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
      var file = input.files[i];
      if (file.size/1024/1024 < 39 ) {
          children += '<li class="col-4 alert alert-success"><i class="fas fa-file-alt bg-warning"></i>&nbsp;' + input.files.item(i).name + '</li>';
          hihi.classList.remove('submit');
        }else if(file.size/1024/1024 > 39){
          children = '<li class="col-4 alert alert-warning">Tổng dung lượng tối đa dưới 39 MB</li>';
          hihi.classList.add('submit');
    }
  }
    output.innerHTML = '<ul>'+children+'</ul>';
    $(document).on("keypress", "input", function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        e.preventDefault();
        return false;
    }
});
}
</script>
<script>
  
     function myFunction() {
      var range = $('#compose-textarea').summernote('code').replace(/<\/?[^>]+(>|$)/g, "");
      $('#tomtat').val(range);

     };
</script>
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(function () {
      //Add text editor
      $('#compose-textarea').summernote();
    })
  </script>
  <!-- Code injected by live-server -->
  <script type="text/javascript">
      // <![CDATA[  <-- For SVG support
      if ('WebSocket' in window) {
          (function () {
              function refreshCSS() {
                  var sheets = [].slice.call(document.getElementsByTagName("link"));
                  var head = document.getElementsByTagName("head")[0];
                  for (var i = 0; i < sheets.length; ++i) {
                      var elem = sheets[i];
                      var parent = elem.parentElement || head;
                      parent.removeChild(elem);
                      var rel = elem.rel;
                      if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                          var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                          elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                      }
                      parent.appendChild(elem);
                  }
              }
              var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
              var address = protocol + window.location.host + window.location.pathname + '/ws';
              var socket = new WebSocket(address);
              socket.onmessage = function (msg) {
                  if (msg.data == 'reload') window.location.reload();
                  else if (msg.data == 'refreshcss') refreshCSS();
              };
              if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                  console.log('Live reload enabled.');
                  sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
              }
          })();
      }
      else {
          console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
      }
      // ]]>
  </script>
@endsection