<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return $articles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $datos_articulo = request()->except('image');
        if($request->hasFile('image'))
        {
            $datos_articulo['image_path'] = $request->file('image')->store('uploads','public');
        }
        $article = Article::insert($datos_articulo);
        return $datos_articulo;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article, $id)
    {
        $article_updated = Article::find($id);

        if($request->hasFile('image'))
        {
            $image_path = $request->file('image')->store('uploads','public');

            $request->merge([
                'image_path' => $image_path,
            ]);

            Storage::delete("public\\".$article_updated["image_path"]);
            
        }
    
        $article_updated ->update($request->except('image','_method'));
        return $article_updated;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function delete(Request $request, $id)
    {
        $article_deleted = Article::find($id);
        Storage::delete("public\\".$article_deleted["image_path"]);
        $article_deleted -> delete($id);
        return $article_deleted;
    }

    public function download(Request $request, $file_name)
    {
        //return Storage::download("public\\uploads\\".$file_name);
        $path = storage_path('app\\public\\uploads\\' . $file_name);

        //return $path;

        // if (!File::exists($path)) 
        // {
        //     abort(404);
        // }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
