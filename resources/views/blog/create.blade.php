@extends('layouts.index')

@section('Content')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card border-0 shadow rounded">
                <div class="card-header text-center">
                    <strong>Tambah Data Artikel</strong>
                </div>
                <div class="card-body ">
                <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
            
                    <div class="form-group">
                        <label for="image">GAMBAR</label>
                        <input type="file"
                                name="image"
                                value="{{ old('image')}}"
                                accept="img/*"
                                class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                <div class="text-muted">{{ $message }}</div>
                                @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text"
                                name="title"
                                value="{{ old('title')}}"
                                class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                <div class="text-muted">{{ $message }}</div>
                                @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="content">Konten</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="8" placeholder="Masukkan Konten Blog">{{ old('content') }}</textarea>
                                @error('content')
                                <div class="text-muted">{{ $message }}</div>
                                @enderror
                    </div>
            
                    <div class="form-group">
                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        <a href="{{ route('blog.index') }}" class="btn btn-sm btn-secondary">KEMBALI</a>                        
                    </div>
                </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection
