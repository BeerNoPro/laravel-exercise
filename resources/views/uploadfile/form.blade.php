<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload file local</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Upload images to s3</h1>
        <div class="mt-3 mb-5">
            <a href="{{ route('images-list') }}" class="btn btn-primary">Go back</a>
        </div>

        <form action="{{ route('upload-file') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="filenames[]" id="" multiple>
            <input type="submit" value="Add">
        </form>

        <div class="images-list mt-3">

            @isset($error)
                {{ $error }}
            @endisset
            
        </div>
    </div>
</body>
</html>