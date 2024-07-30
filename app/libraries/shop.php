<?php
    /**
     * @param $data [array]
     * @description : submenu recursive menu
     * @param int $parentId
     * @author : wallace.hao
     * @return string html
     */
    function navMenu($data, $parentId=0) {
        $html = '';
        if (isset($data[$parentId])) {
            foreach ($data[$parentId] as $key=>$item) {
                $id       = $item["id"];
                $property_menu = json_decode($item['property'],true);
                $property = $property_menu['a_property'];
                $li_class = $property_menu['li_class'];
                $icon_sub = $property_menu['icon_sub'];
                if (isset($data[$id]) && !empty($data[$id])) {
                    $html.=
                    '<li class="'.$li_class.'">
                        <a href="'.route('product',['alias'=>$item['slug']]).'" '.$property.'>'.$item['title'].'
                            '.$icon_sub.'
                        </a>';
                    $sub = navMenu($data,$id);
                    if ($sub!='' && $sub!="<li></li>") {
                        $html.=
                        '<ul class="dropdown-menu">
                            '.$sub.'  
                        </ul>';
                    }
                    $html.='</li>';
                } else {
                    $html.= '<li><a href="'.route('product',['alias'=>$item['slug']]).'">'.$item['title'].'</a></li>';
                }
            }
        }
        return $html;
    }


    function getArrayImg($string) {
        $reslut = [];
        if ($string!="") {
            $reslut = json_decode($string,true);
        }
        return $reslut;
    }

    
    function subMenu($data, $parentId=0,$alias) {
        $html = '';
        if (isset($data[$parentId])) {
            foreach ($data[$parentId] as $key=>$item) {
                $id = $item["id"];
                $item['slug'] = rtrim($item['slug'],"/");
                if (isset($data[$id])) {
                    $class="";
                    if ($alias == $item['slug']) {
                        $class.= " active";
                    }
                    if ($parentId == 0) {
                        $class.= " first-item";
                    }
                    $html.='<li class="list-group-item'.$class.'"><a class="dropdown-toggle" href="'.route('product',['alias'=>$item['slug']]).'">'.$item['title'].' </a>';
                    $sub = subMenu($data,$id,$alias);
                    if ($sub!="<ul></ul>" && $sub!="") {
                        $html.=
                        '<ul style="display: none;">
                            <li class="list-group-item">'.$sub.'</li>
                        </ul>';
                    }
                    $html.='</li>';
                } else {
                    $active = "";
                    if ($alias == $item['slug']) {
                        $active = " active";
                    }
                    $html.='<li class="list-group-item'.$active.'" data-slug="'.$item['slug'].'"><a href="'.route('product',['alias'=>$item['slug']]).'">'.$item['title'].' </a></li>';
                }
            }
        }
        return $html;
    }



    function sliceArray($data,$position=4) {
        $start  = 1;
        $total  = count($data);
        $loop   = ceil($total/$position);
        $result = array();
        for ($i=0;$i<$loop;$i++) {
            $start_slice = ($start-1)*$position;
            $result[$i] = array_slice($data,$start_slice,$position);
            $start++;
        }
        return $result;
    }

    function templateItem($data,$full=false) {
        $class = (!$full) ? 'col-sm-6 col-md-6 col-xs-6 col-lg-3' : 'col-sm-12';
        $classProductMain = (!$full) ? 'product-main img-responsive' : 'product-main-slider img-responsive';
        if (is_array($data)) {
            $img = sizeOfFileName(asset('uploads/mains/'.$data['default_image']),'300x300');
            $html= '
            <div class="'.$class.'">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="'.Route('detail',['alias'=>$data['slug'],'id'=>$data['id']]).'">
                                <img class="'.$classProductMain.'" src="'.$img['path'].$img['filename'].'" alt="'.$img['path'].$img['filename'].'" />
                            </a>
                            <h2><a href="'.Route('detail',['alias'=>$data['slug'],'id'=>$data['id']]).'" title="'.$data['name'].'">'.cutString($data['name'],6).'</a></h2>';
                            if ($data['self_price']=0) {
                                $html.='
                                <p>
                                    <span style="text-decoration: line-through;">'.number_format($data['price'],0,'.'.'.').'<sup>đ</sup></span>&nbsp;&nbsp;'.number_format($data['self_price'],0,'.'.'.').'<sup>đ</sup>
                                </p> ';
                            } else {
                                $html.='<p>'.number_format($data['price'],0,'.','.').'<sup>đ</sup></p>';
                            }
            $html.='</div>
                    </div>
                </div>
            </div>';
        } else {
            $img = sizeOfFileName(asset('uploads/mains/'.$data->default_image),'300x300');
            $html= '
            <div class="'.$class.'">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="'.Route('detail',['alias'=>$data->slug,'id'=>$data->id]).'">
                                <img class="'.$classProductMain.'" src="'.$img['path'].$img['filename'].'" alt="'.$img['path'].$img['filename'].'" />
                            </a>
                            <h2><a title="'.$data->name.'" href="'.Route('detail',['alias'=>$data->slug,'id'=>$data->id]).'">'.cutString($data->name,6).'</a></h2>';
            if ($data->self_price!=0) {
                $html.='
                    <p>
                        <span style="text-decoration: line-through;">'.number_format($data->price,0,'.','.').'<sup>đ</sup></span>&nbsp;&nbsp;'.number_format($data->self_price,0,'.','.').'<sup>đ</sup>
                    </p> ';
            } else {
                $html.='<p>'.number_format($data->price,0,'.','.').'<sup>đ</sup></p>';
            }
            $html.='</div>
                    </div>
                </div>
            </div>';
        }
        return $html;
    }

    function loadBanner($position=1) {
        $banner = \App\Models\Banner::where('banner_position_id','=',$position)->get()->toArray();
        return $banner;
    }


    // get user info
    function getUserInfo() {
        $userInfo = session('USERINFO');
        if ($userInfo) {
            return json_decode($userInfo,true);
        }
        return null;
    }


    function cutString($string, $limit) {
        $str = '';
        $string = explode(' ', trim($string));
        if(sizeof($string) <= $limit) {
            return implode(' ', $string);
        } else {
            for($i = 0; $i < $limit; $i++){
                $str .= $string[$i].' ';
            }
            $str = trim($str);
            $str = $str.' ...';
        }
        return $str;
    }


    function categoryChild($id,$row=[]) {
        if ($id!=0) {
            $c     = App\Models\Category::select("id","parent_id")->where('parent_id',$id)->get()->toArray();
            if ($c) {
                foreach ($c as $key => $value) {
                    $cid = $value["id"];
                    if (!empty($cid)) {
                        $row = categoryChild($cid ,$row);
                    }
                }
                $row[] = $c;
            }
        }
        return $row;
    }

    function getChildCate($cate_id) {
        $data = categoryChild($cate_id);
        $res  = array($cate_id);
        foreach ($data as $cate) {
            foreach($cate as $item) { $res[] = $item["id"]; }
        }
        return $res;
    }
