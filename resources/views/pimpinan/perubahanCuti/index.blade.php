@extends('adminlte::page')

@section('title', 'LAPORAN - PERUBAHAN CUTI KARYAWAN')

@section('content_header')
@stop

@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Laporan Perubahan Cuti Karyawan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Perubahan</th>
                            <th>Kategori Cuti</th>
                            <th>Keterangan</th>
                    </thead>
                    {{-- <tbody>
                        @foreach ($laporan as $key => $value)
                        <tr>
                            <td> {{ $value->id }} </td>
                            <td> {{ $value->masters->kode }} </td>
                            <td> {{ $value->masters->nama_ang }}</td>
                            <td> {{ date('d F Y',strtotime($value->tgl_trsk)) }}</td>
                            <td><a class="btn btn-default" href="{{ URL::to('printStruk/' . $value->id . '/edit') }}"><i class="fa fa-print"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody> --}}
              </table>
            </div>
            <!-- /.box-body -->
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
      $('#example1').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
      })
    })
  </script>
@stop