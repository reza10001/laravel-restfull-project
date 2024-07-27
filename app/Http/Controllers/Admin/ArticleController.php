<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Article\ArticlesListApiResource;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $articles = Article::with('user:id,first_name')->get();

       $articles = Article::with('user')->get();
       return ArticlesListApiResource::collection($articles);
    }

}
