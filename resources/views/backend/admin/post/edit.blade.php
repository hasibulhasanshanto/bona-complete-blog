@extends('backend.master')

@section('title')
    Edit Tag
@endsection

@push('css') 

@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header right m-r-10">
            <a href="{{ route('admin.post.index')}}" class="btn btn-success waves-effecr">
                <i class="material-icons">toc</i>
                <span>All Post</span>
            </a>
        </div>
        <ol class="breadcrumb breadcrumb-bg-blue">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li class="active"><i class="material-icons">library_books</i> Create Post</li>
        </ol>
        <!-- Create Tag Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            EDIT POST
                        </h2> 
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.post.update',$posts->id )}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                <input type="text" name="name" class="form-control" value="{{ $posts->name }}">
                                    <label class="form-label">Post Name</label>
                                </div>
                            </div> 
                            <div class="form-group form-float">
                                <label>Category Image</label>
                                <div class="form-line">                                    
                                   <img src="{{ asset('/storage/post/').'/'.$posts->image}}" alt="Category Image" style="height:90px;">
                                    
                                </div>
                            </div>
                            
                            <div class="form-group form-float">
                                <label>Want Update Image? If Yes-</label>
                                <div class="form-line">
                                <input type="file" name="image" class="form-control" ">
                                    
                                </div>
                            </div> 

                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
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