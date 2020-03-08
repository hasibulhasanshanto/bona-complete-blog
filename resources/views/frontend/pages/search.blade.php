@extends('frontend.master')

@push('css') 
    <link href="{{ asset('/frontend/css/posts/styles.css')}}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/posts/responsive.css')}}" rel="stylesheet">
<style>
    .favorite_posts {
        color: red;
    }
    .header-bg{
        height: 400px;
        widows: 100%;
        background-size: cover;
        background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
        url({{ Storage::disk('public')->url('cover/cover1.jpeg') }});
        
    }

</style>
@endpush

@section('hero')

@section('main-body')
    <div class="overlay"></div>
    <div class="header-bg">
        <div class="slider display-table center-text">
            <h1 class="title display-table-cell">{{ $posts->count() }} Results for : {{ $query }}</h1>
        </div>
    </div>
    
    <section class="blog-area section">
        <div class="container">
    
            <div class="row">    
                @if ($posts->count() > 0)
                    @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                    
                                <div class="blog-image"><img src="{{ Storage::disk('public')->url('posts/'.$post->image ) }}"
                                        alt="{{ $post->title}}"></div>
                    
                                <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}"
                                        alt="{{ $post->user->name }} image"></a>
                    
                                <div class="blog-info">
                    
                                    <h4 class="title"><a href="{{ route('front.single.post', $post->slug )}}"><b>{{ $post->title}}</b></a>
                                    </h4>
                    
                                    <ul class="post-footer">
                                        <li>
                                            @guest
                                            <a href="javascript:void(0);" onclick="toastr.info('To favorite you have to login first', 'info', {
                                                                                            closeButton: true,
                                                                                            progressBar: true,
                                                                                        })"><i
                                                    class="ion-heart"></i>{{ $post->favorite_to_user->count() }}</a>
                                            @else
                                            <a href="javascript:void(0);"
                                                onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                                                class="
                                                                                            {{ !Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0 ? 'favorite_posts' : '' }}">
                                                <i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}</a>
                    
                                            <form id="favorite-form-{{ $post->id }}" action="{{ route('post.favorite',$post->id ) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            @endguest
                    
                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                    </ul>
                    
                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                    @endforeach
                @else
                    <div class="col-lg-10 col-md-10 offset-1">
                        <div class="card h-100">
                            <div class="single-post post-style-1"> 
                    
                                <div class="blog-info pt-5">                    
                                    <h4 class="title"><strong>Sorry, No posts found by your search data :(</strong></a>
                                    </h4> 
                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endif
            </div><!-- row -->
    
            {{-- {{ $posts->links() }} --}}
    
        </div><!-- container -->
    </section><!-- section -->

 
@endsection