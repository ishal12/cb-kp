@extends('adminlte::page')

@section('title', 'UBAH - HARI LIBUR')

@section('content_header')
@stop

@section('content')

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            
            <div class="box-header with-border">
              <h3 class="box-title">Masukkan Hari Libur Kalender</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('hariLibur.update', $libur->id) }}">
              {{ method_field('PUT')}}
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Hari Libur</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" value="{{ $libur->nama }}">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Awal</label>
                  <div class="col-sm-10">
                    @if($libur->tgl_awal <= date('Y-m-d'))
                    <input type="date" class="form-control" name="tAwal" min='{{date('Y-m-d')}}' value="{{ $libur->tgl_awal }}" required="" readonly="">
                    @else
                    <input type="date" class="form-control" name="tAwal" min='{{date('Y-m-d')}}' value="{{ $libur->tgl_awal }}" required="">
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Akhir</label>
                  <div class="col-sm-10">
                    @if($libur->tgl_awal <= date('Y-m-d'))
                    <input type="date" class="form-control" name="tAkhir" min='{{date('Y-m-d')}}' value="{{ $libur->tgl_akhir }}" required="" readonly="">
                    @else
                    <input type="date" class="form-control" name="tAkhir" min='{{date('Y-m-d')}}' value="{{ $libur->tgl_akhir }}" required="">
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Libur</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="jLibur">
                      @if($libur->jenis == 'ln')
                      <option value="ln" selected="">Libur Nasional</option>
                      <option value="lm">Libur Lainnya</option>
                      @elseif($libur->jenis == 'lm')
                      <option value="ln">Libur Nasional</option>
                      <option value="lm" selected="">Libur Lainnya</option>
                      @endif
                    </select>
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