<?php
	/**
	 * [getActionName description]
	 * @return [string] [action name]
	 */
	function getActionName($request) {
		$route      = $request->route() ? $request->route()->getName() : '';
		return substr($route,strrpos($route,'.')+1);
	}
	/**
	 * [menuMulti description]
	 * @param  [type]  $data      [array]
	 * @param  integer $parent_id [int]
	 * @param  string  $str       [str]
	 * @param  integer $select    [number]
	 */
	function menuMulti($data,$parent_id = 0,$str="---|",$select=0) {
		foreach ($data as  $value) {
			$id   		= $value['id'];
			$name 		= $value['title'];
			if ( $value["parent_id"] == $parent_id) {
				if ($select!=0 &&  $id == $select) {
					echo '<option data-slug="'.$value['slug'].'" selected="selected" value="'.$id.'">'.$str.' '.$name.'</option>';
				} else {
					echo '<option data-slug="'.$value['slug'].'" value="'.$id.'">'.$str.' '.$name.'</option>';
				}
				menuMulti($data, $id, $str." ---|",$select);
			}
		}
	}

	/**
	 * [listCate description]
	 * Show list cate
	 * @param  [array] $[data]    		[list cate]
	 * @param  [integer] $[parent_id] 	[parent of category]
	 * @param  [string]  $[str]      	[str]
	 * @param  [integer] $[stt]     	[int]
	 * @return [string html]
	 */
	function listCate($data, $parent_id=0, $str="",$stt=0) {
		foreach ($data as $value) {
			$id   = $value['id'];
			if ($value["parent_id"] == $parent_id) {
				$stt++;
				echo 
				'<tr class="even pointer">
                    <td class="a-center ">
                        <input type="checkbox" class="flat" name="table_records">
                    </td>
                    <td class=" ">'.$stt.'</td>';                   
                    if ($str == '') {
                    	echo '<td class=" "><strong>'.$str.'&nbsp;'.$value['title'].'</strong></td>';
                    } else {
                    	echo '<td class=" ">'.$str.'&nbsp;'.$value['title'].'</td>';
                    }
                echo 
                '</td>
                    <td class=" ">2015</td>
                    <td class=" ">Chỉnh sửa</td>    
                </tr>';
	            listCate($data, $id, $str." ---|",$stt);
			}
		}
	}

	/**
	 * [changeFileName description]
	 * @return [string] $[filename] [filename want to change]
	 */
	function changeFileName($filename) {
		$filename = str_replace([' ','"','\''],'_', $filename);
		$filename = time().'_'.$filename;
		return $filename;
	}

	/**
	 * [sizeOfFileName : get size of filename]
	 * @param  [string] $[filename] [filename to get size]
	 * @param  [string] $[size] [size example =>'300x300']
	 * @return [array]  [path,filename]
	 * path 		=> '16/08/20/thumbs/' (example)
	 * filename     => '60x60_1471669268_Photo_11-27-15,_6_41_17_PM.jpg'(example)
	 */
	function sizeOfFileName($filename="",$size="") {
		if (!empty($filename) && !empty($size)) {
			$postion 	 = strrpos($filename,"/")+1;
			$outPutName  = $size.'_'.substr($filename,$postion);
			$outputPath  = substr($filename,0,$postion);
			return [
				"filename"=> $outPutName,
				"path"	  => $outputPath.'thumbs/'
			];
		}
	}


	/**
	 * Function create Folder follow year/month/day
	 * @param  [$string] $[path] ['fordername where create']
	 * @return [string] [year/month/day]
	 */
	function forderStore($path='mains', $thumbs=false) {
		$folderCreate = date('y').'/'.date('m').'/'.date('d');
		File::makeDirectory('uploads/'.$path.'/'.$folderCreate, $mode = 0777, true, true);
		if ($thumbs) {
            File::makeDirectory('uploads/'.$path.'/'.$folderCreate.'/thumbs', $mode = 0777, true, true);
		}
		return $folderCreate;
	}

	/**
	 * [resizeImage] 
	 * @param  [string] $[pathFile] 	  [the path of image root]
	 * @param  [string] $[pathStore]  	  [the folder to store images]
	 * @param  [type]   $[filename]   	  [filename root want to reisze]
	 * @param  [string] $[fileNameOutPut] [filename of final output]
	 * @param  [number] $[width] 		  [width of image to resize]
	 * @param  [number] $[height] 		  [height of image to resize]
	 * @return void()
	 */
	function resizeImage($pathFile,$pathStore,$filename,$fileNameOutPut,$width=300,$height=300) {	
		if (File::exists($pathFile.'/'.$filename)) {	
			Image::make($pathFile.'/'.$filename)->resize($width,$height)->save($pathStore.'/'.$fileNameOutPut);
		} else {
			Image::make($pathFile.$filename)->resize($width,$height)->save($pathStore.$fileNameOutPut);
		}
	}

	/**
	 * [convertJsonToArray] 
	 * @param  [string] $[string][string of json]
	 * @return [array]
	 */
	function convertJsonToArray($string) {
		return json_decode($string,true);	
	}

	/**
	 * [loadAction load template edit and delete in list ]
	 * @param  [INT]    $[id][id of item]
	 * @param  [string] $[alias] [route name]
	 * @return [string] [html]
	 */
	function loadAction($id,$alias,$custom=false,$params=[]) {
		$result = '';
		if ($custom) {
			$result.= '<a class="btn btn-info btn-xs" href="'.$params['link'].'">'.$params['title'].'</a>';
		} else {
			$result.= Form::open(['method' => 'DELETE', 'route' => ['admin_shop.'.$alias.'.destroy',$id],'style'=>'display:inline;']);
			$result.= '<a href="'.URL::route('admin_shop.'.$alias.'.edit',['id'=>$id]).'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a>';
			$result.= '<a onclick="$(this).next().click();" href="javascript:void(0);" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Xóa </a>';
			/*
            $result.= '<a href="'.URL::route('admin_shop.'.$alias.'.edit',['id'=>$id]).'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>
                &nbsp;&nbsp;&nbsp;
                <a onclick="$(this).next().click();" href="javascript:void(0);"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
            */
			$result.= Form::submit('', ['style' => 'display:none']);
			$result.= Form::close();
		}
		return $result;
	}

	function convertDate($date) {
		$date = str_replace("/","-",$date);
		$date = date("Y-m-d",strtotime($date));
		return $date;
	}

	function getOptionProduct($sku) {
		$p = App\Models\Product::where("sku","=",$sku)->first();
		if ($p!='') {
			$c = $p->option()->with('optionGroup')->get()->toArray();
			$attribute = [];
			if (!empty($c)) {
				foreach ($c as $key => $value) {
					$groupName = $value['option_group']['name'];
					$attribute[$groupName][] = [
						"id"  => $value["id"],
						"name"=> $value["name"]
					];
				}
				return $attribute;
			} else {
				return null;
			}
		} else {
			return null;
		}
	}

	function array_split($array, $pieces=2) {
        if ($pieces < 2) {
            return array($array);
        }

        $newCount = ceil(count($array)/$pieces);
        $a = array_slice($array, 0, $newCount);
        $b = array_split(array_slice($array, $newCount), $pieces-1);
        return array_merge(array($a),$b);
    }

    function currentPriceFormat($number,$type="vnd") {
		if($number == 0) return null;
		if ($type == "vnd") {
			return number_format($number,0,'.','.')." <sup>VND</sup>";
		}
	}

?>
