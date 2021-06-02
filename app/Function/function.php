<?php
define("__IMAGE_DEFAULT__", asset('public/backend/img/placeholder.png'));
define("__BASE_URL__", url('public/frontend'));

use App\Models\Options;
use App\Models\Comments;
use App\Models\ProductQuestions;


function renderImage($link)
{
    if (!empty($link)) {
        return $link;
    }
    return asset('public/backend/img/no-image.png');
}

function text_limit($str, $limit = 10)
{
    if (stripos($str, " ")) {
        $ex_str = explode(" ", $str);
        if (count($ex_str) > $limit) {
            $str_s = null;
            for ($i = 0; $i < $limit; $i++) {
                $str_s .= $ex_str[$i] .
                    " ";
            }
            return $str_s;
        } else {
            return $str;
        }
    } else {
        return $str;
    }
}

function menuChildren($data, $id, $item)
{
    if (count($item->get_child_cate()) > 0) {
        echo '<ol class="dd-list">';
        foreach ($item->get_child_cate() as $item) {
            if ($item->parent_id == $id) {
                echo '<li class="dd-item" data-id="' . $item->id . '">';
                echo '  <div class="dd-handle">' . $item->title . '(<i>' . $item->url . '</i>)</div>
                                        <div class="button-group">
                                            <a href="javascript:;" class="modalEditMenu" data-id="' . $item->id . '">
                                                <i class="fa fa-pencil fa-fw"></i> Sửa
                                            </a> &nbsp; &nbsp; &nbsp;
                                            <a class="text-danger" href="' . route('setting.menu.delete', $item['id']) . '" onclick="return confirm(\'Bạn có chắc chắn xóa không ?\')" title="Xóa"> <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                                        </div>';
                menuChildren($data, $item->id, $item);
                echo '</li>';
            }
        }
        echo '</ol>';
    }
}

function renderLinkAddPostType()
{
    $type = request()->get('type');
    if ($type == 'blog') {
        return [
            'title'    => 'Bài Viết',
            'linkAdd'  => route('posts.create', ['type' => 'blog']),
            'linkList' => route('posts.index', ['type' => 'blog']),
        ];
    }
}

function listCate($data, $parent_id = 0, $str = '')
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        if ($value->parent_id == $parent_id) {
            if ($str == '') {
                $strName = '<b>' . $str . $name . '</b>';
            } else {

                $strName = $str . $name;
            }
            echo '<tr class="odd">';
            echo '<td><input type="checkbox" name="chkItem[]" value="' . $id . '"></td>';
            echo '<td>
                        <a class="text-default" href="' . route('category.edit', $id) . '" title="Sửa">' . $strName . '</a></br>
                        <a href="' . asset('danh-muc/' . $value->slug) . '" target="_blank"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Link: ' . asset('danh-muc/' . $value->slug) . ' </a>
                    </td>';
            echo '<td><a class="text-default" href="' . route('category.edit', $id) . '" title="Sửa"> ' . count($value->get_child_cate()) ?: '_' . ' </a>
                        </td>';
            echo ' <td><a href="' . route('category.edit', $id) . '" title="Sửa"> <i class="fa fa-pencil fa-fw"></i> Sửa</a> &nbsp; &nbsp; &nbsp;
                                <a href="javascript:;" class="btn-destroy" data-href="' . route('category.destroy', $id) . '" data-toggle="modal" data-target="#confim">
                                    <i class="fa fa-trash-o fa-fw"></i> Xóa
                                </a>
                            </td>';
            echo '</tr>';

            listCate($data, $id, $str . '---| ');
        }
    }
}

function checkBoxCategory($data, $id, $item, $list_id = null)
{
    if (count($item->get_child_cate()) > 0) {
        echo '<div style="padding-left:15px;">';
        foreach ($item->get_child_cate() as $value) {
            $checked = null;
            if (!empty($list_id)) {
                if (in_array($value->id, $list_id)) {
                    $checked = 'checked';
                }
            }
            if ($value->parent_id == $id) {
                echo '<label class="custom-checkbox">
                                <input type="checkbox" class="category" name="category[]" value="' . $value->id . '" ' . $checked . ' > ' . $value->name . '
                            </label>';
                checkBoxCategory($data, $value->id, $value, $list_id );
            }
        }
        echo '</div>';
    }
}

