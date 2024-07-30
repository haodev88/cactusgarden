<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use File;
use App\Http\Requests;
use App\Http\Controllers\Controller;
// use Illuminate\Routing\Route;
use App\Models\Banner;
use App\Models\BannerPosition;

class BannerController extends Controller {

    private $_rowperpage;
    private $_pathStore;

    public function __construct(Request $request) {
        $this->_pathStore  = Config('global.path_upload_root').'banners';
        $this->_rowperpage = Config('global.row_per_page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $input  = $request->all();
        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0;
        $data["listBannerPosition"] = BannerPosition::paginate($this->_rowperpage);
        $data['stt'] = $stt;
        return view('cms.banner.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $list = BannerPosition::with('banner')->find($id)->toArray();
        $data['list'] = $list;
        $data['id']   = $id;
        $data['path'] = $this->_pathStore;
        return view('cms.banner.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function upload(Request $request) {
        $input    = $request->all();
        if (isset($input['file']) && !empty($input['file'])) {
            foreach ($input['file'] as $key=>$item) {
                $fileName = changeFileName($item->getClientOriginalName());
                $item->move($this->_pathStore,$fileName);
                Banner::create([
                    'banner_position_id' => $input['position_id'],
                    'link'               => (isset($input['txtLink'][$key]) && $input['txtLink'][$key]!='') ? $input['txtLink'][$key] : null,
                    'source'             => $fileName,
                    'desc'               => $input['desc'],
                ]);
            }
        }
    }

    public function clear($id,Request $request) {
        $id     = (INT)$id;
        $position_id = $request->get('position_id');
        $banner = Banner::find($id);
        $item   = $banner->toArray();
        if ($banner) {
            if (File::exists($this->_pathStore.'/'.$item['source'])) {
                File::delete($this->_pathStore.'/'.$item['source']);
            }
            $banner->delete();
        }
        return redirect()->route('admin_shop.banner.show',['id'=>$position_id]);

    }

    public function updateDataBanner(Request $request) {
        $params = $request->all();
        $data   = [];
        $id     = $params["id_banner"];

        if (isset($params['img_banner']) && !empty($params['img_banner'])) {
            $file     = $params['img_banner'];
            $fileName = changeFileName($file->getClientOriginalName());
            $file->move($this->_pathStore, $fileName);
            // remove old image
            if (File::exists($this->_pathStore.'/'.$params["old_banner"])) {
                File::delete($this->_pathStore.'/'.$params["old_banner"]);
            }
            $data["source"] = $fileName;
        }

        if ($id) {
            $data["link"] = $params["link_edit"];
            $data["desc"] = $params["desc_edit"];
            Banner::where("id", $id)->update($data);
        }

        return redirect()->route('admin_shop.banner.show',['id'=>$params["position_id"]]);
    }

}
