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
              <h3 class="box-title">Daftar Riwayat Cuti</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Jenis Cuti</th>
                            <th>Status</th>
                            <th>Cuti Terpakai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cutis as $cuti)
                        <tr>
                            <td> {{ $cuti->tgl_pengajuan }} </td>
                            <td> {{ $cuti->tgl_awal }} </td>
                            <td> {{ $cuti->tgl_akhir }}</td>
                            <td> {{ $cuti->jenis_cuti->nama }}</td>
                            @if($cuti->status == '0')
                            <td> Ditolak </td>
                            @elseif($cuti->status == '1')
                            <td> Diterima </td>
                            @elseif($cuti->status == '2')
                            <td> Diproses </td>
                            @endif
                            @php
                              $i = 0;
                            @endphp
                            @foreach($cutiTanggals as $ct)
                              @if($cuti->id == $ct->cuti_id)
                              @php
                                $i++
                              @endphp
                              @endif
                            @endforeach
                            <td>{{$i}}</td>
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