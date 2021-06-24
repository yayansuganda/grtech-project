@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daily</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Daily</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                    <button type="submit" id="refresh" class="btn btn-outline-info ">Refresh Daily</button>
              </div>
              <div class="card-body">
                <table id="data-daily" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Q</th>
                        <th>A</th>
                        <th>H</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function(){
        var oTable = $('#data-daily').DataTable(
            {
            processing: true,
            serverSide: true,
            ajax: "{{ route('table.daily')}}",
            columns: [
                        {data: 'DT_RowIndex', name: 'q'},
                        {data: 'q', name: 'q'},
                        {data: 'a', name: 'a'},
                        {data: 'convert_h', name: 'convert_h'}
                    ]
        }
        );


        $("#refresh").click(function(){
            $('#data-daily').DataTable().draw(true);
        });
    });
</script>
@endpush
