<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use File;

class BlogController extends Controller
{
    private   $_rowperpage;
    protected $_pathStore;
    protected $_pathImage;

    public function __construct(Request $request) {
        $this->_pathStore  = Config('global.path_upload_root').'blogs';
        $this->_rowperpage = Config('global.row_per_page');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input  = $request->all();
        if (isset($input["filter"]) && $input["filter"] == 1) {
            $blog = new Blog();
            if (isset($input["title"]) && $input["title"]!="") {
                $blog = $blog->where("title","like","%".$input["title"]."%");
            }
            if (isset($input["author"]) && $input["author"]!="") {
                $blog = $blog->where("author","like","%".$input["author"]."%");
            }
            $res = $blog->paginate($this->_rowperpage);
        } else {
            $res    = Blog::paginate($this->_rowperpage);
        }
        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0;
        $data['stt']    = $stt;
        $data['blogs']  = $res;
        $data["params"] = $input;
        return view("cms.blog.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cms.blog.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params   = $request->all();
        $fileName = null;
        if (isset($params['image']) && !empty($params['image'])) {
            $file     = $params['image'];
            $fileName = changeFileName($file->getClientOriginalName());
            $file->move($this->_pathStore, $fileName);
        }
        Blog::create([
            "title"     => $params["title"],
            "slug"      => str_slug($params["title"]),
            "author"    => $params["author"],
            "short_desc"=> $params["short_desc"],
            "content"   => $params["content"],
            "image"     => $fileName,
            "active"    => $params["active"]
        ]);

        return Redirect()->route('admin_shop.blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["blog"] = Blog::find($id);
        return view("cms.blog.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        $data = [];
        if (isset($params["txtDeleteImage"]) && $params["txtDeleteImage"]!="") {
            if (File::exists($this->_pathStore.'/'.$params["txtDeleteImage"])) {
                File::delete($this->_pathStore.'/'.$params["txtDeleteImage"]);
            }
            $data["image"] = null;
        }

        if (isset($params["image"])) {
            $file     = $params['image'];
            $fileName = changeFileName($file->getClientOriginalName());
            $file->move($this->_pathStore, $fileName);
            $data["image"] = $fileName;
        }

        $data["title"]   = $params["title"];
        $data["slug"]    = str_slug($params["title"]);
        $data["author"]  = $params["author"];
        $data["short_desc"]=$params["short_desc"];
        $data["content"] = $params["content"];
        $data["active"]  = $params["active"];

        Blog::where("id", $id)->update($data);
        return Redirect()->route('admin_shop.blog.edit',['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            Blog::find($id)->delete();
        }
        return Redirect()->route('admin_shop.blog.index');
    }
}
