@extends('backend.master')

@section('title')
    Create Post
@endsection

@push('css')  
<!-- Bootstrap Select Css -->
    <link href="{{ asset('/backend/css/bootstrap-select.min.css')}}" rel="stylesheet" />
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header right m-r-10">
            <a href="{{ route('author.post.index')}}" class="btn btn-success waves-effecr">
                <i class="material-icons">toc</i>
                <span>All Post</span>
            </a>
        </div>
        <ol class="breadcrumb breadcrumb-bg-blue">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li class="active"><i class="material-icons">library_books</i> Create Post</li>
        </ol>
        <form action="{{ route('author.post.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Create Tag Table -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CREATE NEW POST
                            </h2> 
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                            <div class="form-line">
                                    <input type="text" name="title" class="form-control">
                                    <label class="form-label">Post Title</label>
                                </div>
                            </div>
                            <br> 
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="image">Featured Image</label>
                                    <input type="file" name="image" class="form-control"> 
                                    
                                </div>
                            </div> 
                            <br>
                            <div class="demo-checkbox"> 
                                <input type="checkbox" id="Publish" name="status" class="filled-in" value="1">
                                <label for="Publish">Publish</label> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card">
                        <div class="header">
                            <h2>
                                SELECT CATEGORIES & TAGS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <label class="form-label">Select Categories</label>
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}"> 
                                    <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group form-float">
                                <label class="form-label">Select Tags</label>
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}"> 
                                    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">CREATE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Create Tag Table -->
            <!-- Create Tag Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                WRITE POST HERE
                            </h2>
                        </div>  
                            <div class="body">
                                <textarea id="mytextarea" name="body" rows="20">Hello, World!</textarea> 
                            </div> 
                    </div>
                </div>
            </div>
            <!-- #END# Create Tag Table -->
        </form>

    </div>
 
</section>
@endsection

@push('js')   
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    
    <script>
        tinymce.init({
            selector: '#mytextarea'
          });
    </script> 

@endpush