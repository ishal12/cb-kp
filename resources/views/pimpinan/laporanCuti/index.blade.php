@extends('adminlte::page')

@section('title', 'RIWAYAT - CUTI')

@section('content_header')
@stop

@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Laporan Cuti</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Kategori Cuti</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($laporan as $key => $value)
                        <tr>
                            <td> {{ $value->masters->kode }} </td>
                            <td> {{ $value->masters->pok_ang}} </td>
                            <td> {{ $value->masters->nama_ang }}</td>
                            <td> {{ number_format($value->iu_wajib) }} </td>
                            <td> {{ date('d F Y',strtotime($value->tgl_trsk)) }}</td>
                        </tr>
                        @endforeach --}}
                    </tbody>
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