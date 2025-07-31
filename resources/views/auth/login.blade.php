@extends("layouts.auth")
@section("style")
    <style>
        html,
        body {
            height: 100%;
        }
        .form-signin {
            max-width: 330px;
            padding:1rem;
        }
        .form-signin .form-floating:focus-within {
            z-index:2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
@endsection

@section("content")
    <main class="form-signin w-100 m-auto">
        <form action="{{route("login.post")}}" method="POST">
            @csrf
            <img class="mb-3" src="{{asset("assets/img/beloved-store.png")}}"
                 alt="" width="92" height="97">
            <h1 class="h3 mb-3 fw-normal">Please Sign in</h1>

            <div class="form-floating mb-3">
            <input name="email" type="email" class="form-control"
                    id="floatingInput"
                    placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>

            <div class="form-floating" style="margin-bottom: 10px">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-check text-start my-3">
                <input name="rememberme" type="checkbox" class="form-check-input" value="remember-me" id="flexCheckDefault">
                <label for="flexCheckDefault" class="form-check-label">
                    Remember me
                </label>
            </div>
            @if(session()->has("success"))
                <div class="alert alert-success">
                    {{session()->get("success")}}
                </div>
            @endif
            @if(session("error"))
                <div class="alert alert-danger">
                {{session("error")}}
                </div>
            @endif
            <button class="btn btn-primary w-100 py-2" type="submit">
                Sign in
            </button>
            <a href="{{route('register')}}" class="text-center">
                Create new Account
            </a>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017-2025</p>
        </form>
    </main>
@endsection
