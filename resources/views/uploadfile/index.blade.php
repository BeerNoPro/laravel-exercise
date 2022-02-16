
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List images s3</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>List images upload s3</h1>
        <div class="mb-5">
            <a href="{{ route('upload-file') }}" class="btn btn-success">Upload new image</a>
        </div>
        <div class="success-delete">
            @isset($success)
                {{ $success }}
            @endisset
        </div>
        <div class="w-50 mx-auto">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Images</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($images as $image)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>
                                <div class="mt-3">
                                    <img src="{{ $image['src'] }}" alt="">
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('delete-file', $image['src']) }}" method="POST">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>