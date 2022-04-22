@extends('adminlte::page')

@section('title', 'UBAH - PROFIL')

@section('content_header')
@stop

@section('content')

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            
            <div class="box-header with-border">
              <h3 class="box-title">Form Ubah Profil Karyawan</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('profilKaryawan.update', $karyawan->id) }}">
            {{ method_field('PUT')}}
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">No. Karyawan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik" value="{{$karyawan->id}}" readonly="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" value="{{$karyawan->nama}}">
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" value="{{$karyawan->alamat}}">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nomor Telepon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tlp" value="{{$karyawan->kontak}}">
                  </div>
                </div>


              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script>
	  $(function () {
	    $('#example1').DataTable()
	    $('#example2').DataTable({
	      'paging'      : true,
	      'lengthChange': false,
	      'searching'   : false,
	      'ordering'    : true,
	      'info'        : true,
	      'autoWidth'   : false
	    })
	  })
	</script>
@stop