
@extends('admin.admin-panel.blank')

@section('content')

    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif


    <h4>Employee Data Update</h4>
    <hr>


    <form action="{{ route('employee.update', $employee->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('put')

        <div class="form-group">
            <label for="exampleInputEmail1">Employee Name</label>
            <input type="text" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="" name="name"
                   class="form-control @error('name') is-invalid @enderror" value="{{ $employee->name }}">
        </div>


        @error('name')
        <div class="alert alert-danger" style="margin-top: 10px">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="exampleInputEmail1">Employee Designation</label>
            <input type="text" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="" name="designation"
                   class="form-control @error('designation') is-invalid @enderror" value="{{ $employee->designation }}">
        </div>


        @error('designation')
        <div class="alert alert-danger" style="margin-top: 10px">{{ $message }}</div>
        @enderror


        <div class="form-group">
            <label for="exampleInputEmail1">Employee Status</label>
            <input type="text" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="" name="status"
                   class="form-control @error('status') is-invalid @enderror" value="{{ $employee->status }}">
        </div>


        @error('status')
        <div class="alert alert-danger" style="margin-top: 10px">{{ $message }}</div>
        @enderror



        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>

    <br>

@endsection
