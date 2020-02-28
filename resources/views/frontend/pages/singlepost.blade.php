@extends('frontend.master')

@push('css')
<link href="{{ asset('/frontend/css/single-post/styles.css')}}" rel="stylesheet">
<link href="{{ asset('/frontend/css/single-post/responsive.css')}}" rel="stylesheet">

<style>
    .favorite_posts {
        color: red;
    }
    .header-bg{
        height: 400px;
        widows: 100%;
        background-size: cover;
        background-image: url({{ Storage::disk('public')->url('posts/'.$post->image) }});
        
    }
</style>
@endpush

@section('hero') 

@section('main-body')
<div class="header-bg"> 

</div><!-- slider -->

<section class="post-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12 no-right-padding">

                <div class="main-post">

                    <div class="blog-post-inner">

                        <div class="post-info">

                            <div class="left-area">
                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                <h6 class="date">on {{ $post->created_at->diffForHumans() }}</h6>
                            </div>

                        </div><!-- post-info -->

                        <h3 class="title">
                            <a href="#"><b>{{ $post->title }}</b></a>
                        </h3>

                        <div class="para">{!! $post->body !!}</div> 

                        <ul class="tags">
                            @foreach ($post->tags as $tag)
                                <li><a href="{{ route('tag.post', $tag->slug)}}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- blog-post-inner -->

                    <div class="post-icons-area">
                        <ul class="post-icons">
                            <li>
                                @guest
                                <a href="javascript:void(0);" onclick="toastr.info('To favorite you have to login first', 'info', {
                                                                                closeButton: true,
                                                                                progressBar: true,
                                                                            })"><i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}</a>
                                @else
                                <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                                    class="
                                                                                {{ !Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0 ? 'favorite_posts' : '' }}">
                                    <i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}</a>
                            
                                <form id="favorite-form-{{ $post->id }}" action="{{ route('post.favorite',$post->id ) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                @endguest
                            
                            </li>
                            <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                            <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                        </ul>

                        <ul class="icons">
                            <li>SHARE : </li>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                        </ul>
                    </div> 


                </div><!-- main-post -->
            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 no-left-padding">

                <div class="single-post info-area">

                    <div class="sidebar-area about-area">
                        <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                        
                        <p><strong>{{ $post->user->name }}</strong></p>
                        <p>{{ $post->user->about }}</p>
                    </div> 

                    <div class="tag-area">

                        <h4 class="title"><b>POST CATEGORY</b></h4>
                        <ul>
                            @foreach ($post->categories as $category)
                        <li><a href="{{ route('category.post', $category->slug)}}">{{ $category->name }}</a></li>  
                            @endforeach 
                        </ul>

                    </div><!-- subscribe-area -->

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- post-area -->


<section class="recomended-area section">
    <div class="container">
        <div class="row">

            @foreach ($randomposts as $randompost)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                
                            <div class="blog-image"><img src="{{ Storage::disk('public')->url('posts/'.$randompost->image ) }}"
                                    alt="{{ $randompost->title}}"></div>
                
                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$randompost->user->image) }}"
                                    alt="{{ $randompost->user->name }} image"></a>
                
                            <div class="blog-info">
                
                                <h4 class="title"><a href="{{ route('front.single.post', $randompost->slug )}}"><b>{{ $randompost->title}}</b></a>
                                </h4>
                
                                <ul class="post-footer">
                                    <li>
                                        @guest
                                        <a href="javascript:void(0);" onclick="toastr.info('To favorite you have to login first', 'info', {
                                                                    closeButton: true,
                                                                    progressBar: true,
                                                                })"><i class="ion-heart"></i>{{ $randompost->favorite_to_user->count() }}</a>
                                        @else
                                        <a href="javascript:void(0);"
                                            onclick="document.getElementById('favorite-form-{{ $randompost->id }}').submit();"
                                            class="
                                                                    {{ !Auth::user()->favorite_posts->where('pivot.post_id', $randompost->id)->count() == 0 ? 'favorite_posts' : '' }}">
                                            <i class="ion-heart"></i>{{ $randompost->favorite_to_user->count() }}</a>
                
                                        <form id="favorite-form-{{ $randompost->id }}" action="{{ route('post.favorite',$randompost->id ) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        @endguest
                
                                    </li>
                                    <li>
                                        <a href="#"><i class="ion-chatbubble"></i>{{ $randompost->comments->count() }}</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="ion-eye"></i>{{ $randompost->view_count }}</a>
                                    </li>
                                </ul>
                
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
            @endforeach
              

        </div><!-- row -->

    </div><!-- container -->
</section>

<section class="comment-section">
    <div class="container">
        <h4><b>POST COMMENT</b></h4>
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="comment-form">
                    @guest
                <p>For post a new comment, You need to login first! <a href="{{ route('login')}}" style="color:red;"> Login</a></p>
                    @else                    
                        <form method="POST" action="{{ route('comment.store', $post->id)}}">
                            @csrf
                            <div class="row">
                        
                                <div class="col-sm-12">
                                    <textarea name="comment" rows="2" class="text-area-messge form-control"
                                        placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea>
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div><!-- col-sm-12 -->
                        
                            </div><!-- row -->
                        </form>
                    @endguest
                </div><!-- comment-form -->

                <h4><b>COMMENTS({{ $post->comments->count()}})</b></h4>


                <div class="commnets-area ">
                    @if ( $post->comments->count() > 0 )
                        @foreach ($post->comments as $comment)
                            <div class="comment">
                            
                                <div class="post-info">
                            
                                    <div class="left-area">
                                        <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}"
                                                alt="Profile Image"></a>
                                    </div>
                            
                                    <div class="middle-area">
                                        <a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                                        <h6 class="date"> on {{ $comment->created_at->toFormattedDateString() }}</h6>
                                    </div>
                            
                                    <div class="right-area">
                                        <h5 class="reply-btn"><a href="#"><b>like</b></a></h5>
                                    </div>
                            
                                </div><!-- post-info -->
                            
                                <p>{{ $comment->comment }}</p>
                            
                            </div>
                        @endforeach
                    @else
                        <p style="color:#498BF9;">No comments yet, Be the first one!!</p>
                    @endif

                    

                </div><!-- commnets-area --> 

            </div><!-- col-lg-8 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section>
@endsection