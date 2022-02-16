
@extends('students.student_layout')

@section('content')

    <div> 
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1 class="pull-left">Show student detail</h1>
            </div>
            <div class="col-md-12 mt-3 mb-3">
                <a href="{{ route('students.list') }}" class="btn btn-primary">Go back</a>
            </div>
        </div>
        <table class="table table-responsive table-bordered">
            <tr>
                <th>Full name:</th>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <th>Phone number:</th>
                <td>{{ $student->phone }}</td>
            </tr>
            <tr>
                <th>Address:</th>
                <td>{{ $student->address }}</td>
            </tr>
            <tr>
                <th>Created time:</th>
                <td>{{ $student->created_at }}</td>
            </tr>
            <tr>
                <th>Updated time:</th>
                <td>{{ $student->updated_at }}</td>
            </tr>
        </table>
    </div>

@endsection
