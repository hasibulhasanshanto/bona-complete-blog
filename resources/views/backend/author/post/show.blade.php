@extends('backend.master')

@section('title')
    Show Post
@endsection

@push('css')   

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
            <li class="active"><i class="material-icons">library_books</i> Show Post</li>
        </ol> 
        <div class="button-down">
            <a href="{{ route('author.post.index')}}" class="btn bg-deep-orange waves-effecr"><i class="material-icons">keyboard_backspace</i><span>BACK</span></a>
            @if ($post->is_approved == false)
                <button type="button" class="btn bg-red pull-right">
                    <i class="material-icons">warning</i>
                    <span>Pending</span>
                </button>
            @else
            <button type="button" class="btn bg-green pull-right disabled">
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
                
            @endif 
        </div>
        <br>
        <!-- Create Tag Table -->
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ $post->title }}
                        <small>Posted by- <strong><a href="http://">{{ $post->user->name }}</a></strong> on {{ $post->created_at->toFormattedDateString() }}</small>
                        </h2> 
                    </div>
                    <div class="body"> 
                        {!! $post->body !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                            CATEGORIES
                        </h2>
                    </div>
                    <div class="body"> 
                        @foreach ($post->categories as $category)
                            <span class="label bg-cyan">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-green">
                        <h2>
                            TAGS
                        </h2>
                    </div>
                    <div class="body">
                        @foreach ($post->tags as $tag)
                            <span class="label bg-green">{{ $tag->name }}</span>
                        @endforeach
                
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-blue">
                        <h2>
                            FEATURES IMAGE
                        </h2>
                    </div>
                    <div class="body">
                    <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('posts/'.$post->image) }}" alt="">
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