function checkBoxCategoryName($data, $id, $item, $list_id = null, $name = null)
{
    if (count($item->get_child_cate()) > 0) {
        echo '<div style="padding-left:15px;">';
        foreach ($item->get_child_cate() as $value) {
            $checked = null;
            if (!empty($list_id)) {
                if (in_array($value->id, $list_id)) {
                    $checked = 'checked';
                }
            }
            if ($value->parent_id == $id) {
                echo '<label class="custom-checkbox">
                                <input type="checkbox" class="category" name="' . $name . '" value="' . $value->id . '" ' . $checked . ' > ' . $value->name . '
                            </label>';
                checkBoxCategory($data, $value->id, $value);
            }
        }
        echo '</div>';
    }
}

function dequy($datas)
{
    $list_ids = [];
    foreach ($datas as $data) {
        $list_ids[] = $data->id;
        if ($data->get_child_cate()->count() > 0) {
            $list_ids = array_merge($list_ids, dequy($data->get_child_cate()));
        }
    }
    return $list_ids;
}

function get_list_ids($datas)
{
    return $datas ? dequy($datas->get_child_cate()) : null;
}

function getlistcate($data, $id)
{
    foreach ($data as $item) {
        if ($item->parent_id == $id) {
            echo '<li class="active"><a href="' . route('home.getActive', ['slug' => $item->slug, 'id' => $item->id]) . '">' . $item->name . '</a></li>';
            getlistcate($data, $item->id);
        }
    }
}

function getListParent($data)
{
    $parent = $data;
    if ($data->parent_id > 0) {
        $parent = $data->getParent();
        $parent = getListParent($parent);
    }
    return $parent;
}

function menuMulti($data, $parent_id = 0, $str = '---| ', $select = 0)
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        if ($value->parent_id == $parent_id) {
            if ($select != 0 && $id == $select) {
                echo '<option value=' . $id . ' selected> ' . $str . $value->name . ' </option>';
            } else {
                echo '<option value=' . $id . '> ' . $str . $value->name . ' </option>';
            }
            menuMulti($data, $id, $str . '---|  ', $select);
        }
    }
}


function menuMultiSlug($data, $parent_id = 0, $str = '---| ', $select = 0)
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        if ($value->parent_id == $parent_id) {
            if ($select != 0 && $id == $select) {
                echo '<option value=' . $value->slug . ' selected> ' . $str . $value->name . ' </option>';
            } else {
                echo '<option value=' . $value->slug . '> ' . $str . $value->name . ' </option>';
            }
            menuMultiSlug($data, $id, $str . '---|  ', $select);
        }
    }
}



function getOptions($key = null, $field = null, $array = false)
{
    if (!empty($key)) {
        $data = Options::where('type', $key)->first();
        if (!empty($data)) {
            $data = json_decode($data->content, $array);
            if (!empty($field)) {
                return !empty($data->{$field}) ? $data->{$field} : $data;
            }
            return $data;
        }
        return 'key does not exist';
    }
    return 'error';
}

function renderAction($method)
{
    return isUpdate($method) ? 'Cập nhật' : 'Thêm mới';
}

function isUpdate($method)
{
    return (bool) $method == 'update';
}

function updateOrStoreRouteRender($method, $model, $data)
{
    return isUpdate($method) ? route($model . '.update', $data) : route($model . '.store');
}

function generateRandomCode()
{
    return substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
}


function getListStarProduct($item)
{
    $star_all   =   Comments::where('status', 1)->where('type', 0)->whereNotNull('vote')->where('id_product', $item->id)->count();
    if($star_all == 0){
        return [
            '1' => [
                'percent' => 0, 
                'total_vote' => 0
            ], 
            '2' => [
                'percent' => 0, 
                'total_vote' => 0
            ],
            '3' => [
                'percent' => 0, 
                'total_vote' => 0
            ],
            '4' => [
                'percent' => 0, 
                'total_vote' => 0
            ],
            '5' => [
                'percent' => 0, 
                'total_vote' => 0
            ]
        ];
    }
    $star_1     =   Comments::where('status', 1)->where('id_product', $item->id)->where('vote', 1)->where('type', 0)->count();
    $star_2     =   Comments::where('status', 1)->where('id_product', $item->id)->where('vote', 2)->where('type', 0)->count();
    $star_3     =   Comments::where('status', 1)->where('id_product', $item->id)->where('vote', 3)->where('type', 0)->count();
    $star_4     =   Comments::where('status', 1)->where('id_product', $item->id)->where('vote', 4)->where('type', 0)->count();
    $star_5     =   Comments::where('status', 1)->where('id_product', $item->id)->where('vote', 5)->where('type', 0)->count();
    return [
        '1' => [
            'percent' => round(($star_1 / $star_all) * 100), 
            'total_vote' => $star_1
        ], 
        '2' => [
            'percent' => round(($star_2 / $star_all) * 100), 
            'total_vote' => $star_2
        ],
        '3' => [
            'percent' => round(($star_3 / $star_all) * 100), 
            'total_vote' => $star_3
        ],
        '4' => [
            'percent' => round(($star_4 / $star_all) * 100), 
            'total_vote' => $star_4
        ],
        '5' => [
            'percent' => round(($star_5 / $star_all) * 100), 
            'total_vote' => $star_5
        ],
        'all' => [
            'total_vote' => $star_1 + $star_2 + $star_3 + $star_4 + $star_5,
        ]
    ];
}


