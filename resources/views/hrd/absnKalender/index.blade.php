@extends('adminlte::page')

@section('title', 'REKAP - ABSENSI')

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
                            <th>Tanggal</th>
                            <th>Action
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kalenders as $k)
                        @php
                          $count = 0;
                        @endphp
                        @foreach ($k->absensi_has_karyawan as $a)
                        @if ($a->status == null)
                          @php
                            $count++;
                          @endphp
                        @endif
                        @endforeach
                        @if ($count != 0)
                          <tr>
                            <td align="center"> {{ date('Y F d', strtotime($k->tanggal)) }} </td>
                            <td align="center"> 
                              <a href="{{ route('absnKalender.edit', $k->id) }}" class="btn btn-info"> Custom </a>
                              <form method="POST" action="{{ route('absnKalender.semua', $k->id) }}">
                                {{ method_field('PUT')}}
                                <button class="btn btn-success">Semua</button>
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                              </form>
                            </td>
                          </tr>
                        @endif
                        
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