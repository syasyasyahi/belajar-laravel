@extends('app')
@section('content')
    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>"
    @endif
    @if ($errors->any())
        <div class="color: red">
            <ul>
                @foreach ($errors->all() as $er)
                    <div class="alert aler-warning alert-dismissible fade show mt-2" role="alert">
                        <strong>Alert!</strong> {{ $er }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <label for="" class="form-label">Username</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}">

        <label for="" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

        <label for="" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" value="{{ old('password') }}">

        <button type="submit" class="btn btn-primary mt-2">Create</button>
    </form>
@endsection
