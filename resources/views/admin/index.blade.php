@extends('template.master')
@section('title', 'Dashboard')
@section('main')
<body class="">
  <section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
      <div class="navbar-header aside bg-info dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="icon-list"></i>
        </a>
        <a href="index.html" class="navbar-brand text-lt">
          <i class="icon-earphones"></i>
          <img src="images/logo.png" alt="." class="hide">
          <span class="hidden-nav-xs m-l-sm">Musik</span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="icon-settings"></i>
        </a>
      </div>
      <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>
            </span>
            <input type="text" class="form-control input-sm no-border rounded" placeholder="Search songs, albums...">
          </div>
        </div>
      </form>
      <div class="navbar-right ">
        <ul class="nav navbar-nav m-n hidden-xs nav-user user">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img src="images/a0.png" alt="...">
              </span>
              {{ Auth::user()->name }} <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">            
              <li>
                <span class="arrow top"></span>
                <a href="#">Settings</a>
              </li>
              <li>
                <a href="profile.html">Profile</a>
              </li>
              <li>
                <a href="#">
                  <span class="badge bg-danger pull-right">3</span>
                  Notifications
                </a>
              </li>
              <li>
                <a href="docs.html">Help</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="modal.lockme.html" data-toggle="ajaxModal" >Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>      
    </header> 
    <style>
		.container {
		    margin-left: auto;
		    margin-right: auto;
		    padding-left: 5%;
		    padding-right: 5%;
		}
	</style>
	<section class="container">
	  @if (session('errorMessage') != null)
	    <br />
	    <div class="container aside-xl">
	      <div class="alert alert-danger">
	        <button class="close" data-dismiss="alert" type="button">×</button>
	        <i class="fa fa-ok-sign"></i>
	        <strong>Error! </strong>
	        <p>{{ session('errorMessage') }}</p>
	        <ul>
	            @foreach (session('errorValidationResponse')->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	      </div>
	    </div>
	  @endif
	  @if (session('successMessage') != null)
	    <br />
	    <div class="container aside-xl">
	      <div class="alert alert-success">
	        <button class="close" data-dismiss="alert" type="button">×</button>
	        <i class="fa fa-ok-sign"></i>
	        <strong>Success! </strong>
	        <p>{{ session('successMessage') }}</p>
	      </div>
	    </div>
	  @endif
      <section class="hbox stretch">
        <section id="content">
          <section class="vbox">
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="text-center m-b m-t">
                          <a href="#" class="thumb-lg">
                            <img src="images/a0.png" class="img-circle">
                          </a>
                          <div>
                            <div class="h3 m-t-xs m-b-xs">{{ Auth::user()->name }}</div>
                            <small class="text-muted"><i class="fa fa-map-marker"></i> London, UK</small>
                          </div>                
                        </div>
                        <div class="btn-group btn-group-justified m-b">
                          <a class="btn btn-success btn-rounded" data-toggle="button">
                            <span class="text">
                              <i class="fa fa-eye"></i> Follow
                            </span>
                            <span class="text-active">
                              <i class="fa fa-eye"></i> Following
                            </span>
                          </a>
                          <a class="btn btn-dark btn-rounded">
                            <i class="fa fa-comment-o"></i> Chat
                          </a>
                        </div>
                        <div>
                          <small class="text-uc text-xs text-muted">priviledge</small>
                          <p>Admin</p>
                          <small class="text-uc text-xs text-muted">info</small>
                          <p>Welcome to the admin panel, {{ Auth::user()->name }}</p>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light lt">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#users" data-toggle="tab">Users</a></li>
                        <li class=""><a href="#artists" data-toggle="tab">Artists</a></li>
                        <li class=""><a href="#albums" data-toggle="tab">Albums</a></li>
                        <li class=""><a href="#songs" data-toggle="tab">Songs</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="users">
                  			<div class="row">
	                        	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin: 5px;">
			                        <section class="panel panel-default">
			                          	<header class="panel-heading font-bold">Create a new user</header>
			                          	<div class="panel-body">
			                          		<form action="/register" method="POST">
			                          			<div class="form-group">
			                          				<label>Email</label>
			                          				<input class="form-control" type="email" placeholder="Enter email">
			                          			</div>
			                          			<div class="form-group">
			                          				<label>Name</label>
			                          				<input class="form-control" type="text" placeholder="Enter Name">
			                          			</div>
			                          			<div class="form-group">
			                          				<label>Password</label>
			                          				<input class="form-control" type="text" placeholder="Password">
			                          			</div>
			                          			<input name="_token" value="<?php echo csrf_token(); ?>" hidden>
			                          			<button class="btn btn-sm btn-default" type="submit">Create User</button>
			                          		</form>
			                          	</div>
			                        </section>
		                        </div>
	                        </div>
                        </div>
                        <div class="tab-pane" id="artists">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                        <div class="tab-pane" id="albums">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                        <div class="tab-pane" id="songs">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
      </section>
    </section>
  </section>
  @stop
