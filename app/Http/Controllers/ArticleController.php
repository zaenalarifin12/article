<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(10);
        return response()->json($articles);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'creator' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $article = new Article;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->creator = $request->creator;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);
            $article->image = $imageName;
        }

        $article->save();

        // Dispatch event to rebuild article cache here

        return response()->json(['message' => 'Article created successfully']);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return response()->json($article);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'creator' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->creator = $request->creator;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);
            $article->image = $imageName;
        }

        $article->save();

        // Dispatch event to rebuild article cache here

        return response()->json(['message' => 'Article updated successfully']);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        // Dispatch event to rebuild article cache here

        return response()->json(['message' => 'Article deleted successfully']);
    }
}
