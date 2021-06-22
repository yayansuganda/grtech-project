<table class="table">
    <tr>
        <td>Name Company</td>
        <td>:</td>
        <td>{{ $model->name }}</td>
    </tr>

    <tr>
        <td>Email</td>
        <td>:</td>
        <td>{{ $model->email }}</td>
    </tr>

    <tr>
        <td>Website</td>
        <td>:</td>
        <td><a href="{{ $model->website }}" target="_blank">{{ $model->website  }}</a></td>
    </tr>

    <tr>
        <td>Logo</td>
        <td>:</td>
        <td><img src="{{  url('/').Storage::url('public/'. $model->logo) }}" alt="Product Image" class="img-size-50"></td>
    </tr>
</table>
