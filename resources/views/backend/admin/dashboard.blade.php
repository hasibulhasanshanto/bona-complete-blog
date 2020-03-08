@extends('backend.master')

@section('title')
    Admin Dashboard
@endsection

@push('css') 
<!-- Morris Chart Css-->
<link href="{{ asset('/backend/css/morris.css')}}" rel="stylesheet" />
@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="body">
                        <ol class="breadcrumb breadcrumb-bg-blue">
                            <li><a href="javascript:void(0);"><i class="material-icons">dashboard</i> Dashboard</a></li>
                            <li><a href="javascript:void(1);"><i class="material-icons">home</i> Home</a></li>
                        </ol>
                    </div>
                </div>
            </div>
    
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">art_track</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL POSTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="15"
                                data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">favorite</i>
                        </div>
                        <div class="content">
                            <div class="text">FAVORITE POSTS</div>
                            <div class="number count-to" data-from="0" data-to="{{ Auth::user()->favorite_posts->count() }}" data-speed="1000"
                                data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">PENDING POSTS</div>
                            <div class="number count-to" data-from="0" data-to="{{ $pending_posts }}" data-speed="1000"
                                data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL VIEWS</div>
                            <div class="number count-to" data-from="0" data-to="{{ $all_views }}" data-speed="1000"
                                data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-lg-3 col-md-4">
                    <div class="info-box bg-pink hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">apps</i>
                        </div>
                        <div class="content">
                            <div class="text">CATEGORIES</div>
                        <div class="number count-to" data-from="0" data-to="{{ $category_count }}" data-speed="15"
                                data-fresh-interval="20"></div>
                        </div>
                    </div>

                    <div class="info-box bg-amber hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">note</i>
                        </div>
                        <div class="content">
                            <div class="text">TAGS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $tag_count }}" data-speed="15"
                                data-fresh-interval="20"></div>
                        </div>
                    </div>
                    <div class="info-box bg-indigo hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">account_circle</i>
                        </div>
                        <div class="content">
                            <div class="text">ACTIVE AUTHORS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $author_count }}" data-speed="15"
                                data-fresh-interval="20"></div>
                        </div>
                    </div>
                    <div class="info-box bg-purple hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">fiber_new</i>
                        </div>
                        <div class="content">
                            <div class="text">TODAY'S AUTHOR</div>
                        <div class="number count-to" data-from="0" data-to="{{ $new_authors_reg }}" data-speed="15"
                                data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div> 
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                    <div class="card">
                        <div class="header">
                            <h2>MOST POPULAR POST</h2> 
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Views</th>
                                            <th>Favorite</th>
                                            <th>Comments</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($popular_posts as $key=>$post)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ Str::limit($post->title, '20')}}</td>
                                                <td>{{ $post->user->name }}</td>
                                                <td>{{ $post->view_count }}</td> 
                                                <td>{{ $post->favorite_to_user_count }}</td> 
                                                <td>{{ $post->comments_count }}</td>  
                                                <td>
                                                    @if ($post->status == true)
                                                        <span class="label bg-green">Published</span>
                                                    @else
                                                        <span class="label bg-red">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                <a class="btn btn-sm btn-primary waves-effect" href="{{ route('front.single.post', $post->slug )}}" target="_blank"><i class="material-icons">visibility
                                                    </i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info --> 
            </div>
            <!-- #END# Widgets -->
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            {{-- <h2>TOP 10 ACTIVE AUTHORS</h2>  --}}
                            <button class="btn btn-success btn-lg btn-block waves-effect" type="button">TOP 10 ACTIVE AUTHORS </button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Name</th>
                                            <th>Posts</th>
                                            <th>Comments</th>
                                            <th>Favourite</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($active_authors as $key=>$author)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $author->name }}</td>
                                                <td>{{ $author->posts_count }}</td> 
                                                <td>{{ $author->comments_count }}</td> 
                                                <td>{{ $author->favorite_posts_count }}</td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info --> 
            </div>
        </div>
    </section>
@endsection

@push('js') 
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('/backend/js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('/backend/js/index.js') }}"></script> 
@endpush