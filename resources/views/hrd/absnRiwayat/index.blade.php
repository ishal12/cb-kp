@extends('adminlte::page')

@section('title', 'LAPORAN - ABSENSI')

@section('content_header')
@stop

@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabel Rekap Absensi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Presensi</th>
                            <th>Alpha</th>
                            <th>Sakit</th>
                            <th>Cuti</th>
                            <th>Ijin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i<count($ar); $i++)
                        <tr>
                            <td> {{ $ar[$i]['nik'] }} </td>
                            <td> {{ $ar[$i]['nama'] }} </td>
                            <td> {{ $ar[$i]['masuk'] }} </td>
                            <td> {{ $ar[$i]['alfa'] }} </td>
                            <td> {{ $ar[$i]['sakit'] }} </td>
                            <td> {{ $ar[$i]['cuti'] }} </td>
                            <td> {{ $ar[$i]['izin'] }} </td>
                        </tr>
                        @endfor
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