@extends('backend.master')

@section('title')
    Home
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="body">
                    <ol class="breadcrumb breadcrumb-bg-purple align-right"> 
                        <li><a href="javascript:void(1);">User's <i class="material-icons">home</i> Home</a></li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">                        
                        <button class="btn btn-success btn-lg btn-block waves-effect" type="button"> WELCOME USER !!!</button> 
                        <h2 style="margin-top: 20px;">YOUR'S INFO DETAILS</h2> 
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos"> 
                                <tbody>
                                    <tr>
                                        <td>Name: </td>
                                        <td>{{ Auth::user()->name }}</td> 
                                    </tr>
                                    <tr>
                                        <td>Email: </td>
                                        <td>{{ Auth::user()->email }}</td> 
                                    </tr>
                                    <tr>
                                        <td>Username: </td>
                                        <td>{{ Auth::user()->username }}</td> 
                                    </tr>
                                    <tr>
                                        <td>Role: </td>
                                        <td>{{ Auth::user()->role->name }}</td> 
                                    </tr>
                                    <tr>
                                        <td>About: </td>
                                        <td>{{ Auth::user()->about }}</td> 
                                    </tr>
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