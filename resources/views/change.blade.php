<!-- @extends('layout.main2')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card my-5">
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                <form class="card-body cardbody-color p-lg-5" action="{{route('update_password')}}" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <h1 class="text-center">Change Your Password</h1>
                    <div class="text-center">
                        <img src="/assets/img/logo-tb-nobg.png"
                            class="img-fluid my-3" width="200px"
                            alt="profile">
                    </div>

                    <div class="mb-3">
                        <input type="password" name="old_password" class="form-control" id="old_password" aria-describedby="emailHelp"
                            placeholder="Old Password">
                            @error('old_password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" id="password" aria-describedby="emailHelp"
                            placeholder="New Password">
                    </div>
                    @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="mb-3">
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                        <a href="" class="text-dark">
                        </a>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-color px-5 mb-5 w-100 ">Login</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection -->