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
              <h3 class="box-title">Form Surat Cuti</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{route('cuti.store')}}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="box-body">

                <input name="nik" type="text" value="{{auth()->user()->karyawan_id}}" hidden="">
                <input name="jab" type="text" value="{{auth()->user()->karyawan_jabatan_id}}" hidden="">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Pengajuan</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tPengajuan" value="{{date("Y-m-d")}}">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Awal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tAwal" min="{{date("Y-m-d")}}" value="">
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Akhir</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tAkhir" min="{{date("Y-m-d")}}" value="">
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-2 control-label">Kategori Cuti</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="kategori" value="">
                    @foreach ($jenisCutis as $jenisCuti)
                    <option value="{{$jenisCuti->id}}">{{$jenisCuti->nama}}</option>
                    @endforeach
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="ket" value="">
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