@extends('adminlte::page')

@section('title', 'UBAH - RIWAYAT CUTI')

@section('content_header')
@stop

@section('content')

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            
            <div class="box-header with-border">
              <h3 class="box-title">Form Ubah Riwayat Cuti</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('riwayatCuti.update', $cutiTanggal->id) }}">
            {{ method_field('PUT')}}
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">NIK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik" value="{{ $cutiTanggal->cuti_karyawan_id }}" readonly="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" value="{{ $cutiTanggal->cuti_karyawan->karyawan->nama }}" readonly="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Pengajuan</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tPengajuan" value="{{ $cutiTanggal->cuti->tgl_pengajuan }}" readonly="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Pengajuan</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tCuti" value="{{ $cutiTanggal->tanggal }}" readonly="">
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-2 control-label">Kategori Cuti</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="tampilan" value="" readonly="">
                    @foreach ($jenisCutis as $jenisCuti)
                    @if($jenisCuti->id == $cutiTanggal->cuti_jenis_cuti_id)
                    <option value="{{$jenisCuti->id}}" selected="">{{$jenisCuti->nama}}</option>
                    @else
                    <option value="{{$jenisCuti->id}}" >{{$jenisCuti->nama}}</option>
                    @endif
                    @endforeach
                  </select>
                  </div>
                </div>

                <input type="text" name="kategori" value="{{ $cutiTanggal->cuti_jenis_cuti_id }}" hidden="">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="status" value="">
                      @if($cutiTanggal->status === '1')
                      <option value="{{ $cutiTanggal->status }}" selected="">Diterima</option>
                      <option value="0">Ditolak</option>
                      @else
                      <option value="1">Diterima</option>
                      <option value="{{ $cutiTanggal->status }}" selected="">Ditolak</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="ket" required="">
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