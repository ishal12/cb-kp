@extends('adminlte::page')

@section('title', 'RIWAYAT - CUTI KARYAWAN')

@section('content_header')
@stop

@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Riwayat Cuti Karyawan - {{ date('Y-M-d', strtotime($tgl)) }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Cuti</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cutiTanggals as $ct)
                        <tr>
                            <td> {{ $ct->cuti_karyawan_id }} </td>
                            <td> {{ $ct->cuti_karyawan->karyawan->nama }} </td>
                            <td> {{ $ct->cuti_jenis->jenis_cuti->nama }} </td>
                            @if($ct->status === '1')
                            <td> Diterima </td>
                            @elseif($ct->status === '0')
                            <td> Ditolak </td>
                            @endif
                            @if($ct->cuti->status === '1')
                            <td><a href="{{route('riwayatCuti.edit', $ct->id) }}" class="btn btn-primary">ubah</a></td>
                            @else
                            <td></td>
                            @endif
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