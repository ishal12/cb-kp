@extends('adminlte::page')

@section('title', 'INDEKS - HARI LIBUR')

@section('content_header')
@stop

@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Hari Libur</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" >
                  <div class="input-group-btn">
                    <a href="{{route('hariLibur.create')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Jenis Libur</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liburs as $l)
                        <tr>
                            <td> {{ $l->nama }} </td>
                            <td> {{ $l->tgl_awal }} </td>
                            <td> {{ $l->tgl_akhir }} </td>
                            @if($l->jenis == 'ln')
                            <td> Libur Nasional </td>
                            @elseif($l->jenis == 'lm')
                            <td> Libur Lainnya </td>
                            @endif
                            <td><a href="{{route('hariLibur.edit', $l->id) }}" class="btn btn-primary">ubah</a></td>
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