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
              <h3 class="box-title">Rekap Absensi - {{date('Y-F-d',strtotime($absensis[0]->absensi->tanggal))}}</h3> {{-- cari koding untuk ambil id tanggal absen rekap --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="POST" action="{{ route('absnKalender.update', $absensis[0]->absensi_id) }}">
                {{ method_field('PUT')}}
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Absen</th>
                            <th>Hadir</th>
                            <th>Sakit</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 0;
                      @endphp
                        @foreach($absensis as $a)
                        <tr>
                          <td> {{ $a->karyawan->nama }} </td>
                          <input type="hidden" name="nik[]" value="{{$a->karyawan->id}}">
                          @if($a->status == '0')
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="0" checked="">
                          </td>
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="1">
                          </td>
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="2">
                          </td>
                          @elseif($a->status == '1')
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="0">
                          </td>
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="1" checked="">
                          </td>
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="2">
                          </td>
                          @elseif($a->status == '2')
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="0">
                          </td>
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="1">
                          </td>
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="2" checked="">
                          </td>
                          @else
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="0">
                          </td>
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="1" checked="">
                          </td>
                          <td>
                            <input type="radio" name="status[{{$i}}]" id="optionsRadios1" value="2">
                          </td>
                          @endif
                        </tr>
                        @php
                          $i++;
                        @endphp
                        @endforeach
                    </tbody>
              </table>
              <button class="form-class btn btn-info pull-right" style="margin-top: 10px;">Submit</button>
              </form>
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