@extends('template.master')
@section('title', 'Dashboard')
@section('main')
<body class="">
  <div class="modal modal-over" id="createPlaylistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-center animated fadeInUp text-center" style="width:250px; margin:-80px 0 0 -100px;">
      <p class="text-white h4 m-t m-b">Create a Playlist</p>
      <div class="input-group">
        <span class="input-group-btn">
          <button class="btn btn-danger btn-rounded" type="button" data-dismiss="modal"><i class="fa fa-ban"></i></button>
        </span>
        <input type="text" class="form-control text-sm btn-rounded" placeholder="Playlist name here..." id="createPlaylistModalData">
        <span class="input-group-btn">
          <button class="btn btn-success btn-rounded" type="button" data-dismiss="modal" id="createPlaylistModalButton"><i class="fa fa-arrow-right"></i></button>
        </span>
      </div>
    </div>
  </div>  
  <section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
      <div class="navbar-header aside bg-info dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="icon-list"></i>
        </a>
        <a href="index.html" class="navbar-brand text-lt">
          <i class="icon-earphones"></i>
          <img src="images/logo.png" alt="." class="hide">
          <span class="hidden-nav-xs m-l-sm">PrestigeTunes</span>
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
              {{ $userName }} <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">
              <li>
                <a href="logout">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black dk aside hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f-md scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <ul class="nav bg clearfix">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      Discover
                    </li>
                    <li>
                      <a href="/">
                        <i class="icon-disc icon text-success"></i>
                        <span class="font-bold">What's new</span>
                      </a>
                    </li>
                    <li>
                      <a href="/">
                        <i class="icon-music-tone-alt icon text-info"></i>
                        <span class="font-bold">Genres</span>
                      </a>
                    </li>
                  </ul>
                  <ul class="nav text-sm" id="playlist-list">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      <span class="pull-right"><a href="#" data-toggle="modal" data-target="#createPlaylistModal"><i class="icon-plus i-lg"></i></a></span>
                      <span>Playlist</span>
                    </li>
                    @if($playlists != null)
                      @foreach($playlists as $playlist)
                        <li>
                          <a href="#" onclick="loadPlaylistDashboard({{ $playlist->id }})">
                            <i class="icon-playlist icon text-success-lter"> </i>
                            <span>{{ $playlist->playlist_name }}</span>
                          </a>
                        </li>
                      @endforeach
                    @endif
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <div class="bg hidden-xs ">
                <div class="dropdown dropup wrapper-sm clearfix">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="thumb-sm avatar pull-left m-l-xs">                        
                      <img src="images/a3.png" class="dker" alt="...">
                      <i class="on b-black"></i>
                    </span>
                    <span class="hidden-nav-xs clear">
                      <span class="block m-l">
                        <strong class="font-bold text-lt">{{ $userName }}</strong> 
                        <b class="caret"></b>
                      </span>
                      <span class="text-muted text-xs block m-l">Logout</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu animated fadeInRight aside text-left">
                    <li>
                      <a href="logout">Logout</a>
                    </li>
                  </ul>
                </div>
              </div>            
            </footer>
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
          <section class="hbox stretch">
            <section>
              <section class="vbox">
                <section class="scrollable w-f-md" id="bjax-target">
                  <section class="wrapper-lg">
                    <div class="alert alert-success" id="success-notification" style="margin-top:10px; display:none;">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <i class="fa fa-ok-sign"></i>
                      <strong>Success! </strong>
                      <p id="success-notification-message"></p>
                    </div>
                    <div class="alert alert-danger" id="error-notification" style="margin-top:10px; display:none;">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <i class="fa fa-ok-sign"></i>
                      <strong>Error! </strong>
                      <p id="error-notification-message"></p>
                    </div>
                    <a href="#" class="pull-right text-muted m-t-lg" data-toggle="class:fa-spin" ><i class="icon-refresh i-lg  inline" id="refresh"></i></a>
                    <h2 class="font-thin m-b">Discover <span class="musicbar animate inline m-l-sm" style="width:20px;height:20px">
                      <span class="bar1 a1 bg-primary lter"></span>
                      <span class="bar2 a2 bg-info lt"></span>
                      <span class="bar3 a3 bg-success"></span>
                      <span class="bar4 a4 bg-warning dk"></span>
                      <span class="bar5 a5 bg-danger dker"></span>
                    </span></h2>
                    <div class="row row-sm">

                      @if(isset($randomSongs))
                        @foreach($randomSongs as $song)
                          <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                            <div class="item">
                              <div class="pos-rlt">
                                <div class="bottom">
                                  <span class="badge bg-info m-l-sm m-b-sm">{{ floor($song->song_duration / 1000) }}s</span>
                                </div>
                                <div class="item-overlay opacity r r-2x bg-black">
                                  <div class="text-info padder m-t-sm text-sm">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o text-muted"></i>
                                  </div>
                                  <div class="center text-center m-t-n">
                                    <a href="#"><i class="icon-control-play i-2x"></i></a>
                                  </div>
                                  <div class="bottom padder m-b-sm">
                                    <a href="#" class="pull-right">
                                      <i class="fa fa-heart-o"></i>
                                    </a>
                                    <a href="#">
                                      <i class="fa fa-plus-circle"></i>
                                    </a>
                                  </div>
                                </div>
                                <a href="#"><img src="images/p1.jpg" alt="" class="r r-2x img-full"></a>
                              </div>
                              <div class="padder-v">
                                <a href="#" class="text-ellipsis">{{ $song->song_name }} by {{ $song->album->artist->artist_name }}</a>
                                <a href="#" class="text-ellipsis text-xs text-muted">{{ $song->album->album_name }}</a>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      @endif
                    </div>
                    <div class="row">
                      <div class="col-md-7">
                        <h3 class="font-thin">New Songs</h3>
                        <div class="row row-sm">

                          @if(isset($newSongs))
                            @foreach($newSongs as $song)
                              <div class="col-xs-6 col-sm-3">
                                <div class="item">
                                  <div class="pos-rlt">
                                    <div class="item-overlay opacity r r-2x bg-black">
                                      <div class="center text-center m-t-n">
                                        <a href="#"><i class="fa fa-play-circle i-2x"></i></a>
                                      </div>
                                    </div>
                                    <a href="#"><img src="images/a2.png" alt="" class="r r-2x img-full"></a>
                                  </div>
                                  <div class="padder-v">
                                    <a href="#" class="text-ellipsis">{{ $song->song_name }}</a>
                                    <a href="#" class="text-ellipsis text-xs text-muted">by {{ $song->album->artist->artist_name }} | {{ $song->album->album_name }}</a>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          @endif

                        </div>
                      </div>
                      <div class="col-md-5">
                        <h3 class="font-thin">Top Songs</h3>
                        <div class="list-group bg-white list-group-lg no-bg auto">    
      
                          @if(isset($topSongs))
                            <?php $index = 1 ?>
                            @foreach($topSongs as $song)
                              <a href="#" class="list-group-item clearfix">
                                <span class="pull-right h2 text-muted m-l">{{ $index }}</span>
                                <span class="pull-left thumb-sm avatar m-r">
                                  <img src="images/a4.png" alt="...">
                                </span>
                                <span class="clear">
                                  <span>{{ $song->song_name }}</span>
                                  <small class="text-muted clear text-ellipsis">by {{ $song->album->artist->artist_name }}</small>
                                </span>
                              </a>
                              <?php $index++ ?>
                            @endforeach
                          @endif

                        </div>
                      </div>
                    </div>
                  </section> 
                </section>
                <footer class="footer bg-dark">
                  <div id="jp_container_N">
                    <div class="jp-type-playlist">
                      <div id="jplayer_N" class="jp-jplayer hide"></div>
                      <div class="jp-gui">
                        <div class="jp-video-play hide">
                          <a class="jp-video-play-icon">play</a>
                        </div>
                        <div class="jp-interface">
                          <div class="jp-controls">
                            <div><a class="jp-previous"><i class="icon-control-rewind i-lg"></i></a></div>
                            <div>
                              <a class="jp-play"><i class="icon-control-play i-2x"></i></a>
                              <a class="jp-pause hid"><i class="icon-control-pause i-2x"></i></a>
                            </div>
                            <div><a class="jp-next"><i class="icon-control-forward i-lg"></i></a></div>
                            <div class="hide"><a class="jp-stop"><i class="fa fa-stop"></i></a></div>
                            <div><a class="" data-toggle="dropdown" data-target="#playlist"><i class="icon-list"></i></a></div>
                            <div class="jp-progress hidden-xs">
                              <div class="jp-seek-bar dk">
                                <div class="jp-play-bar bg-info">
                                </div>
                                <div class="jp-title text-lt">
                                  <ul>
                                    <li></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="hidden-xs hidden-sm jp-current-time text-xs text-muted"></div>
                            <div class="hidden-xs hidden-sm jp-duration text-xs text-muted"></div>
                            <div class="hidden-xs hidden-sm">
                              <a class="jp-mute" title="mute"><i class="icon-volume-2"></i></a>
                              <a class="jp-unmute hid" title="unmute"><i class="icon-volume-off"></i></a>
                            </div>
                            <div class="hidden-xs hidden-sm jp-volume">
                              <div class="jp-volume-bar dk">
                                <div class="jp-volume-bar-value lter"></div>
                              </div>
                            </div>
                            <div>
                              <a class="jp-shuffle" title="shuffle"><i class="icon-shuffle text-muted"></i></a>
                              <a class="jp-shuffle-off hid" title="shuffle off"><i class="icon-shuffle text-lt"></i></a>
                            </div>
                            <div>
                              <a class="jp-repeat" title="repeat"><i class="icon-loop text-muted"></i></a>
                              <a class="jp-repeat-off hid" title="repeat off"><i class="icon-loop text-lt"></i></a>
                            </div>
                            <div class="hide">
                              <a class="jp-full-screen" title="full screen"><i class="fa fa-expand"></i></a>
                              <a class="jp-restore-screen" title="restore screen"><i class="fa fa-compress text-lt"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="jp-playlist dropup" id="playlist">
                        <ul class="dropdown-menu aside-xl dker">
                          <!-- The method Playlist.displayPlaylist() uses this unordered list -->
                          <li class="list-group-item"></li>
                        </ul>
                      </div>
                      <div class="jp-no-solution hide">
                        <span>Update Required</span>
                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                      </div>
                    </div>
                  </div>
                </footer>
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
        $('#createPlaylistModalButton').click(function() {
          createPlaylist($('#createPlaylistModalData').val());
        });

        setPlayingPlaylist(initialPlaylist);

      });
    
      //Javascript Functions
      var token = '{{ csrf_token() }}';

      //TODO: Deal with this if this is null
      var myPlaylist = null;

      @if(isset($lastActivePlaylistContents))
        var initialPlaylist = [
          @foreach($lastActivePlaylistContents as $playlistContent)
            {
              title:"{{ $playlistContent->song->song_name }}",
              artist:"{{ $playlistContent->song->album->artist->artist_name }}",
              mp3:"uploads/{{ $playlistContent->song->file->file_name }}",
              poster:"{{ $playlistContent->song->album->album_image_loc }}"
            },
          @endforeach
        ]
      @else
        var initialPlaylist = null;
      @endif

      function createPlaylist(playlistName) {
        $.post("/api/playlist", { _token: token, playlistName: playlistName })
        .done(function (data) {
          var responseArray = $.parseJSON(data.replace(/\s+/g," "));
          if(responseArray.error == 0) {
            $('#success-notification-message').html(responseArray.message);
            $('#success-notification').show();
            $.get('html-snippets/playlist-list.html', function (data) {
              data = data.replace('%playlistName%', playlistName);
              $('#playlist-list').append(data);
              $('#newly-added-playlist').fadeIn().removeAttr('id');
              loadPlaylistDashboard(playlistName);
            });
          } else {
            $('#error-notification-message').html(responseArray.message);
            $('#error-notification').show();
          }
        });
      }

      function setPlayingPlaylist(playlistContentObject) {
        if(playlistContentObject != null) {
          myPlaylist = new jPlayerPlaylist({
            jPlayer: "#jplayer_N",
            cssSelectorAncestor: "#jp_container_N"
          }, playlistContentObject, {
            playlistOptions: {
              enableRemoveControls: true,
              autoPlay: false
            },
            swfPath: "js/jPlayer",
            supplied: "mp3",
            smoothPlayBar: true,
            keyEnabled: true,
            audioFullScreen: false
          });
        }
      }

      function loadPlaylistDashboard(playlistId) {
        $.get('html-snippets/playlist-page.html')
        .done(function (dashboardContent) {
          setDashboardContent(dashboardContent);
          var responseArray = getPlaylistContents(playlistId);

          $.get('html-snippets/playlist-content.html')
          .done(function (dashboardContent) {
            responseArray = $.parseJSON(responseArray['responseText'].replace(/\s+/g," "));
            if(responseArray.error == 0) {
              playlistContentsArray = responseArray.playlistContentsArray;
              for (var key in playlistContentsArray) {
                if (playlistContentsArray.hasOwnProperty(key)) {
                  var obj = playlistContentsArray[key];
                  $('#playlist-contents').append(
                    dashboardContent
                      .replace('%song_name%', obj['song_name'])
                      .replace('%song_name%', obj['song_name'])
                      .replace('%artist_name%', obj['artist_name'])
                      .replace('%album_image_loc%', obj['album_image_loc'])
                  );
                }
              }
            }
          });
        });
      }

      function getPlaylistContents(playlistId) {
        return $.ajax({
          url: '/api/playlist',
          type: 'GET',
          async: false,
          data: {
            playlistId: playlistId
          }
        }).done(function (data) {
          return data;
        });
      }

      function getPlaylistId(playlistName) {
        //get playlist id from playlist name
        //work on playing songs from play button
        //correct art for song list
      }

      function setDashboardContent(dashboardContent) {
        if(dashboardContent != null) {
          $('#bjax-target').html(dashboardContent);
        }
      }

      $(document).ready(function(){
        $(document).on($.jPlayer.event.pause, myPlaylist.cssSelector.jPlayer,  function(){
          $('.musicbar').removeClass('animate');
          $('.jp-play-me').removeClass('active');
          $('.jp-play-me').parent('li').removeClass('active');
        });

        $(document).on($.jPlayer.event.play, myPlaylist.cssSelector.jPlayer,  function(){
          $('.musicbar').addClass('animate');
        });

        $(document).on('click', '.jp-play-me', function(e){
          e && e.preventDefault();
          var $this = $(e.target);
          if (!$this.is('a')) $this = $this.closest('a');

          $('.jp-play-me').not($this).removeClass('active');
          $('.jp-play-me').parent('li').not($this.parent('li')).removeClass('active');

          $this.toggleClass('active');
          $this.parent('li').toggleClass('active');
          if( !$this.hasClass('active') ){
            myPlaylist.pause();
          }else{
            var i = Math.floor(Math.random() * (1 + 7 - 1));
            myPlaylist.play(i);
          }
          
        })
      });
    </script>
  @stop