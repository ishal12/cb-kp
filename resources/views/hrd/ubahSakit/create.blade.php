@extends('adminlte::page')

@section('title', 'UBAH - ABSEN SAKIT')

@section('content_header')
@stop

@section('content')

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            
            <div class="box-header with-border">
              <h3 class="box-title">Masukkan Tanggal Absensi yang Akan Diubah</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('ubahSakit.store') }}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="box-body">


                 <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgl" min="{{date("Y-m-d", strtotime('-7 day'))}}" value="{{date("Y-m-d")}}">
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
    $('.select2').select2()
	</script>
@stop