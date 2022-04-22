@extends('adminlte::page')

@section('title', 'INDEKS - DATA KARYAWAN')

@section('content_header')
@stop

@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Karyawan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($karyawans as $karyawan)
                      <tr>
                          <td> {{ $karyawan->id }} </td>
                          <td> {{ $karyawan->nama}} </td>
                          <td> {{ $karyawan->alamat }}</td>
                          <td> {{ $karyawan->kontak }}</td>
                          <td><a href="{{route('profilKaryawan.edit', $karyawan->id) }}" class="btn btn-primary">ubah</a></td>
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