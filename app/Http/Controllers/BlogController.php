<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class BlogController extends Controller
{
    //

    private function is_login()
    {
        if (Auth::user()) {
            return true;
        } else {
            return false;
        }
    }


    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('blog.index', compact('blogs'));
    }

    public function create()
    {
        if ($this->is_login()) {
            return view('blog.create');
        } else {
            return redirect('/login');
        }
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:png,jpg,jpeg',
            'title'     => 'required',
            'content'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/blogs', $image->hashName());

        $blog = Blog::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        if ($blog) {
            //redirect dengan pesan sukses
            return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('blog.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Blog $blog)
    {
        if ($this->is_login()) {
            return view('blog.edit', compact('blog'));
        } else {
            return redirect('/login');
        }
    }

    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required'
        ]);

        //get data Blog by ID
        $blog = Blog::findOrFail($blog->id);

        if ($request->file('image') == "") {

            $blog->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/blogs/' . $blog->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/blogs', $image->hashName());

            $blog->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }

        if ($blog) {
            //redirect dengan pesan sukses
            return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('blog.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
    public function destroy($id)
    {
        if ($this->is_login()) {
            $blog = Blog::findOrFail($id);
            Storage::disk('local')->delete('public/blogs/' . $blog->image);
            $blog->delete();

            if ($blog) {
                //redirect dengan pesan sukses
                return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Dihapus!']);
            } else {
                //redirect dengan pesan error
                return redirect()->route('blog.index')->with(['error' => 'Data Gagal Dihapus!']);
            }
        } else {
            return redirect('/login');
        }
    }

    public function show(string $id)
    {
        //get blog by ID
        $blog = Blog::findOrFail($id);

        //render view with blog
        return view('blog.show', compact('blog'));
    }

    public function showAdmin()
    {
        if ($this->is_login()) {
            $blogs = Blog::latest()->paginate(10);
            return view('admin', compact('blogs'));
        } else {
            return redirect('/login');
        }
    }
}
