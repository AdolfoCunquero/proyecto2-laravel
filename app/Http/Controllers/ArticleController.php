<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Response;
use DateTime;

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

    public function getArticleActive($category_id)
    {
        if($category_id == 0)
        {
            return Article::join("categories","categories.category_id","articles.category_id")
                                ->select('articles.article_id',"articles.category_id","articles.article_name","articles.description","articles.price","articles.image_path")
                                ->where("categories.is_active","=","1")
                                ->where("articles.is_active","=","1")
                                ->get();
        }
        else
        {
            return Article::join("categories","categories.category_id","articles.category_id")
                            ->select('articles.article_id',"articles.category_id","articles.article_name","articles.description","articles.price","articles.image_path")
                            ->where("categories.is_active","=","1")
                            ->where("articles.is_active","=","1")
                            ->where("categories.category_id","=",$category_id)
                            ->get();
        }

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
            //$datos_articulo['image_path'] = $request->file('image')->store('uploads','public');
            $fecha = new DateTime();
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $new_filename = "img-".$fecha->getTimestamp().".".pathinfo($filename, PATHINFO_EXTENSION);
            $file->storeAs('products/', $new_filename, 's3');
            $datos_articulo['image_path'] = $new_filename;
        }
        $article = Article::create($datos_articulo);
        return $article;
       
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
            $fecha = new DateTime();
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $new_filename = "img-".$fecha->getTimestamp().".".pathinfo($filename, PATHINFO_EXTENSION);
            $file->storeAs('products/', $new_filename, 's3');
            $datos_articulo['image_path'] = $new_filename;

            $request->merge([
                'image_path' => $new_filename,
            ]);

            Storage::disk('s3')->delete('products/'.$article_updated["image_path"]);
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
        Storage::disk('s3')->delete('products/'.$article_deleted["image_path"]);
        $article_deleted -> delete($id);
        return $article_deleted;
    }

    public function download(Request $request, $file_name)
    {
        // //return Storage::download("public\\uploads\\".$file_name);
        // $path = storage_path('app/public/uploads/' . $file_name);

        // if (!File::exists($path)) 
        // {
        //     abort(404);
        // }
        // $file = File::get($path);
        // $type = File::mimeType($path);
        // $response = Response::make($file, 200);
        // $response->header("Content-Type", $type);
        // return $response;

        return Storage::disk(name:'s3')->response(path:'products/'.$file_name);
    }
}
