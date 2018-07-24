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
          <form method="post" action="{{route('post.forgot_password')}}">
             {{ csrf_field() }}

            <h1>Forgot Password</h1>

            {{--Username or  Email--}}
            <div>
              @if ($errors->has('login'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('login') }}</strong>
                </span>
              @endif
              <input type="text" class="form-control {{ $errors->has('login') ? ' is-invalid' : '' }}" placeholder="Email" name="login" value="{{old('email')}}"  required />
            </div>

            <div>
              <button type="submit" class="btn btn-default submit" >Submit</button>
            </div>

            <div class="clearfix"></div>

              <div class="clearfix"></div>
              <br>

              <div>
                <p>© 2018 All Rights Reserved. Indonesia Drug Campaign</p>
              </div>
          </form>
        </section>

    </div>
  </div>
  </div>
  </body>
  @include('partials._script')
