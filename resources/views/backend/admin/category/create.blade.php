@extends('backend.master')

@section('title')
    Create Category
@endsection

@push('css')  
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header right m-r-10">
            <a href="{{ route('admin.category.index')}}" class="btn btn-success waves-effecr">
                <i class="material-icons">toc</i>
                <span>Category Details</span>
            </a>
        </div>
        <ol class="breadcrumb breadcrumb-bg-blue">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li class="active"><i class="material-icons">library_books</i> Create Category</li>
        </ol>
        <!-- Create Tag Table -->
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CREATE NEW CATEGORY
                            </h2> 
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.category.store')}}" method="post" enctype="multipart/form-data"> 
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control">
                                        <label class="form-label">Tag Name</label>
                                    </div>
                                </div>
                                <br> 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label>Input Image</label>
                                        <input type="file" name="image" class="form-control"> 
                                        
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">CREATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- #END# Create Tag Table -->
    </div>
</section>
@endsection

@push('js')  

@endpush