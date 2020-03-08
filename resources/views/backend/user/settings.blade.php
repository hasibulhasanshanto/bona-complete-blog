@extends('backend.master')

@section('title')
    Settings
@endsection

@push('css') 

@endpush

@section('content') 
<section class="content">
    <div class="container-fluid"> 
        <ol class="breadcrumb breadcrumb-bg-purple">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li class="active"><i class="material-icons">library_books</i> User Settings</li>
        </ol>
        <!-- Exportable Table -->
        <div class="row clearfix"> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    {{-- <div class="header">
                        <h2>
                            User Settings
                        </h2> 
                    </div> --}}
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#profile_with_icon_title" data-toggle="tab" aria-expanded="true">
                                    <i class="material-icons">face</i> UPDATE PROFILE
                                </a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#password_with_icon_title" data-toggle="tab" aria-expanded="false">
                                    <i class="material-icons">lock_outline</i>CHANGE PASSWORD
                                </a>
                            </li> 
                        </ul>
            
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="profile_with_icon_title">
                                <div class="body">
                                    <form class="form-horizontal" action="{{ route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="name">Name: </label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="name" class="form-control"
                                                    name="name" value="{{ Auth::user()->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="username">User Name: </label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="username" class="form-control" name="username"
                                                            value="{{ Auth::user()->username }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email_address_2">Email Address:</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="email_address_2" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="image">Profile Image:</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group"> 
                                                    @if( Auth::user()->image != 'default.png')
                                                        <img src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" alt="Users Image" style="width:100px;" />
                                                    @else
                                                        <img src="{{ Storage::disk('public')->url('default/'.'default.png') }}" alt="Users Image" style="width:100px;" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="image">Upload New Image:</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="file" id="file" class="form-control" name="image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="about">User's About:</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <textarea name="about" cols="" rows="3" class="form-control" >{{ Auth::user()->about }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row clearfix">
                                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="password_with_icon_title">
                                <div class="body">
                                    <form class="form-horizontal" action="{{ route('user.password.update')}}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="old_password">Old Password: </label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" id="old_password" class="form-control" name="old_password" placeholder="Enter your old password" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="password">New Password: </label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter your new password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="confirm_password">Confirm Password: </label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Comfirm password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div class="row clearfix">
                                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE PASSWORD</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> 
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

@endpush