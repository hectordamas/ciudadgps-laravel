<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Atag;
use Auth;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::orderBy('id', 'desc')->paginate(9);
        return view('public.articles.index', [
            'articles' => $articles
        ]);
    }

    public function list(){
        $articles = Article::orderBy('id', 'desc')->get();

        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    public function show($slug){
        $article = Article::where('slug', $slug)->first();
        $recentArticles = Article::where('id', '!=', $article->id)->latest()->take(3)->get();
        $relatedArticles = [];
        if ($article->atags->count() > 0) {
            $tags = $article->atags->pluck('id');
            $relatedArticles = Article::whereHas('atags', function($query) use ($tags) {
                $query->whereIn('atags.id', $tags);
            })
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(2)
            ->get();
        } else {
            $relatedArticles = Article::inRandomOrder()
                ->where('id', '!=', $article->id)
                ->take(2)
                ->get();
        }
        $previousArticle = Article::where('id', '<', $article->id)->orderBy('id', 'desc')->first();
        $nextArticle = Article::where('id', '>', $article->id)->orderBy('id', 'asc')->first();
        $tags = Atag::all();

        return view('public.articles.show', [
            'article' => $article,
            'recentArticles' => $recentArticles,
            'relatedArticles' => $relatedArticles,
            'previousArticle' => $previousArticle,
            'nextArticle' => $nextArticle,
            'tags' => $tags
        ]);
    }

    public function create(){
        $tags = Atag::all();
        return view('articles.create', [
            'tags' => $tags
        ]);
    }

    public function store(Request $request){
        $article = new Article();
        $article->title = $request->title;
        $article->slug = $request->slug;
        $article->content = $request->content;
        $article->excerpt = $request->excerpt;
        $article->user_id = Auth::id();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = public_path(). '/articles/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/articles/'. $fileName;
            $article->image = $fileUri;
        }
        $article->save();

        if ($request->filled('tags')) {
            $tags = $request->tags;
            foreach ($tags as $tagName) {
                $tag = Atag::firstOrCreate(['name' => $tagName]);
                $article->atags()->attach([$tag->id]);
            }
        }

        return redirect('/articles/'. $article->id .'/edit')->with('message', 'Articulo Creado con exito');
    }

    public function edit($id){
        $article = Article::find($id);
        $tags = Atag::all();
        return view('articles.edit', [
            'tags' => $tags,
            'article' => $article
        ]);
    }

    public function update($id, Request $request) {
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->slug = $request->slug;
        $article->content = $request->content;
        $article->excerpt = $request->excerpt;
        $article->user_id = Auth::id();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = public_path(). '/articles/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/articles/'. $fileName;
            $article->image = $fileUri;
        }
        $article->save();
    
        $article->atags()->detach();
    
        if ($request->filled('tags')) {
            $tags = $request->tags;
            foreach ($tags as $tagName) {
                $tag = Atag::firstOrCreate(['name' => $tagName]);
                $article->atags()->attach([$tag->id]);
            }
        }

        return redirect()->back()->with('message', 'Articulo Modificado con exito');
    }

    public function search(Request $request){
        $search = $request->input('search');

        $articles = Article::where('title', 'LIKE', "%$search%")
        ->orWhere('content', 'LIKE', "%$search%")
        ->paginate(9);

        return view('public.articles.search', [
            'articles' => $articles,
            'search' => $search
        ]);
    }

    public function tags($id){
        $tag = Atag::findOrFail($id);

        // Obtén los artículos relacionados con la etiqueta por su ID
        $articles = $tag->articles()->paginate(9);

        return view('public.articles.tags', [
            'articles' => $articles,
            'tag' => $tag
        ]);
    }

}
