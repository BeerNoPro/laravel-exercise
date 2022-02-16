<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Ajax crud posts</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

        {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

        <style>
            .alert-message {
                color: red;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h2  class="alert alert-success text-center mt-5">
                Ajax CRUD with Laravel App
            </h2>
            <br>
            <div class="row">
                <div class="col-12 text-right">
                    <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-post">Add Post</a>
                </div>
                </div>
                    <div class="row" style="clear: both;margin-top: 18px;">
                        <div class="col-12">
                            <table id="laravel_crud" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr id="row_{{$post->id}}">
                                            <td>{{ $index++ }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->description }}</td>
                                            <td>
                                                <a href="javascript:void(0)" data-id="{{ $post->id }}" class="btn btn-info ajax-edit">
                                                    Edit
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" data-id="{{ $post->id }}" class="btn btn-danger ajax-deleted" >Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="post-modal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Create new post
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form name="userForm" class="form-horizontal">
                                <input type="hidden" name="post_id" id="post_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2">title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                                        <span id="titleError" class="alert-message"></span>
                                    </div>
                                </div>
                
                                <div class="form-group">
                                    <label class="col-sm-2">Description</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows="2" cols="20">
                                        </textarea>
                                        <span id="descriptionError" class="alert-message"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="create-post">Save</button>
                        </div>
                  </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {

            // $('#laravel_crud').DataTable();
          
            // Show model create post
            $('#create-new-post').click(function () {
                $('#post_id').val('');
                $('#post-modal').modal('show');
            })
          
            $('.ajax-edit').on('click', function() {
                var id  = $(this).attr('data-id');
                let _url = `edit-ajax/${id}`;
                $('#titleError').text('');
                $('#descriptionError').text('');
                
                $.ajax({
                    url: _url,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if(response) {
                            $("#post_id").val(response.id);
                            $("#title").val(response.title);
                            $("#description").val(response.description);
                            $('#post-modal').modal('show');
                        }
                    }
                });
            })
          
            // Create new post (save btn model)
            $('#create-post').click(function() {
                var title = $('#title').val();
                var description = $('#description').val();
                var id = $('#post_id').val();
            
                let _url     = '{{ url("ajax-crud/add-update-ajax") }}';
                let _token   = $('meta[name="csrf-token"]').attr('content');
            
                $.ajax({
                    url: _url,
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                        title: title,
                        description: description,
                        _token: _token
                    },
                    success: function(response) {
                        if(response.code == 200) {
                            if(id != ""){
                                $("#row_"+id+" td:nth-child(2)").html(response.data.title);
                                $("#row_"+id+" td:nth-child(3)").html(response.data.description);
                            } else {
                                $('table tbody').append(`
                                    <tr id="row_${response.data.id}">
                                        <td>${response.count}</td>
                                        <td>${response.data.title}</td>
                                        <td>${response.data.description}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="${response.data.id}" 
                                            class="btn btn-info ajax-edit">Edit</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="${response.data.id}" 
                                            class="btn btn-danger ajax-deleted">Delete</a>
                                        </td>
                                    </tr> 
                                `);
                            }
                            $('#title').val('');
                            $('#description').val('');
            
                            $('#post-modal').modal('hide');
                        }
                    },
                    error: function(response) {
                        $('#titleError').text(response.responseJSON.errors.title);
                        $('#descriptionError').text(response.responseJSON.errors.description);
                    }
                });
            })
          
            $('.ajax-deleted').on('click', function() {

                var id  = $(this).attr('data-id');
                let _url = `delete-ajax/${id}`;
                let _token   = $('meta[name="csrf-token"]').attr('content');
            
                $.ajax({
                    url: _url,
                    type: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#row_"+id).remove();
                        }
                    }
                });
            })
        })
      
    </script>
</html>