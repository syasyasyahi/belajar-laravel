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
    <form action="{{ route('category.update', $edit->id) }}" method="post">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" class="form-control" name="category_name" value="{{ $edit->category_name ?? '' }}"
                required placeholder="Enter your category name">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Save Change</button>
    </form>
@endsection
