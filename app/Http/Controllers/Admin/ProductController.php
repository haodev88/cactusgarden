<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Image;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\cms\ProductAddRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\OptionGroup;
use App\Models\Brand;


class ProductController extends Controller {
    
    private $_rowperpage;
    private $_pathImage;
    private $_pathStore;
    private $_path_delete;
  
    public function __construct(Request $request) {
        $actionName         = getActionName($request);
        if (in_array($actionName,['store','update','delete'])) {
            $this->_pathImage  = config('global.path_image').forderStore($path='mains', $thumbs=true);
            $this->_pathStore  = $this->_pathImage.'/thumbs';
        }
        $this->_rowperpage  = config('global.row_per_page');
        $this->_path_delete = Config('global.path_upload_root').'mains/'; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request) {
        $data['defaultCate'] = 0;
        $input       = $request->all();
        $listProduct = Product::orderBy('id','DESC')->paginate($this->_rowperpage);
        $stt         = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $listCate    = Category::all()->toArray();
        $data['listCate'] = $listCate;
        $data['stt'] = $stt;
        $data['listProduct'] = $listProduct;
        return view('cms.product.list',$data);
    }

    /**
     * Display search data
     *
     * @return \Illuminate\Http\Response
     */
    
    public function search(Request $request) {
        $input  = $request->all();
        $query  = new product();
        $append = [];
        $defaultCate = 0;
        if (isset($input["txtSku"]) && $input["txtSku"]!="") {
            $input["txtSku"] = trim($input["txtSku"]);
            $query  = $query->where("sku",$input['txtSku']);
            $append['txtSku'] = $input['txtSku'];
        }
        if (isset($input["txtName"]) && $input["txtName"]!="") {
            $input["txtName"] = trim($input["txtName"]);
            $query = $query->where("name","like","%".$input['txtName']."%");
            $append['txtName'] = $input['txtName'];
        }
        if (isset($input["sltCategory"]) && $input["sltCategory"]!="") {
            $query = $query->where("dt_category_id",$input['sltCategory']);
            $append['sltCategory'] = $defaultCate = $input['sltCategory'];
        }
        if (isset($input["txtPrice"]) && $input["txtPrice"]!="") {
            $input["txtPrice"] = trim($input["txtPrice"]);
            $query = $query->where("price","like","%".$input['txtPrice']."%");
            $append['txtPrice'] = $input['txtPrice'];
        }
        $res = $query->paginate($this->_rowperpage);
        $stt = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0;
        $listCate    = Category::all()->toArray();
        $data['listCate']    = $listCate;
        $data['defaultCate'] = $defaultCate;
        $data['listProduct'] = $res;
        $data['stt'] = $stt;
        $data["get"] = $input;
        return view('cms.product.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // get data categorys
        $data['listCate']      = Category::all()->toArray();
        // get data suppliers
        $data['listSupplier']  = Supplier::all()->toArray();
        // get data attribute
        $data['listAttribute'] = OptionGroup::with('option')->get()->toArray();
        return view('cms.product.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductAddRequest $request) {
        $input = $request->all();
        unset($input['checkImgDefault']);
        // upload file
        $arrNewFile   = [];
        $defaultImage = null;
        if (isset($input["txtFile"]) && !empty($input["txtFile"][0])) {
            // get config product resize in config global.
            $resizeProduct = Config('global.size_product');
            foreach ($input["txtFile"] as $key => $file) {
                $newFile = changeFileName($file->getClientOriginalName());
                // upload images
                $file->move($this->_pathImage, $newFile);
                $arrNewFile[$key]['image']   = forderStore().'/'.$newFile;
                if ($key == $input['defaultImageMain']) {
                    $arrNewFile[$key]['default'] = 1;
                    $defaultImage = $arrNewFile[$key]['image'];
                } else {
                    $arrNewFile[$key]['default'] = 0;
                    $defaultImage = $arrNewFile[0]['image'];
                }
                // resize image.
                foreach ($resizeProduct as $k => $size) {
                    $outputFile = $size[0].'x'.$size[1].'_'.$newFile;
                    resizeImage($this->_pathImage, $this->_pathStore, $newFile, $outputFile, $size[0], $size[1]);
                }
            }
        }
        // insert product 
        $createProduct = Product::create([
            'dt_category_id'=>$input['sltCategory'],
            'dt_brand_id'=>$input['sltBrand'],
            'dt_supplier_id'=>$input['sltSupplier'],
            'user_id'=>Auth::User()->id,
            'sku'=>$input['txtSku'],
            'name'=>$input['txtName'],
            'slug'=>str_slug($input['txtName']),
            'price'=>$input['txtPrice'],
            'self_price'=>$input['txtPriceSelf'],
            'count'=>$input['txtCount'],
            'default_image'=>$defaultImage,
            'filename'=>!empty($arrNewFile) ? json_encode($arrNewFile) : null,
            'short_desc'=>$input['txtShort'],
            'long_desc'=>$input['txtLong'],
            'active'=>isset($input['checkActive']) ? 1 : 0,
        ]);
        // insert attribute product
        if (isset($input['option_id']) && !empty($input['option_id'])) {
            $insertId = $createProduct->id;
            $p = Product::find($insertId);
            foreach ($input["option_id"] as $key => $item) {
               $p->option()->attach($insertId,['dt_option_id'=>$item]);
            }
        }
        return Redirect()->route('admin_shop.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // get data categorys
        $data['listCate']      = Category::all()->toArray();
        // get data suppliers
        $data['listSupplier']  = Supplier::all()->toArray();
        // get data attribute
        $data['listAttribute'] = OptionGroup::with('option')->get()->toArray();
        // get data product by id
        $p = Product::with(['option'=>function($q) {
            $q->select('id','name');
        }])->find($id)->toArray();
        $data['product']   = $p;
        // get brand by supplier_id
        $b = Supplier::with(['brand'=>function($q) {
            $q->select('id','name');
        }])->select('dt_suppliers.id')->find($p['dt_supplier_id'])->toArray();
        $data['listBrand'] = $b['brand'];
        return view('cms.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->all();
        unset($input['checkImgDefault']);
        // Proccess delete images
        if (isset($input['txtImageDelete']) && !empty($input['txtImageDelete'])) {
            $sizeImage = Config('global.size_product');
            $this->deleteImage($input['txtImageDelete']);
        }
        // upload file
        $arrNewFile   = [];
        $defaultImage = null;
        if (isset($input["txtFile"]) && !empty($input["txtFile"][0])) {
            // get config product resize in config global.
            $resizeProduct = Config('global.size_product');
            foreach ($input["txtFile"] as $key => $file) {
                $newFile = changeFileName($file->getClientOriginalName());
                // upload images
                $file->move($this->_pathImage, $newFile);
                $arrNewFile[$key]['image']   = forderStore().'/'.$newFile;
                // resize image.
                foreach ($resizeProduct as $k => $size) {
                    $outputFile = $size[0].'x'.$size[1].'_'.$newFile;
                    resizeImage($this->_pathImage, $this->_pathStore, $newFile, $outputFile, $size[0], $size[1]);
                }
            }
        }
        // Merage old image and new image
        $finalImage = $arrNewFile;
        if (isset($input['txtOldImage']) && !empty($input['txtOldImage'])) {
            $finalImage = array_merge($input['txtOldImage'],$arrNewFile);
        }
        // find default images in list images
        if (!empty($finalImage)) {
            $defaultImage = $finalImage[0]['image'];
            foreach ($finalImage as $k=>$img) {
                if ($k == $input['defaultImageMain']) {
                    $finalImage[$k]['default'] = 1;
                    $defaultImage = $finalImage[$k]['image'];
                } else {
                    $finalImage[$k]['default'] = 0;
                } 
            }
        }
      
        // update product 
        $createProduct = Product::find($id)->update([
            'dt_category_id'=>$input['sltCategory'],
            'dt_brand_id'=>$input['sltBrand'],
            'dt_supplier_id'=>$input['sltSupplier'],
            'sku'=>$input['txtSku'],
            'name'=>$input['txtName'],
            'slug'=>str_slug($input['txtName']),
            'price'=>$input['txtPrice'],
            'self_price'=>$input['txtPriceSelf'],
            'count'=>$input['txtCount'],
            'default_image'=>$defaultImage,
            'filename'=>!empty($finalImage) ? json_encode($finalImage) : null,
            'short_desc'=>$input['txtShort'],
            'long_desc'=>$input['txtLong'],
            'active'=>isset($input['checkActive']) ? 1 : 0,
        ]);
        // find product by id   
        $p = Product::find($id);
        // Delete attribute product if exists
        if (isset($input['txtDeleteOption']) && !empty($input['txtDeleteOption'])) {
            foreach ($input['txtDeleteOption'] as $key => $oid) {
                $p->option()->detach([$id,$oid]);
            }
        }
        // insert attribute product if exists
        if (isset($input['option_id']) && !empty($input['option_id'])) {
            foreach ($input["option_id"] as $key => $item) {
                $option = $p->option()->where('dt_product_id',$id)->where('dt_option_id',$item)->first();
                if (is_null($option)) {
                    $p->option()->attach($id, ['dt_option_id'=> $item]);
                }
            }
        }
        return Redirect()->route('admin_shop.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $product = Product::findOrfail($id);
        $data    = $product->toArray();
        if (isset($data['filename']) && !empty($data['filename'])) {
            $listImage = convertJsonToArray($data['filename']);
            $this->deleteImage($listImage);
        }
        $product->delete();
        return Redirect()->route('admin_shop.product.index');
    }

    /**
    |------------------------------------------------------------------------
    | Function Delete images product
    |-------------------------------------------------------------------------
    */
    private function deleteImage($filename) {
        $sizeImage = Config('global.size_product');
        foreach ($filename as $img) {
            $file = isset($img['image']) ? $img['image'] : $img; 
            if (File::exists($this->_path_delete.$file)) {
                File::delete($this->_path_delete.$file);
            }
            foreach ($sizeImage as $key => $value) {
                $size   = $value[0].'x'.$value[1];
                $output = sizeOfFileName($file,$size);
                if (File::exists($this->_path_delete.$output["path"].$output['filename'])) {
                    File::delete($this->_path_delete.$output["path"].$output['filename']);
                }
            } 
        }
    }



}
