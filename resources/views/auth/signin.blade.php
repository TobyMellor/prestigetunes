@extends('template.master')
@section('title', 'Sign In')
@section('main')
<body class="bg-info dker">
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
  <section id="sign-in" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xl">
      <a class="navbar-brand block" href="index.html"><span class="h1 font-bold">Musik</span></a>
      <section class="m-b-lg">
        <header class="wrapper text-center">
          <strong>Sign in to get started</strong>
        </header>
        <form action="login" method="POST">
          <div class="form-group">
            <input type="email" name="email" placeholder="Email" class="form-control rounded input-lg text-center no-border">
          </div>
          <div class="form-group">
             <input type="password" name="password" placeholder="Password" class="form-control rounded input-lg text-center no-border">
          </div>
          <input name="_token" value="<?php echo csrf_token(); ?>" hidden>
          <button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">Sign in</span></button>
          <div class="text-center m-t m-b"><a href="#"><small>Forgot password?</small></a></div>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Do not have an account?</small></p>
          <a class="btn btn-lg btn-info btn-block rounded" id="button-switch-to-sign-up">Create an account</a>
        </form>
      </section>
    </div>
  </section>
  <section id="sign-up" class="m-t-lg wrapper-md animated fadeInDown" style="display:none;">
    <div class="container aside-xl">
      <a class="navbar-brand block" href="index.html"><span class="h1 font-bold">Musik</span></a>
      <section class="m-b-lg">
        <header class="wrapper text-center">
          <strong>Sign up to join our community</strong>
        </header>
        <form action="register" method="POST">
          <div class="form-group">
            <input type="email" name="email" placeholder="Email" class="form-control rounded input-lg text-center no-border">
          </div>
          <div class="form-group">
            <input type="text" name="name" placeholder="Your Name" class="form-control rounded input-lg text-center no-border">
          </div>
          <div class="form-group">
             <input type="password" name="password" placeholder="Password" class="form-control rounded input-lg text-center no-border">
          </div>
          <div class="form-group">
             <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control rounded input-lg text-center no-border">
          </div>
          <div class="checkbox i-checks m-b">
            <label class="m-l">
              <input type="checkbox" checked="false"><i></i> Agree the <a href="#">terms and policy</a>
            </label>
          </div>
          <input name="_token" value="<?php echo csrf_token(); ?>" hidden>
          <button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">Sign up</span></button>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Already have an account?</small></p>
          <a class="btn btn-lg btn-info btn-block btn-rounded" id="button-switch-to-sign-in">Sign in</a>
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>PrestigeTunes<br>&copy; 2015</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  @stop

  @section('scripts')
  <script>
    //jQuery Element Events
    $(document).ready(function() {

      $('#button-switch-to-sign-in').click(function() {
        switchForms('sign-in');
      });
      $('#button-switch-to-sign-up').click(function() {
        switchForms('sign-up');
      });

    });
  
    //Javascript Functions
    var token = '<?php echo csrf_token(); ?>';

    function switchForms(switchTo) {
      if(switchTo == 'sign-in') {
        $('#sign-up').hide();
        $('#sign-in').show();
      } else {
        $('#sign-in').hide();
        $('#sign-up').show();
      }
    }
  </script>
  @stop