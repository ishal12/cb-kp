@extends('adminlte::page')

@section('title', 'PEMBERITAHUAN - PENGAJUAN CUTI')

@section('content_header')
@stop

@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Pemberitahuan Pengajuan Cuti</h3>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cutis as $cuti)
                        <tr>
                            <td> {{ $cuti->karyawan_id }} </td>
                            <td> {{ $cuti->karyawan->nama }} </td>
                            <td> {{ $cuti->tgl_pengajuan }} </td>
                            <td> {{ $cuti->tgl_awal }} </td>
                            <td> {{ $cuti->tgl_akhir }} </td>
                            <td> {{ $cuti->jenis_cuti->nama }} </td> 
                            <td><a href="{{route('pemberitahuanCuti.edit', $cuti->id) }}" class="btn btn-primary">Lihat</a></td>
                        </tr>
                        @endforeach 
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