function getStarProduct($item)
{
    $dataStar = Comments::where('status', 1)->where('type', 0)->whereNotNull('vote')->where('id_product', $item->id);
    $sumStar = $dataStar->sum('vote');
    $countComment = $dataStar->count();
    $average = 0;
    if($sumStar != 0){
        $average =  round($sumStar / $countComment, 1);
    }
    return $average;
}

function getPercentVoteYesQuestions($item)
{
   $total = $item->vote_yes + $item->vote_no;
   return $total != 0 ? round($item->vote_yes / $total, 1) * 100 : 0;
}

function getPercentVoteNoQuestions($item)
{
   $total = $item->vote_yes + $item->vote_no;
   return $total != 0 ? round($item->vote_no / $total, 1) * 100 : 0;
}


function dequyComments($datas)
{
    $list_ids = [];
    foreach ($datas as $data) {
        $list_ids[] = $data->id;
        if ($data->getChild()->count() > 0) {
            $list_ids = array_merge($list_ids, dequyComments($data->getChild()));
        }
    }
    return $list_ids;
}

function get_list_ids_comments($datas)
{
    return $datas ? dequyComments($datas->getChild()) : null;
}

function renderComments($data, $item1)
{
    if(count($item1->getChild()) > 0){
        echo '<div style="padding-left:25px;" class="box-comment-custom">';
        foreach ($item1->getChild() as $value) {
            if ($value->parent_id == $item1->id) {
                $item = $value;
                echo view('backend.comments.row-comment',compact('item'))->render();
                renderComments($data, $value);
            }
        }
        echo '</div>';
    }
}


function renderCommentsFrontend($data, $item1, $productId)
{
    if(count($item1->getChild()) > 0){
        foreach ($item1->getChild() as $value) {
            if ($value->parent_id == $item1->id) {
                $item = $value;
                $idProduct = $productId;
                echo view('frontend.components.row-comment',compact('item', 'idProduct'))->render();
                renderCommentsFrontend($data, $value, $productId);
            }
        }
    }
}


function getFullAddress($id_province, $id_district, $id_ward)
{
    return DB::table('vn_ward')->where('id', $id_ward)->first()->_name.' - '.DB::table('vn_district')->where('id', $id_district)->first()->_name.' - '.DB::table('vn_province')->where('id', $id_province)->first()->_name;
}

function url_query_render($key_filter = null, $value = null)
{
    $prefix = '?';
    $url_current = url()->full();

    $url_query = explode('?', $url_current);
    if (isset($url_query[1])) {

        $url_query_list = explode('&', $url_query[1]);

        $key_filter_list = [];
        $value_filter_list = [];
        foreach ($url_query_list as $key => $item) {
            $item_array = explode('=', $item);
            $key_filter_list[$key] = $item_array[0];
            $value_filter_list[$key] = $item_array[1];
        }

        if (in_array($key_filter, $key_filter_list)) {
            $key_filter_index = array_search($key_filter, $key_filter_list);
            unset($url_query_list[$key_filter_index]);


            if (in_array($value, $value_filter_list)) {
                $value_filter_index = array_search($value, $value_filter_list);
                if ($value_filter_index === $key_filter_index) {

                    if (count($url_query_list) === 0) {
                        return [
                            'url' => URL::current(),
                            'active' => true
                        ];
                    }

                    return [
                        'url' => URL::current() . $prefix . implode('&', $url_query_list),
                        'active' => true
                    ];
                }
            }

        }

        array_push($url_query_list, $key_filter . '=' . $value);
        return [
            'url' => URL::current() . $prefix . implode('&', $url_query_list),
            'active' => false
        ];

    }

    return [
        'url' => URL::current() . $prefix . $key_filter . '=' . $value,
        'active' => false
    ];

}


