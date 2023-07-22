@extends('layouts.index')

@section('Content')
    
<div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('storage/blogs/'.$blog->image) }}" class="w-100 rounded">
                        <hr>
                        <h4>{{ $blog->title }}</h4>
                        <p class="tmt-3">
                            {!! $blog->content !!}
                        </p>
                    </div>
                </div>
                <a href="{{ route('blog.index') }}" class="btn btn-sm btn-secondary">KEMBALI</a>                
            </div>
        </div>
    </div>

@endsection
