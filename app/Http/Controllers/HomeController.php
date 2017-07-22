<?php
/**
 * Created by PhpStorm.
 * User: mrashid
 * Date: 7/15/2017
 * Time: 9:00 PM
 */
namespace App\Http\Controllers;


use App\Models\Category;
use app\Http\Requests\Request;
use App\Models\Post;

class HomeController extends Controller
{

    private $post;

    /**
     * HomeController constructor.
     * @param $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $posts = $this->post->fetchPosts();
        return view('home.index',['posts' => $posts]);
    }

    public function searchPosts(Request $request){

        $searchKey = $request->get('searchKey',null);
        $posts = null;
        $params['searchKey'] = $searchKey;
        $posts = $this->post->fetchPosts($params);
        return view('home.index',['posts' => $posts]);
    }


}