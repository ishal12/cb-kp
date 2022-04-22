@extends('adminlte::page')

@section('title', 'FILTER - RIWAYAT ABSENSI')

@section('content_header')
@stop

@section('content')

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            
            <div class="box-header with-border">
              <h3 class="box-title">Filter Riwayat Absensi</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('absnRiwayat.store') }}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="box-body">


                 <div class="form-group">
                  <label class="col-sm-2 control-label">Bulan</label>
                  <div class="col-sm-10">
                    <select class="form-control select2 select2-hidden-accessible" name="bulan" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      @for($i=1; $i<=12; $i++)
                      @if($i == date('n'))
                      <option selected="selected" value='{{date('n')}}'>{{date('F')}}</option>
                      @else
                      <option value='{{$i}}'>{{date('F', mktime(0, 0, 0, $i, 1))}}</option>
                      @endif
                      @endfor
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tahun</label>
                  <div class="col-sm-10">
                    <select class="form-control select2 select2-hidden-accessible" name="tahun" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      @foreach( $range = range(date('Y')-1, date('Y')+1); $years = array_combine($range, $range); $years as $year )
                      @if($year == date('Y'))
                      <option selected="selected" value='{{$year}}'>{{$year}}</option>
                      @else
                      <option value='{{$year}}'>{{$year}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
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
    $('.select2').select2()
  </script>
@stop