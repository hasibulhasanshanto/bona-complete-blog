@extends('backend.master')

@section('title')
    Category
@endsection

@push('css') 
    <link href="{{ asset('/backend/css/datatable/dataTables.bootstrap.css') }}" rel="stylesheet"> 
    
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header right m-r-10">
            <a href="{{ route('admin.category.create')}}" class="btn btn-success waves-effect">
                <i class="material-icons">add</i>
                <span>Add New Category</span>
            </a>
        </div>
        <ol class="breadcrumb breadcrumb-bg-blue">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li class="active"><i class="material-icons">library_books</i> All Category</li>
        </ol>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL CATEGORY 
                            <span class="badge bg-pink">{{ $categories->count() }}</span>
                        </h2> 
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped centered table-hover dataTable js-exportable">
                                <thead class="center-align">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th> 
                                        <th>Post_count</th>
                                        <th>Image</th>
                                        <th>Created At</th> 
                                        <th class="align-center">Action</th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Post_count</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th class="align-center">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php( $i =1)
                                    @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->posts->count() }}</td> 
                                        <td>
                                            <img src="{{ asset('/storage/category/slider').'/'.$item->image}}" alt="Category Image" style="height:70px;">
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="text-center"> 
                                            <a href="{{ route('admin.category.edit', $item->id )}}" class="btn btn-primary waves-effect">
                                                <i class="material-icons">edit</i>
                                            </a>

                                            <button class="btn btn-danger waves-effect" id="delete" type="button"
                                            onclick="deleteCategory({{ $item->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>

                                            <form id="delete-form-{{ $item->id }}" method="POST" action="{{ route('admin.category.destroy', $item->id )}}" style="display:none">
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
        function deleteCategory(id) {
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
    </script>
@endpush