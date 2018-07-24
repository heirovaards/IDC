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
          <form method="post" action="{{route('post.reset_password')}}">
             {{ csrf_field() }}

            <h1>Reset Password</h1>

            {{-- Password --}}
            <div>
              @if ($errors->has('password'))
                <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                          </span>
              @endif
              <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" id="password" name="password"  required />
              <input type="hidden" name="token" value="{{$token}}" />
            </div>

            {{-- Confirm Password --}}
            <div>
              @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
              @endif
              <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" required />
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
