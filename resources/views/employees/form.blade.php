{!! Form::model($model,  [
    'route'=>'employe.store',
    'method'=> 'POST',
    'files' => true
]) !!}

    {!! Form::hidden('id',null, ['class' => 'form-control', 'id'=>'id']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                {!! Form::text('first_name',null, ['class' => 'form-control', 'id'=>'first_name']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                {!! Form::text('last_name',null, ['class' => 'form-control', 'id'=>'last_name']) !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Companies</label>
                {!! Form::select('company_id', $company, null, ['placeholder' => 'Pilih', 'class' => 'form-control', 'id' =>'company_id']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                {!! Form::text('email',null, ['placeholder'=>'example@gmail.com','class' => 'form-control', 'id'=>'email']) !!}
            </div>
        </div>

         <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Phone</label>
                {!! Form::number('phone',null, ['class' => 'form-control', 'id'=>'phone']) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}

