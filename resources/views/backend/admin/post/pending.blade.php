@extends('backend.master')

@section('title')
    Pending Post
@endsection

@push('css')
<link href="{{ asset('/backend/css/datatable/dataTables.bootstrap.css') }}" rel="stylesheet">

@endpush

@section('content')
<section class="content">
    <div class="container-fluid"> 
        <ol class="breadcrumb breadcrumb-bg-blue">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li class="active"><i class="material-icons">library_books</i> Pending Post</li>
        </ol>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            PENDING POST
                            <span class="badge bg-pink">{{ $posts->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped centered table-hover dataTable js-exportable">
                                <thead class="center-align">
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Is Approved</th>
                                        <th>Views</th>
                                        <th>Created At</th>
                                        <th class="align-center">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Is Approved</th>
                                        <th>Views</th>
                                        <th>Created At</th>
                                        <th class="align-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php( $i =1)
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ Str::limit($post->title, '15') }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>
                                            @if ($post->status == true)
                                                <span class="badge bg-blue">Published</span>
                                            @else
                                                <span class="badge bg-pink">Unpublished</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($post->is_approved == true)
                                                <span class="badge bg-blue">Approved</span>
                                            @else
                                                <span class="badge bg-pink">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->view_count }}</td>
                                        <td>{{ $post->created_at->toFormattedDateString() }}</td>
                                        <td class="text-center">
                                            @if ($post->is_approved == false)
                                                <button type="button" class="btn bg-teal waves-effect" onclick="approvePost({{ $post->id }})">
                                                    <i class="material-icons">done</i> 
                                                </button>
                                                <form method="POST" action="{{ route('admin.post.approve', $post->id )}}" id="approval-form" style="display:none; ">
                                                    @csrf
                                                    @method('PUT')
                                                </form>                                             
                                            @endif
                                            <a href="{{ route('admin.post.edit', $post->id )}}"
                                                class="btn btn-primary waves-effect">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a href="{{ route('admin.post.show', $post->id )}}"
                                                class="btn btn-success waves-effect">
                                                <i class="material-icons">visibility</i>
                                            </a>

                                            <button class="btn btn-danger waves-effect" id="delete" type="button"
                                                onclick="deletePost({{ $post->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>

                                            <form id="delete-form-{{ $post->id }}" method="POST"
                                                action="{{ route('admin.post.destroy', $post->id )}}"
                                                style="display:none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>

                                    </tr>
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
        function deletePost(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
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
                            'Your imaginary file is safe :)',
                            'error'
                        )
                    }
                })
            }
            function approvePost(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                        },
                    buttonsStyling: false
                })
                    
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, approve it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                        'Approved!',
                        'Your post has been approved.',
                        'success'
                    )
                    event.preventDefault();
                    document.getElementById('approval-form').submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                    ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your post remain Pending!',
                        'info'
                    )
                }
                })
            }
    </script>
@endpush