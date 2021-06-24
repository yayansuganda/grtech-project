@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Companies</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Companies</a></li>
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
                <a href="{{ route('compani.create') }}" class="btn bg-gradient-primary modal-show" title="Add New Companies" data-toggle="modal">
                  Add New Companies
                </a>
              </div>

              <div class="card-body">
                <table id="data_table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Name Companies</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Website</th>
                        <th>Action</th>
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
        var oTable = $('#data_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('table.compani')}}",
            columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'logo_company', name: 'logo_company'},
                        {data: 'website_company', name: 'website_company'},
                        {data: 'action', name: 'action', orderable: false}
                    ]
        });
    });
</script>
@endpush
