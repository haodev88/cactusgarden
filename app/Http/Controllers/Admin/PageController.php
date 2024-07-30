<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Requests\cms\PageRequest;

class PageController extends Controller
{
    private $_rowperpage;

    public function __construct() {
        $this->_rowperpage = config('global.row_per_page');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter',0);
        if ($filter == 1) {
            $name = $request->get('name',null);
            $code = $request->get('code',null);
            $page = new Page();
            if ($name!=null) {
                $page = $page->where('name','like', '%'.$name.'%');
            }
            if ($code!=null) {
                $page = $page->where('code', $code);
            }
            $page = $page->orderBy('id','DESC')->paginate($this->_rowperpage);
            $data['list'] = $page;
        } else {
            $data["list"] = Page::orderBy('id','DESC')->paginate($this->_rowperpage);
        }
        $page = $request->get('page',0);
        $data["stt"]  = ($page!=0) ? ($page-1)*$this->_rowperpage : $page;
        return view('cms.page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        Page::create([
            'name'    => $request->get('name'),
            'slug'    => ($request->get('slug') == '') ? str_slug($request->get('name')) : $request->get('slug'),
            'code'    => $request->get('code'),
            'content' => $request->get('content'),
            'status'  => $request->get('status'),
        ]);
        return Redirect()->route('admin_shop.page.index')->with("Success", "Dữ liệu được thêm thành công");
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
        $data["page"] = Page::find($id);
        return view("cms.page.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $params = $request->all();
        unset($params["_token"]);
        unset($params["_method"]);
        Page::where("id", $id)->update($params);
        return Redirect()->route('admin_shop.page.index')->with("Success", "Dữ liệu được Cập nhật thành công");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::find($id)->delete();
        return Redirect()->route('admin_shop.page.index')->with("Success", "Dữ liệu đã được xóa khỏi hệ thống");
    }
}
