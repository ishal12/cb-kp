@extends('adminlte::page')

@section('title', 'BUAT - SURAT SURAT CUTI')

@section('content_header')
@stop

@section('content')

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            
            <div class="box-header with-border">
              <h3 class="box-title">Filter Laporan Cuti</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ URL::to('/riwayatCuti')}}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="box-body">


                 <div class="form-group">
                  <label class="col-sm-2 control-label">Tahun Pengajuan Cuti</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="tCuti" value="">
                    {{-- @foreach ($masters as $key => $value)
                    <option> {{ $value->kode }}.  {{ $value->nama_ang }} | Kelompok : {{ $value->pok_ang }}  </option>
                    @endforeach --}}
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Status Pengajuan Cuti</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="sCuti" value="">
                    {{-- @foreach ($masters as $key => $value)
                    <option> {{ $value->kode }}.  {{ $value->nama_ang }} | Kelompok : {{ $value->pok_ang }}  </option>
                    @endforeach --}}
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Kategori Pengajuan Cuti</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="kCuti" value="">
                    {{-- @foreach ($masters as $key => $value)
                    <option> {{ $value->kode }}.  {{ $value->nama_ang }} | Kelompok : {{ $value->pok_ang }}  </option>
                    @endforeach --}}
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