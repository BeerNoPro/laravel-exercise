
@extends('students.student_layout')

@section('title', 'list')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Students</h2>
            </div>
            <div class="pull-right mt-5">
                <a class="btn btn-success mb-3" href="{{ route('students.add') }}"> Create New Student</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th >Stt</th>
                <th >Full name</th>
                <th >Phone number</th>
                <th >Address</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $key => $item)
                <tr>
                    <td>{{ $index++ }}</td> 
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->address }}</td>
                    <td>
                        <a href="{{ route('students.show', $item->id) }}" class="btn btn-primary">Show</a>
                    </td>
                    <td>
                        <form action="{{ route('students.delete', $item->id) }}" method="post">
                            @csrf
                            {{@method_field('delete')}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('students.update', $item->id)}}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center mt-5">
        {{ $pages->links() }}
    </div>
@endsection
