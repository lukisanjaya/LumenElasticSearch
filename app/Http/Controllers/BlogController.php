<?php

namespace App\Http\Controllers;

use App\Model\Blog;
use App\Model\ViewBlog;
use Illuminate\Http\Request;
use \Cache;
use App\Helpers\JsonHelper;
use App\Helpers\ElasticHelper;

class BlogController extends Controller
{
    public function showAllBlogs(Request $request)
    {
        $page  = !empty($request->input('page')) ? $request->input('page') : 1;
        $limit = !empty($request->header('limit')) ? $request->header('limit') : 10;

        $value = Cache::remember('home:page='.$page, 0.3, function () use ($limit) {
            $data = ViewBlog::paginate($limit);
            return $data;
        });

        return JsonHelper::collections($data);
    }

    public function showOneBlog($slug)
    {
        $value = ElasticHelper::search('blog', 'slug', $slug);

        return JsonHelper::item($value);
    }

    public function byCategory(Request $request, $slug)
    {
        $page  = !empty($request->input('page')) ? $request->input('page') : 1;
        $limit = !empty($request->header('limit')) ? $request->header('limit') : 10;

        $value = Cache::remember('home:page='.$page, 0.3, function () use ($limit, $slug) {
            $data = ViewBlog::byCategory($slug)->paginate($limit);
            return $data;
        });

        return JsonHelper::collections($value);
    }

    public function create(Request $request)
    {
        $this->rules($request);

        $slug = strtolower(str_slug($request->input('title')));

        $blog = ViewBlog::bySlug($slug)->first();

        if ($blog) :
            $slug = str_slug($blog->title) . '-' . str_random(4);
        endif;

        $created_at = $request->input('created_at') ? $request->input('created_at') : '';
        $updated_at = $request->input('updated_at') ? $request->input('updated_at') : '';
        $data = [
            'category_id' => $request->input('category_id'),
            'title'       => $request->input('title'),
            'slug'        => strtolower($slug),
            'content'     => $request->input('content'),
            'thumbnail'   => $request->input('thumbnail'),
            'created_at'  => $created_at,
            'updated_at'  => $updated_at,
        ];
        $blog = Blog::create($data);

        ElasticHelper::store('blog', $blog);

        return JsonHelper::item($blog);
    }

    public function update(Request $request, $slug)
    {
        $blog = Blog::bySlug($slug)->first();

        if(empty($blog)) :
            return JsonHelper::item($blog);
        endif;

        if ($blog->title != $request->input('title') OR (!empty($request->input('change_slug') && $request->input('change_slug')))) :
            $slug = str_slug($blog->title) . '-' . str_random(4);
        else :
            $slug = $blog->slug;
        endif;

        // if(!empty($request->input('thumbnail'))) :
        
        // else : 

        // endif;

        $created_at = $request->input('created_at') ? $request->input('created_at') : '';
        $updated_at = $request->input('updated_at') ? $request->input('updated_at') : '';
        $data = [
            'category_id' => $request->input('category_id'),
            'title'       => $request->input('title'),
            'slug'        => strtolower($slug),
            'content'     => $request->input('content'),
            'thumbnail'   => $request->input('thumbnail'),
            'created_at'  => $created_at,
            'updated_at'  => $updated_at,
        ];

        $blog->update($data);

        ElasticHelper::store('blog', $blog);

        return JsonHelper::item($blog);
    }

    public function delete($id)
    {
        Blog::findOrFail($id)->delete();
        $res = [
            'message'     => 'Berhasil',
            'status_code' => 200
        ];
        return response()->json($res, 200);
    }

    public function rules($request)
    {
        // $request->file('thumbnail');
        // $request->file('photo')->move($destinationPath, $fileName);

        $rules =  [
            'category_id' => 'required',
            'title'       => 'required|max:255',
            'content'     => 'required',
            'created_at'  => 'nullable|date',
            'updated_at'  => 'nullable|date',
        ];

        // $rules['thumbnail'] = !empty($request->thumbnail) ? 'required' : 'nullable'; 

        $customMessages = [
            'required' => 'Field :attribute tidak boleh kosong.'
        ];

        $this->validate($request, $rules, $customMessages);
    }
}
