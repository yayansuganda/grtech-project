{!! Form::model($model,  [
    'route'=>'compani.store',
    'method'=>'POST'
]) !!}

    {!! Form::hidden('id',null, ['class' => 'form-control', 'id'=>'id']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name</label>
                {!! Form::text('name',null, ['class' => 'form-control', 'id'=>'name','required']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                {!! Form::text('email',null, ['placeholder'=>'example@gmail.com','class' => 'form-control', 'id'=>'email']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="website">Website</label>
                {!! Form::text('website',null, ['placeholder'=>'http://example.com','class' => 'form-control', 'id'=>'website']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="logo">Logo</label>
                <br>
                <input type="file" name="logo" id="logo">
            </div>
        </div>
    </div>

{!! Form::close() !!}

