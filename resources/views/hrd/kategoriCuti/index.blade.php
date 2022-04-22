@extends('adminlte::page')

@section('title', 'INDEKS - KATEGORI CUTI')

@section('content_header')
@stop

@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Kategori Cuti</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" >
                  <div class="input-group-btn">
                    <a href="{{route('kategoriCuti.create')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Maks Hari Libur</th>
                            <th>Potong Cuti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenisCutis as $jenisCuti)
                      <tr>
                          <td> {{ $jenisCuti->created_at }} </td>
                          <td> {{ $jenisCuti->nama }} </td>
                          <td> {{ $jenisCuti->limit }}</td>
                          @if($jenisCuti->kategori == 0)
                          <td> Tidak </td>
                          @else
                          <td> Ya </td>
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