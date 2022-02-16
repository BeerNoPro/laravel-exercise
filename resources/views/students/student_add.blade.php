
@extends('students.student_layout')

@section('title', 'add')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-5">
            <h1>Create new student</h1>
        </div>
        <div class="col-md-12 mt-3">
            <a href="{{ route('students.list') }}" class="btn btn-primary">Go back</a>
        </div>
    </div>
    <form action="{{ route('students.store') }}" method="post" class="mt-5">
        @csrf
        <div class="col-md-6 col-sm-12 form-group">
            <label for="register-form-name">Full name:</label>
            <input type="text" class="form-control" id="fullname" name="fullname">
        </div>
        <div class="col-md-6 col-sm-12 form-group">
            <label for="phone">Phone number:</label>
            <input type="text" class="form-control" id="phone" name="phonenumber">
        </div>
        <div class="col-md-6 col-sm-12 form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <button type="submit" class="btn btn-success mt-3" name="add">Add</button>
    </form>
@endsection
