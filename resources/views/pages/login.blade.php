@include('partials._head')

  <body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">

      {{--Login Form--}}
      <div class="form login_form">
        @include('components._warnings')
        <section class="login_content">
          <form method="post" action="{{route('post.login')}}">
             {{ csrf_field() }}

            <h1>Login Form</h1>

            {{--Username or  Email--}}
            <div>
              @if ($errors->has('login'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('login') }}</strong>
                </span>
              @endif
              <input type="text" class="form-control {{ $errors->has('login') ? ' is-invalid' : '' }}" placeholder="Username or Email" name="login" value="{{old('phonenumber')}}"  required />
            </div>

            {{--Password--}}
            <div>
              @if ($errors->has('password'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
              <input type="password" class="form-control {{ $errors->has('login') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required/>
            </div>

            <div>
              <button type="submit" class="btn btn-default submit" href="index.html">Log in</button>
              <a class="reset_pass" href="{{route('forgot_password')}}">Lost your password?</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">New to site?
                <a href="{!! url('/signup') !!}"> Create Account </a>
              </p>

              <div class="clearfix"></div>
              <br />

              <p class="change_link">
                <a href="{{route('guest.event')}}"> Login as Guest </a>
              </p>

              <div class="clearfix"></div>
              <br />

              <div>
                <p>© 2018 All Rights Reserved. Indonesia Drug Campaign</p>
              </div>
            </div>
          </form>
        </section>

    </div>
  </div>
  </div>
  </body>
  @include('partials._script')
