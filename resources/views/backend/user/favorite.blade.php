@extends('backend.master')

@section('title')
    All Favorite Post
@endsection

@push('css')
<link href="{{ asset('/backend/css/datatable/dataTables.bootstrap.css') }}" rel="stylesheet">

@endpush

@section('content')
<section class="content">
    <div class="container-fluid"> 
        <ol class="breadcrumb breadcrumb-bg-purple">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li class="active"><i class="material-icons">library_books</i> All Favorite Post</li>
        </ol>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL FAVORITE POST
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
                                        <th><i class="material-icons">favorite</i></th>
                                        {{-- <th><i class="material-icons">comment</i></th> --}}
                                        <th><i class="material-icons">visibility</i></th> 
                                        <th class="align-center">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th><i class="material-icons">favorite</i></th>
                                        {{-- <th><i class="material-icons">comment</i></th> --}}
                                        <th><i class="material-icons">visibility</i></th> 
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
                                        <td>{{ $post->favorite_to_user->count() }}</td> 
                                        {{-- <td>blank</td> --}}
                                        <td>{{ $post->view_count }}</td>

                                        <td class="text-center"> 
                                            <a href=""
                                                class="btn btn-success waves-effect">
                                                <i class="material-icons">visibility</i>
                                            </a>

                                            <button class="btn btn-danger waves-effect" id="delete" type="button"
                                                onclick="removeFav({{ $post->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>

                                            <form id="remove-form-{{ $post->id }}" method="POST"
                                                action="{{ route('post.favorite',$post->id ) }}"
                                                style="display:none">
                                                @csrf 
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
        function removeFav(id) {
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
                confirmButtonText: 'Yes, remove fav!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                        'Removed!',
                        'Your fav has been removed.',
                        'success'
                    )
                    event.preventDefault();
                    document.getElementById('remove-form-'+id).submit();
                } else if (
                /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your fav is still there :)',
                        'error'
                    )
                }
            })
        } 
    </script>
@endpush