@extends("layouts.auth")
@section("style")
    <style>
        html, body {
            height: 100%;
            background: linear-gradient(135deg, #eb8abc 0%, #fce9c2 100%);
            background-attachment: fixed;
            min-height: 100vh;
        }

        .form-signin {
            max-width: 400px;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(235, 138, 188, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin: 2rem auto;
        }


        .logo-section img {
            width: 80px;
            height: 85px;
            border-radius: 50%;
            padding: 12px;
            background: linear-gradient(135deg, #eb8abc, #d671a3);
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.3);
            margin-bottom: 1rem;
        }


        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-floating .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            background: #fafafa;
            height: 3.5rem;
            font-size: 1rem;
        }

        .form-floating .form-control:focus {
            border-color: #eb8abc;
            box-shadow: 0 0 0 0.2rem rgba(235, 138, 188, 0.15);
            background: white;
        }

        .form-floating label {
            color: #6c757d;
            font-weight: 500;
        }

        .form-floating .form-control:focus ~ label,
        .form-floating .form-control:not(:placeholder-shown) ~ label {
            color: #eb8abc;
        }

        .btn-primary {
            background: linear-gradient(135deg, #eb8abc, #d671a3);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 4px 15px rgba(235, 138, 188, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #d671a3, #eb8abc);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(235, 138, 188, 0.4);
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(235, 138, 188, 0.5);
        }


        .text-danger {
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .login-link {
            display: block;
            text-align: center;
            color: #eb8abc;
            text-decoration: none;
            font-weight: 600;
            margin-top: 1.5rem;
            padding: 0.75rem;
            border-radius: 8px;
        }

        .login-link:hover {
            color: #d671a3;
            background: rgba(235, 138, 188, 0.1);
            text-decoration: none;
        }


        /* Mobile Responsive */
        @media (max-width: 576px) {
            .form-signin {
                margin: 1rem;
                padding: 1.5rem;
                max-width: none;
            }

            .welcome-title {
                font-size: 1.5rem;
            }

            .logo-section img {
                width: 70px;
                height: 75px;
            }

            .form-floating .form-control {
                font-size: 16px; /* Prevents zoom on iOS */
            }
        }
    </style>
@endsection

@section("content")
    <main class="form-signin w-100 m-auto">
        <form action="{{route("register.post")}}" method="POST">
            @csrf
            <img class="mb-4" src="{{asset("assets/img/beloved-store.png")}}"
                 alt="" width="92" height="97">
            <h1 class="h3 mb-3 fw-normal">Please Signup</h1>

            <div class="form-floating mb-3">
                <input name="name" type="text" class="form-control"
                       id="floatingName" value="{{ old('name') }}"
                       placeholder="Enter Your Name">
                <label for="floatingName">Enter name</label>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input name="email" type="email" class="form-control"
                       id="floatingEmail" value="{{ old('email') }}"
                       placeholder="name@example.com">
                <label for="floatingEmail">Email address</label>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-3" style="margin-bottom: 10px">
                <input type="password" name="password" class="form-control"
                       id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
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
                Sign up
            </button>
            <a href="{{route('login')}}" class="login-link">
                Login here
            </a>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017-2025</p>
        </form>
    </main>
@endsection
