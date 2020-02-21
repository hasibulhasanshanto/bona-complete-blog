@extends('backend.master')

@section('title')
    All Comments
@endsection

@push('css')
<link href="{{ asset('/backend/css/datatable/dataTables.bootstrap.css') }}" rel="stylesheet">

@endpush

@section('content')
<section class="content">
    <div class="container-fluid"> 

        <ol class="breadcrumb breadcrumb-bg-blue">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li class="active"><i class="material-icons">library_books</i> All Comments</li>
        </ol>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            All COMMENTS POST
                            <span class="badge bg-pink"></span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped centered table-hover dataTable js-exportable">
                                <thead class="center-align">
                                    <tr>
                                        <th class="align-center">Comments Info</th>
                                        <th class="align-center">Posts Info</th> 
                                        <th class="align-center">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="align-center">Comments Info</th>
                                        <th class="align-center">Posts Info</th>
                                        <th class="align-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php( $i =1)
                                    @foreach ($posts as $post)
                                        @foreach ($post->comments as $comment) 
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" width="64" height="64">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small></h4>
                                                        <p>{{ $comment->comment }}</p>
                                                    <a target="_blank" href="{{ route('front.single.post', $comment->post->slug.'#comments')}}">Reply</a>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="media">
                                                    <div class="media-right">
                                                        <a target="_blank" href="{{ route('front.single.post',$comment->post->slug) }}">
                                                            <img class="media-object" src="{{ Storage::disk('public')->url('posts/'.$comment->post->image) }}" width="64" height="64">
                                                        </a>
                                                    </div>
                                                    
                                                    <div class="media-body" style="padding-left: 10px;">  
                                                        <a target="_blank" href="{{ route('front.single.post',$comment->post->slug) }}">
                                                            <h4 class="media-heading">{{ Str::limit($comment->post->title,'40') }}</h4>
                                                        </a>
                                                        <p>by <strong>{{ $comment->post->user->name }}</strong></p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-danger waves-effect" onclick="deleteComment({{ $comment->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $comment->id }}" method="POST" action="{{ route('author.comment.destroy',$comment->id) }}"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
@endsection

@push('js')
    <script src="{{ asset('/backend/js/datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/backend/js/datatable/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('/backend/js/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/backend/js/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/backend/js/export/jszip.min.js') }}"></script>
    <script src="{{ asset('/backend/js/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/backend/js/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/backend/js/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/backend/js/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('/backend/js/datatable/jquery-datatable.js') }}"></script>
    <!-- Sweet Alert2 Js -->
    <script type="text/javascript">
        function deleteComment(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You can  be able to favourite again!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove comment!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                        'Removed!',
                        'This comment has been removed.',
                        'success'
                    )
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your comment is still there :)',
                        'error'
                    )
                }
            })
        } 
    </script>
@endpush