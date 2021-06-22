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
                {{-- <a href="{{ route('companies.create') }}" class="btn bg-gradient-primary modal-show" title="Add New Companies" data-toggle="modal">
                  Add New Companies --}}
                </a>
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
                      @php $no = 1; @endphp
                      @foreach ($result as $key=>$item)
                          <tr>
                              <td>{{ $no++ }}</td>
                              <td>{!! $item->q !!}</td>
                              <td>{!! $item->a !!}</td>
                              <td>{!! $item->h !!}</td>
                          </tr>
                      @endforeach

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
        $('#data-daily').DataTable();
    });
</script>
@endpush
