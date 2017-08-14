@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <div class="alert alert-danger alert-dismissable hidden" id="error-login-feedback">
                        <p style="text-align: center"></p>
                    </div>
                    <form class="form-horizontal" id="form-login" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#form-login').on('submit', function(event){
                event.preventDefault();
                var _this = $(this);
                $.ajax({
                    url     : _this.attr('action'),
                    type    : _this.attr('method'),
                    data    : new FormData(_this[0]),
                    processData : false,
                    contentType : false,
                    success : function(response){
                        console.log(response);
                        if(response.status === 'error'){
                            var error_message = response.message;
                            $('#error-login-feedback').removeClass('hidden').children('p').text(error_message);
                        } else {
                            localStorage.setItem('user.logged.id', response.data.user_id);
                            localStorage.setItem('user.role.id', response.data.role_id);
                            window.location = response.data.redirect;
                        }
                    },
                    error   : function(error){
                        return console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
