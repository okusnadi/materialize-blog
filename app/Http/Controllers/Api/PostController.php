<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    /**
     * PostRepository.
     * @var App\Repositories\PostRepository
     */
    protected $post;

    /**
     * PostController constructor.
     * @param App\Repositories\PostRepository $post
     */
    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    /**
     * Get all posts.
     * @param Illuminate\Http\Request $request
     */
    public function all(Request $request)
    {
        $posts = $this->post->all($request->input('limit', 8));
        return response()->json($posts);
    }
    
    /**
     * Get post by slug.
     * @param string $slug
     */
    public function getBySlug($slug)
    {
        $post = $this->post->getByColumn('slug', $slug);
        if (is_null($post)) {
            return resposne()->json(['error' => POST_NOT_FOUND, 'message' => tran('post_not_found')]);
        } else {
            return response()->json($post);
        }
    }
}