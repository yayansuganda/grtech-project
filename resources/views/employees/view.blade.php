@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employees</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Employees</a></li>
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
                <a href="{{ route('employees.create') }}" class="btn bg-gradient-primary modal-show" title="Add New Employees" data-toggle="modal">
                  Add New Employees
                </a>
              </div>

              <div class="card-body">
                <table id="data_table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Full Name</th>
                        <th>Companies</th>
                        <th>Email</th>
                        <th>Phone</th>
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
            ajax: "{{ route('table.employees')}}",
            columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'full_name', name: 'full_name'},
                        {data: 'company_detail', name: 'company_detail'},
                        {data: 'email', name: 'email'},
                        {data: 'phone', name: 'phone'},
                        {data: 'action', name: 'action', orderable: false}
                    ]
        });
    });
</script>
@endpush
