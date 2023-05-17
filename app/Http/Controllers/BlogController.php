<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\blog_category;

class blogController extends Controller
{
    public function index(Request $request)
    {
        $cat = $request->cat;
        if($cat){
            $category = blog_category::where('slug',$cat)->first();
            $carName = $category->name;
            return blog::where('Category',$carName)->get();
        }

        return blog::all();
    }
    public function updateblog(Request $request)
    {

        $id = $request->id;
        $data = $request->except(['Images']);

        $ImagesCount =  count(explode(';',$request->Images));


            if($ImagesCount>1){
                $data['Images'] =  fileupload($request->Images,"blogs/",200,250);
            }

        if($id){
            $blog = blog::find($id);
            return $blog->update($data);
        }
        return blog::create($data);


    }
        public function getblog(Request $request,$id)
        {
           $blogs =  blog::find($id);
           $data = $blogs;
           $data['Images'] =  asset($data->Images);
           return $data;
        }
        public function deleteblog(Request $request,$id)
        {
           $blog =  blog::find($id);
           return $blog->delete();
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['form_type'] = 'new';

        $table =  DB::getSchemaBuilder()->getColumnListing('blogs');
        $row = [];
        foreach ($table as $rowname) {
            $row[$rowname] = '';
        };

        $rows = json_decode(json_encode($row));

        $cat = blog_category::all();

        return view('dashboard/blogs/posts.add',compact('rows','cat'),$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->except(['_token']);
        blog::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(blog $blog)
    {
        $rows =  $blog;

        return view('dashboard/blogs/posts.view',compact('rows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(blog $blog)
    {
        $cat = blog_category::all();

        $rows =  $blog;
        $data['form_type'] = 'edit';
        return view('dashboard/blogs/posts.add',compact('rows','cat'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, blog $blog)
    {
        $data = request()->except(['_token','_method']);
        $blog->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(blog $blog)
    {
        $blog->delete();
    }
}
