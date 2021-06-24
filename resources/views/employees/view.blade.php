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
                <div class="card-body">
                <div class="row">



                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">Date Range From To</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                </div>
                                {!! Form::text('date_range','', ['class' => 'form-control float-right', 'id'=>'date_range']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            {!! Form::text('first_name_search',null, ['class' => 'form-control', 'id'=>'first_name_search']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            {!! Form::text('last_name_search',null, ['class' => 'form-control', 'id'=>'last_name_search']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            {!! Form::text('email_search',null, ['class' => 'form-control', 'id'=>'email_search']) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Company</label>
                                {!! Form::select('company_id_search', $company_search, null, ['placeholder' => 'Pilih', 'class' => 'form-control', 'id' =>'company_id_search']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                              <button type="submit" id="search" class="btn btn-block btn-outline-info ">Search</button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                              <button type="submit" id="reset" name="reset" class="btn btn-block btn-outline-danger ">Reset</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
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
                <a href="{{ route('employe.create') }}" class="btn bg-gradient-primary modal-show" title="Add New Employees" data-toggle="modal">
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
            ajax : {
                      url : "{{ route('table.employe')}}",
                      data : function(d){
                        d.first_name = $("#first_name_search").val();
                        d.last_name = $("#last_name_search").val();
                        d.email = $("#email_search").val();
                        d.date_range = $("#date_range").val();
                        d.company = $( "select#company_id_search option:checked" ).val();
                      }
                    },
            columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'full_name', name: 'full_name'},
                        {data: 'company_detail', name: 'company_detail'},
                        {data: 'email', name: 'email'},
                        {data: 'phone', name: 'phone'},
                        {data: 'action', name: 'action', orderable: false}
                    ]
        });


         $("#search").click(function(){
            $('#data_table').DataTable().draw(true);
        });

        $("#reset").click(function(){
          $("#first_name_search").val('');
          $("#last_name_search").val('');
          $("#email_search").val('');
          $( "select#company_id_search option:checked" ).val('');
          $('#data_table').DataTable().draw(true);
        });


    });
</script>
@endpush
