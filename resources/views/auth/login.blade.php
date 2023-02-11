@extends('auth.template')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card-group d-block d-md-flex row">
                <div class="card  p-4 mb-0">
                    <div class="card-body">
                        <h1>Login</h1>
                        <p class="text-medium-emphasis">Sign In to your account</p>
                        @if(session('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Failed!</strong> Credential not found.
                            <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if(session('err_login_semaphore'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Failed!</strong> Unable to bring you in.
                                <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="post">
                            @csrf
                            <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-person" viewBox="0 0 16 16">
                                  <path
                                      d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                                </svg>
                            </span>
                                <input class="form-control" type="text" name="username" placeholder="Username" autofocus>
                            </div>
                            <div class="input-group mb-4">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-key" viewBox="0 0 16 16">
                                  <path
                                      d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                  <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                            </span>
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary px-4" type="submit">Login</button>
                                </div>
                                <div class="d-flex justify-content-center align-items-center text-muted mt-3">
                                    <span class="line" style="border-bottom: 2px solid rgba(44,56,74,.38);width: 100%;margin: 0 1px 0 20%;"></span>
                                    <span class="text-center px-3">Or</span>
                                    <span class="line" style="border-bottom: 2px solid rgba(44,56,74,.38);width: 100%;margin: 0 20% 0 1px;"></span>
                                </div>
                                <div class="text-center mt-3">
                                    <a class="btn" style="background-color: #ffcc33!important;" role="button" href="{{ route('login', ['with' => 'semaphore']) }}">Login with Semaphore</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
