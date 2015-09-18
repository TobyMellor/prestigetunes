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
		@if($errorMessage != null)
			<div class="alert alert-danger" style="margin-top: 5px;">
				<button class="close" data-dismiss="alert" type="button">×</button>
				<i class="fa fa-ok-sign"></i>
				<strong>Error! </strong>
				<p>{{ $errorMessage }}</p>
				@if($errorValidationResponse != null)
					@if(!is_string($errorValidationResponse))
						<ul>
						    @foreach ($errorValidationResponse->all() as $error)
						        <li>{{ $error }}</li>
						    @endforeach
						</ul>
					@else
						<ul>
							<li>{!! $errorValidationResponse !!}</li>
						</ul>
					@endif
				@endif
		    </div>
		@endif
		@if($successMessage != null)
			<div class="alert alert-success" style="margin-top: 5px;">
				<button class="close" data-dismiss="alert" type="button">×</button>
				<i class="fa fa-ok-sign"></i>
				<strong>Success! </strong>
				<p>{{ $successMessage }}</p>
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
	                        	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin: 5px; padding-right: 0px;">
			                        <section class="panel panel-default">
			                          	<header class="panel-heading font-bold">Create a new user</header>
			                          	<div class="panel-body">
			                          		<form action="/register" method="POST">
			                          			<div class="form-group">
			                          				<label>Email</label>
			                          				<input name="email" class="form-control" type="email" placeholder="Enter email">
			                          			</div>
			                          			<div class="form-group">
			                          				<label>Name</label>
			                          				<input name="name" class="form-control" type="text" placeholder="Enter Name">
			                          			</div>
			                          			<div class="form-group">
			                          				<label>Password</label>
			                          				<input name="password" class="form-control" type="text" autocomplete="off" placeholder="Password">
			                          			</div>
			                          			<input name="_token" value="{{ csrf_token() }}" hidden>
			                          			<button class="btn btn-sm btn-default" type="submit">Create User</button>
			                          		</form>
			                          	</div>
			                        </section>
		                        </div>
		                        @if(isset($users))
		                        	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7" style="margin: 5px; padding-left: 0px;">
				                        <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
				                        	@foreach($users as $user)
												<li class="list-group-item" id="list-user-{{ $user->id }}">
													<a class="thumb-sm pull-left m-r-sm" href="#">
														<img class="img-circle" src="images/a0.png">
													</a>
													<a class="clear">
														<small class="pull-right">{{ $signedUpArray[$user->id] }}</small>
														<strong class="block">{{ $user->name }} | {{ $user->email }}</strong>
														<small>Registered to the site</small>
													</a>
													<a class="btn btn-danger pull-right delete-user @if($user->id == Auth::user()->id) disabled @endif" style="padding: 0px 10px 4px; position: absolute; margin-top: -18px; right: 15px;" href="#" user="{{ $user->id }}">Delete</a>
												</li>
											@endforeach
											<br />
											{!! $users->render() !!}
										</ul>
									</div>
								@endif
	                        </div>
                        </div>
                        <div class="tab-pane" id="artists">
                          <div class="row">
	                        	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin: 5px; padding-right: 0px;">
			                        <section class="panel panel-default">
			                          	<header class="panel-heading font-bold">Create a new artist</header>
			                          	<div class="panel-body">
			                          		<form action="/artist" method="POST">
			                          			<div class="form-group">
			                          				<label>Artist Name</label>
			                          				<input name="artist_name" class="form-control" type="text" autocomplete="off" placeholder="Enter Artists Name">
			                          			</div>
			                          			<div class="form-group">
			                          				<label>Artist Image Location</label>
			                          				<input name="artist_image_loc" class="form-control" type="text" autocomplete="off" placeholder="Image URL Here">
			                          			</div>
			                          			<input name="_token" value="{{ csrf_token() }}" hidden>
			                          			<button class="btn btn-sm btn-default" type="submit">Create Artist</button>
			                          		</form>
			                          	</div>
			                        </section>
		                        </div>
		                        @if(isset($artists))
		                        	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7" style="margin: 5px; padding-left: 0px;">
				                        <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
				                        	@foreach($artists as $artist)
												<li class="list-group-item" id="list-artist-{{ $artist->id }}">
													<a class="thumb-sm pull-left m-r-sm" href="#">
														<img class="img-circle" src="images/a0.png">
													</a>
													<a class="clear">
														<small class="pull-right">{{ $artist->created_at }}</small>
														<strong class="block">{{ $artist->artist_name }}</strong>
														<small>Artist added to the site</small>
													</a>
													<a class="btn btn-danger pull-right delete-artist" style="padding: 0px 10px 4px; position: absolute; margin-top: -18px; right: 15px;" href="#" artist="{{ $artist->id }}">Delete</a>
												</li>
											@endforeach
											<br />
											{!! $artists->render() !!}
										</ul>
									</div>
								@endif
	                        </div>
                        </div>
                        <div class="tab-pane" id="albums">
                          <div class="row">
	                        	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin: 5px; padding-right: 0px;">
			                        <section class="panel panel-default">
			                          	<header class="panel-heading font-bold">Create a new album</header>
			                          	<div class="panel-body">
			                          		<form action="/album" method="POST">
			                          			<div class="form-group">
			                          				<label>Album Name</label>
			                          				<input name="album_name" class="form-control" type="text" autocomplete="off" placeholder="Enter Album Name">
			                          			</div>
			                          			<div class="form-group">
			                          				<label>Album Image Location</label>
			                          				<input name="album_image_loc" class="form-control" type="text" autocomplete="off" placeholder="Image URL Here">
			                          			</div>
			                          			<input name="_token" value="{{ csrf_token() }}" hidden>
			                          			<button class="btn btn-sm btn-default" type="submit">Create Album</button>
			                          		</form>
			                          	</div>
			                        </section>
		                        </div>
		                        @if(isset($albums))
		                        	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7" style="margin: 5px; padding-left: 0px;">
				                        <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
				                        	@foreach($albums as $album)
												<li class="list-group-item" id="list-album-{{ $album->id }}">
													<a class="thumb-sm pull-left m-r-sm" href="#">
														<img class="img-circle" src="images/a0.png">
													</a>
													<a class="clear">
														<small class="pull-right">{{ $album->created_at }}</small>
														<strong class="block">{{ $album->album_name }}</strong>
														<small>Album added to the site</small>
													</a>
													<a class="btn btn-danger pull-right delete-album" style="padding: 0px 10px 4px; position: absolute; margin-top: -18px; right: 15px;" href="#" album="{{ $album->id }}">Delete</a>
												</li>
											@endforeach
											<br />
											{!! $albums->render() !!}
										</ul>
									</div>
								@endif
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

  @section('scripts')
  	<script>
		//jQuery Element Events
		$(document).ready(function() {
			$('.delete-user').click(function() {
				var userId = $(this).attr('user');
				deleteEntity(userId, 'user');
			});

			$('.delete-artist').click(function() {
				var artistId = $(this).attr('artist');
				deleteEntity(artistId, 'artist');
			});

			$('.delete-album').click(function() {
				var albumId = $(this).attr('album');
				deleteEntity(albumId, 'album');
			});
		});
    
     	//Javascript Functions
  		var token = '{{ csrf_token() }}';
  		function deleteEntity(entityId, entityType) {
  			$.ajax({
  				url: '/api/' + entityType,
  				type: 'DELETE',
	  			data: {
	  					_token: token,
	  					entityId: entityId
	  				}
	  			})
		        .done(function(data) {
          			var responseArray = $.parseJSON(data.replace(/\s+/g," "));
					if(responseArray.error == 0) {
						$('#list-' + entityType + '-' + entityId).fadeOut();
					}
		    });
  		}

  	</script>
  @stop
