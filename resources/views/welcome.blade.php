@extends('layouts.index')

@section('Content')
    
<div class="container">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

<div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body ">
                    <h4 class="font-weight-bold text-center"> Daftar Artikel Blog</h4>
                     @if (session('status'))
                        <div class="alert alert-success text-center mt-3">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{--  @include('sweetalert::alert') --}}

                </div>
                <div class="card-body">
                    <table class="table table-striped" id="mytable">
                        <thead>
                          <tr class="text-center">
                            <th scope="col">No.</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Content</th>
                                <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                         @forelse ($blogs as $blog)
                                <tr class="text-center">
                                    <th scope="row">{{ $blog->id }}</th>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/blogs/').$blog->image }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{!! $blog->content !!}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                                            <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Blog belum Tersedia.
                                  </div>
                              @endforelse
                        </tbody>
                      </table>
                    {{ $blogs->links() }}                      
                </div>
            </div>
        </div>
    </div>
</div>


@endsection            