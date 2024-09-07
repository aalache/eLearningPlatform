<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'content' => ['required'],
            'image' => 'required|file|mimes:jpg,jpeg,png,JPG,PNG|max:2048',
        ]);



        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move('upload/blogs', $imageName);
        }

        Blog::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blogs.show', ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blogs.edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'content' => ['required'],
            'image' => 'file|mimes:jpg,jpeg,png,JPG,PNG|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageName = time() . '_' . $image->getClientOriginalName(); // Unique name to avoid conflicts
            $image->storeAs('public/upload/blogs', $imageName); // Store in storage folder
            if ($blog->image) {
                $oldImagePath = public_path('upload/blogs/' . $blog->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
        } else {
            $image = $blog->image;
        }

        // dd($image);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image,
        ]);

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {

        //
    }
}
