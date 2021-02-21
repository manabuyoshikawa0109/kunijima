@push('links')
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="/user/plugins/deskapp/vendors/styles/core.css">
<link rel="stylesheet" type="text/css" href="/user/plugins/deskapp/vendors/styles/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="/user/plugins/deskapp/vendors/styles/style.css">
@endpush

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="login-box bg-white box-shadow border-radius-10">
                <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="login-title">
                    <h2 class="text-center text-primary">予約システムへログイン</h2>
                </div>
                <form action="#" method="post">
                    <div class="select-role">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn active">
                                <input type="radio" name="options" id="user">
                                <div class="icon"><i class="fas fa-users fa-2x"></i></div>
                                利用者として
                                <span>ログイン</span>
                            </label>
                            <label class="btn">
                                <input type="radio" name="options" id="admin">
                                <div class="icon"><i class="fas fa-users-cog fa-2x"></i></i></div>
                                管理者として
                                <span>ログイン</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="input-group custom m-0">
                            <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="kunijima@gmail.com">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="far fa-envelope"></i></i></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <div class="input-group custom m-0">
                            <input type="password" class="form-control form-control-lg" name="password" placeholder="**********">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row pb-30">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label small" for="remember">ログイン状態を<br>保持する</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="forgot-password small"><a href="#">パスワードをお忘れですか？</a></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group mb-0">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">ログイン</button>
                            </div>
                            <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
                            <div class="input-group mb-0">
                                <a class="btn btn-outline-primary btn-lg btn-block" href="#">利用者登録をする</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- js -->
<script src="/user/plugins/deskapp/vendors/scripts/core.js"></script>
<script src="/user/plugins/deskapp/vendors/scripts/script.min.js"></script>
<script src="/user/plugins/deskapp/vendors/scripts/process.js"></script>
<script src="/user/plugins/deskapp/vendors/scripts/layout-settings.js"></script>
@endpush
