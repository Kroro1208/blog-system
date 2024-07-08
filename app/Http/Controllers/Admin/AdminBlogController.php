<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    public function index()
    {
        // $blogs = Blog::latest('updated_at')->limit(10)->get();
        $blogs = Blog::latest('updated_at')->paginate(10);

        return view('admin.blogs.index', ['blogs' => $blogs]);
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(StoreBlogRequest $request)
    {
        $saveImagePath = $request->file('image')->store('blogs', 'public');
        $blog = new Blog($request->validated());
        $blog->image = $saveImagePath;
        $blog->save();

        // $validated = $request->validated();
        // $validated['image'] = $request->file('image')->store('blogs', 'public');
        // Blog::create($validated);

        return to_route('admin.blogs.index')->with('success', '記事が投稿されました');
    }

    public function edit(Blog $blog)
    {
        // $blog = Blog::find($id);
        return view('admin.blogs.edit', ['blog' => $blog]);
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $updatedDate = $request->validated();
        if ($request->hasFile('image')) {
            $saveImagePath = $request->file('image')->store('blogs', 'public');
            $updatedDate['image'] = $saveImagePath;

            $blog->update($updatedDate);
        }

        return to_route('admin.blogs.index')->with('success', '記事が更新されました');
    }

    // public function update(UpdateBlogRequest $request,  string $id)
    // {
    //     $blog = Blog::findOrFail($id);
    //     $updatedData = $request->validated();
    //     if ($request->hasFile('image')) {
    //         // 変更前の画像を削除
    //         Storage::disk('public')->delete($blog->image);
    //         $updatedDate['image'] = $request->file('image')->store('blogs', 'public');

    //         $blog->update($updatedDate);
    //     }

    //     return to_route('admin.blogs.index')->with('success', '記事が更新されました');
    // }

    public function destroy(Blog $blog) // $id
    {
        // $blog = Blog::findOrFail($id);
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return to_route('admin.blogs.index')->with('success', '記事が削除されました');
    }
}
