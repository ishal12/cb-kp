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
            <form class="form-horizontal" method="POST" action="{{ route('pemberitahuanCuti.update', $cuti->id) }}">
            {{ method_field('PUT')}}
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Pegawai</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" value="{{ $cuti->karyawan->nama }}" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Awal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tAwal" value="{{ $cuti->tgl_awal }}" readonly>
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Akhir</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tAkhir" value="{{ $cuti->tgl_akhir }}" readonly>
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-2 control-label">Kategori Cuti</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="tampilan" value="" disabled=>
                    @foreach ($jenisCutis as $jenisCuti)
                    @if($jenisCuti->id == $cuti->jenis_cuti_id)
                    <option value="{{ $jenisCuti->id }}" selected="" >{{ $jenisCuti->nama }}</option>
                    @else
                    <option value="{{ $jenisCuti->id }}" >{{ $jenisCuti->nama }}</option>
                    @endif
                    @endforeach
                  </select>
                  </div>
                </div>

                <input type="text" name="kategori" value="{{ $cuti->jenis_cuti_id }}" hidden="">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="ket" value="{{ $cuti->keterangan }}" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Sisa Cuti</label>
                  <div class="col-sm-10">
                    <label class="control-label">{{ $sisa }}</label>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="status" class="btn btn-info pull-right" value="1">Terima</button>
                <button type="submit" name="status" class="btn btn-danger pull-right" value="0" style="margin-right: 10px;">Tolak</button>
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