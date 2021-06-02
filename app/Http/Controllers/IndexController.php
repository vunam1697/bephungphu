<?php

namespace App\Http\Controllers;

use App\Mail\SendMailOrders;
use App\Models\Branchs;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\Coupons;
use App\Models\Customers;
use App\Models\Filter;
use App\Models\Menu;
use App\Models\Options;
use App\Models\OrderDetail;
use App\Models\Orders;
use App\Models\Pages;
use App\Models\Posts;
use App\Models\ProductAttributes;
use App\Models\ProductAttributeTypes;
use App\Models\ProductCategory;
use App\Models\Products;
use App\Trails\MailTrait;
use Cart;
use DB;
use Illuminate\Http\Request;
use JsValidator;
use Mail;
use OpenGraph;
use SEO;
use SEOMeta;
use App\Models\ProductPageCombo;
use App\Models\CategoryMenu;

class IndexController extends Controller
{

    use MailTrait;

    public $config_info;

    public function __construct()
    {
        $site_info = Options::where('type', 'general')->first();
        $site_info = json_decode($site_info->content);

        $this->config_info = $site_info;

        OpenGraph::setUrl(\URL::current());
        OpenGraph::addProperty('locale', 'vi');
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('author', 'GCO-GROUP');

        SEOMeta::addKeyword($site_info->site_keyword);

        $menuMain = Menu::where('id_group', 1)->orderBy('position')->get();

        $menuMainMobile = Menu::where('id_group', 2)->orderBy('position')->get();

        $menuCategory = CategoryMenu::where('parent_id', null)->orderBy('position')->get();

        //$menuCategory = Menu::where('id_group', 3)->orderBy('position')->get();

        $tags_link = Options::where('type', 'tags-config')->first();

        $branchs = Branchs::active()->order()->get();

        view()->share(compact('site_info', 'menuMainMobile', 'menuMain', 'menuCategory', 'branchs', 'tags_link'));
    }

    public function createSeo($dataSeo = null)
    {
        $site_info = $this->config_info;
        if (!empty($dataSeo->meta_title)) {
            SEO::setTitle($dataSeo->meta_title);
        } else {
            SEO::setTitle($site_info->site_title);
        }
        if (!empty($dataSeo->meta_description)) {
            SEOMeta::setDescription($dataSeo->meta_description);
            OpenGraph::setDescription($dataSeo->meta_description);
        } else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
        }
        if (!empty($dataSeo->image)) {
            OpenGraph::addImage($dataSeo->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($site_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($dataSeo->meta_keyword)) {
            SEOMeta::addKeyword($dataSeo->meta_keyword);
        }
    }

    public function createSeoPost($data)
    {
        if (!empty($data->meta_title)) {
            SEO::setTitle($data->meta_title);
        } else {
            SEO::setTitle($data->name);
        }
        if (!empty($data->meta_description)) {
            SEOMeta::setDescription($data->meta_description);
            OpenGraph::setDescription($data->meta_description);
        } else {
            SEOMeta::setDescription($this->config_info->site_description);
            OpenGraph::setDescription($this->config_info->site_description);
        }
        if (!empty($data->image)) {
            OpenGraph::addImage($data->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($this->config_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($data->meta_keyword)) {
            SEOMeta::addKeyword($data->meta_keyword);
        }
    }

    public function getHome()
    {
        $this->createSeo();

        $dataContent = Pages::where('type', 'home')->first();

        $products_price_shock = Products::active()->where('is_price_shock', 1)->order()->take(150)->get();

        $products_sale_hot = Products::active()->where('sale', '>', 0)->where('is_hot', 1)->order()->take(12)->get();

        $products_hot = Products::active()->where('is_hot', 1)->order()->take(24)->get();

        $posts_hot = Posts::active()->published()->published()->where('type', 'blog')->order()->where('hot', 1)->take(4)->get();

        return view('frontend.pages.home', compact('dataContent', 'products_price_shock', 'posts_hot', 'products_sale_hot', 'products_hot'));
    }

    public function getArchiveNews()
    {
        $dataSeo = Pages::where('type', 'archive-news')->first();
        $this->createSeo($dataSeo);
        $categories = Categories::where('type', 'post_category')->get();
        return view('frontend.pages.archives-news', compact('dataSeo', 'categories'));
    }

    public function getCategoriesNews($slug)
    {
        $category = Categories::where('slug', $slug)->where('type', 'post_category')->firstOrFail();
        $this->createSeoPost($category);
        $data = $category->Posts()->active()->published()->orderBy('created_at', 'DESC')->paginate(16);
        return view('frontend.pages.categories-news', compact('category', 'data'));
    }

    public function getNewsByTags($tag)
    {
        $tag = \Conner\Tagging\Model\Tag::where('slug', $tag)->firstOrFail();
        $this->createSeo();
        SEO::setTitle('Tags: ' . $tag->name);
        $data = Posts::withAnyTag($tag->name)->paginate(16);
        return view('frontend.pages.tags-news', compact('tag', 'data'));
    }

    public function getSingleNews($slug)
    {
        $data = Posts::active()->published()->where('type', 'blog')->where('slug', $slug)->firstOrFail();
        $data->increment('view_count');
        $this->createSeoPost($data);
        $post_related = Posts::with('tagged')->active()->published()->where('type', 'blog')->where('id', '!=', $data->id)->inRandomOrder()->take(4)->get();
        return view('frontend.pages.single-news', compact('data', 'post_related'));
    }

    public function getAbout()
    {
        $dataSeo = Pages::where('type', 'about')->first();
        $this->createSeo($dataSeo);
        return view('frontend.pages.about', compact('dataSeo'));
    }

    public function getArchiveProduct($slug)
    {
        $category           = Categories::where('slug', $slug)->firstOrFail();

        $list_id_children   = get_list_ids($category);
        $list_id_children[] = $category->id;
        $list_id_product    = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
        $data               = Products::active()->whereIn('id', $list_id_product)->take(16)->get();

        $this->createSeoPost($category);
        $parent  = getListParent(@$category);
        $filters = Filter::where('category_id', $parent->id)->orderBy('position')->get();
        return view('frontend.pages.products.archive-products', compact('data', 'category', 'filters'));
    }

    public function getProducts()
    {
        $dataSeo = Pages::where('type', 'products')->first();
        $this->createSeo($dataSeo);
        $data    = Products::active()->filter()->sort()->take(16)->get();
        $filters = Filter::where('category_id', 0)->orderBy('position', 'ASC')->get();
        return view('frontend.pages.products.archive-products', compact('data', 'dataSeo', 'filters'));

    }

    public function getSingleProduct($slug)
    {
        $data = Products::with('tagged')->active()->where('slug', $slug)->firstOrFail();

        $productAttributeTypes = ProductAttributeTypes::all();

        $this->createSeoPost($data);

        $this->addRecentlyViewedProduct($data->id);

        $list_category         = $data->category->pluck('id')->toArray();
        $list_post_related     = ProductCategory::whereIn('id_category', $list_category)->get()->pluck('id_product')->toArray();
        $product_same_category = Products::where('id', '!=', $data->id)->where('status', 1)->whereIn('id', $list_post_related)->orderBy('created_at', 'DESC')->take(12)->get();

        $jsValidatorReviews = JsValidator::make([
            'name'    => 'required|min:5|max:50',
            'phone'   => 'required',
            // 'email'   => 'required|email',
            'content' => 'required|max:300',
        ],
            [
                'name.required'    => 'Bạn chưa nhập họ tên.',
                'name.min'         => 'Họ tên không thể nhỏ hơn 5 ký tự.',
                'name.max'         => 'Họ tên không thể lớn hơn 50 ký tự.',
                'email.required'   => 'Bạn chưa nhập email.',
                'phone.required'   => 'Bạn chưa nhập số điện thoại.',
                'email.email'      => 'Email phải là một địa chỉ email hợp lệ.',
                'content.required' => 'Bạn chưa nhập nội dung bình luận.',
                'content.max'      => 'Nội dung không thể lớn hơn 300 ký tự.',
            ]);

        return view('frontend.pages.products.single-product', compact('data', 'jsValidatorReviews', 'productAttributeTypes', 'product_same_category'));
    }

    public function getProductByTags($tag)
    {
        $tag = \Conner\Tagging\Model\Tag::where('slug', $tag)->firstOrFail();
        $this->createSeo();
        SEO::setTitle('Tags: ' . $tag->name);
        $data = Products::active()->withAnyTag($tag->name)->paginate(24);
        return view('frontend.pages.products.tags', compact('tag', 'data'));
    }

    public function getProductByCategoryAndBrand($category, $brand)
    {
        $category = Categories::where('slug', $category)->where('type', 'product_category')->firstOrFail();
        $brand    = Categories::where('slug', $brand)->where('type', 'brand_category')->firstOrFail();

       
        $list_id_children       = get_list_ids($category);
        $list_id_children_id    = $list_id_children;
        $list_id_children[]     = $category->id;
        $list_id_product        = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();

        $this->createSeoPost($brand);

        $products = Products::active();

        $products = $products->whereIn('id', $list_id_product)->where('brand_id', $brand->id)->sort();

        $products = $products->paginate(24);

        return view('frontend.pages.product-brand-category', compact('category', 'brand', 'products', 'list_id_children_id'));
    }

    public function addRecentlyViewedProduct($idProduct)
    {
        $product_list = [];
        if (session()->has('product_viewed')) {
            $product_list = session('product_viewed');
        }
        if (count($product_list)) {
            foreach ($product_list as $value) {
                if ($value == $idProduct) {
                    return true;
                }
            }
        }
        $product_list[] = $idProduct;
        session(['product_viewed' => $product_list]);
        return true;
    }

    public function postComment(Request $request, $idProduct)
    {
        // $this->validate($request, [
        //     'name'    => 'required',
        //     'phone'   => 'required',
        //     'content' => 'required',
        // ]);
        $customers        = new Customers;
        $customers->name  = $request->name;
        $customers->email = $request->email;
        $customers->phone = $request->phone;
        $customers->save();
        $comment               = new Comments;
        $comment->id_product   = $idProduct;
        $comment->id_customers = $customers->id;
        $comment->content      = $request->content;
        $comment->status       = 0;
        $comment->vote         = $request->raiting;
        if (!empty($request->images_reviews)) {
            $listImage = [];
            foreach ($request->images_reviews as $image) {
                $image     = str_replace('data:image/png;base64,', '', $image);
                $image     = str_replace(' ', '+', $image);
                $imageName = str_random(14) . '.' . 'png';
                \File::put(base_path() . '/uploads/comments/' . $imageName, base64_decode($image));
                $listImage[] = $imageName;
            }

            $comment->image = json_encode($listImage);
        }
        if (!empty($request->quess)) {
            $dataQuestionsVote = [];
            foreach ($request->quess as $key => $value) {
                $dataQuestionsVote[] = [
                    'id_question' => $key,
                    'vote'        => $value,
                ];
            }
            $comment->vote_questions = json_encode($dataQuestionsVote);
        }
        $comment->save();
        return back()->with(['toastr' => 'Gửi thông tin đánh giá thành công.']);
    }

    public function getVoteStar(Request $request)
    {
        $idproduct             = $request->id_product;
        $star                  = $request->star;
        $comment               = new Comments;
        $comment->id_product   = $idproduct;
        $comment->id_customers = 77;
        $comment->status       = 1;
        $comment->vote         = $star;
        $comment->save();
        return response()->json([
            'message' => 'success',
        ]);
    }

    public function postReplyComment(Request $request, $idProduct)
    {

        $this->validate($request, [
            'name'    => 'required|min:5|max:50',
            'email'   => 'required|email',
            'content' => 'required|max:300',
        ], [
            'name.required'    => 'Bạn chưa nhập họ tên.',
            'name.min'         => 'Họ tên không thể nhỏ hơn 5 ký tự.',
            'name.max'         => 'Họ tên không thể lớn hơn 50 ký tự.',
            'email.required'   => 'Bạn chưa nhập email.',
            'email.email'      => 'Email phải là một địa chỉ email hợp lệ.',
            'content.required' => 'Bạn chưa nhập nội dung bình luận.',
            'content.max'      => 'Nội dung không thể lớn hơn 300 ký tự.',
        ]);
        $customers         = new Customers;
        $customers->name   = $request->name;
        $customers->email  = $request->email;
        $customers->gender = $request->gioitinh;
        $customers->save();
        $comment               = new Comments;
        $comment->id_product   = $idProduct;
        $comment->id_customers = $customers->id;
        $comment->parent_id    = $request->parent_id;
        $comment->content      = $request->content;
        $comment->status       = 0;

        $fImageGallery = $request->file('image_rv');
        if (!empty($fImageGallery)) {
            $file_name_array = array();
            foreach ($fImageGallery as $item) {
                $file_name = time() . rand(10, 100) . '_' . $item->getClientOriginalName();
                $item->move('uploads/comments/', $file_name);
                $file_name_array[] = $file_name;
            }

            $comment->image = json_encode($file_name_array);
        }

        $comment->save();
        return back()->with(['toastr' => 'Gửi thông tin bình luận thành công.']);

    }

    public function getFlashSale()
    {
        $dataContent = Pages::where('type', 'flash_sale')->first();
        $this->createSeo($dataContent);
        $list_category       = null;
        $products_flash_sale = Products::active()->where('is_flash_sale', 1)->where('is_hot', 1)->orderBy('order_sale_page', 'ASC')->take(20)->get();
        return view('frontend.pages.flash-sale', compact('dataContent', 'products_flash_sale'));
    }

    public function getProductsByAjax(Request $request)
    {
        $id_category = $request->id_category;
        $offset      = $request->offset;
        $type        = $request->type;
        if ($type == 'home-hot') {

            // Home

            $data               = Products::active()->where('sale', '>', 0);
            $category           = Categories::where('id', $id_category)->firstOrFail();
            $list_id_children   = get_list_ids($category);
            $list_id_children[] = $category->id;
            $list_id_product    = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
            $data               = $data->whereIn('id', $list_id_product)->order()->take(12)->get();
            $class              = 'col-lg-2 col-6 col-sm-3';
            return view('frontend.pages.products.loop-products', compact('data', 'class'));

        } elseif ($type == 'home-category') {

            // Category
            $category           = Categories::where('id', $id_category)->firstOrFail();
            $list_id_children   = get_list_ids($category);
            $list_id_children[] = $category->id;
            $list_id_product    = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
            $data               = Products::active()->whereIn('id', $list_id_product)->order()->take(24)->get();
            $class              = 'col-lg-2 col-6 col-sm-3';
            return view('frontend.pages.products.loop-products', compact('data', 'class'));

        } else {
            // Flash Sale
            $data = Products::active()->where('is_flash_sale', 1);
            if ($id_category != 'hot') {
                $category           = Categories::where('id', $id_category)->firstOrFail();
                $list_id_children   = get_list_ids($category);
                $list_id_children[] = $category->id;
                $list_id_product    = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
                $data               = $data->whereIn('id', $list_id_product);
            } else {
                $data = $data->orderBy('order_sale_page', 'ASC')->where('is_hot', 1)->order();
            }
            if (!empty($offset)) {
                $data = $data->orderBy('order_sale_page', 'ASC')->offset($offset)->take(20)->get();
            } else {
                $data = $data->orderBy('order_sale_page', 'ASC')->take(20)->get();
            }
            return view('frontend.pages.products.loop-products', compact('data'));
        }
    }

    public function getLoadMoreProductsByAjax(Request $request)
    {
        $data = Products::active()->filter()->sort()->offset($request->offset)->take(16)->get();
        return view('frontend.pages.products.loop-products', compact('data'));
    }

    //
    public function getFilterProductsAjax(Request $request)
    {
        $sort_fields  = $request->sort_fields;
        $sort_type    = $request->sort_type;
        $offset       = !empty($request->offset) ? $request->offset : 0;
        $dataProduct  = Products::active();
        $filterString = $request->filterString;
        $category_id  = $request->category_base;

        if (!empty($filterString)) {
            if ($category_id != 'product-page') {
                $category           = Categories::findOrFail($category_id);
                $list_id_children   = get_list_ids($category);
                $list_id_children[] = $category->id;
                $list_id_product    = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
                $dataProduct        = $dataProduct->whereIn('id', $list_id_product);
            }
            $filterArray = explode('&', $filterString);
            if (!empty($filterArray)) {
                $array = [];
                foreach ($filterArray as $value) {
                    $filter = explode(':', $value);

                    $type  = $filter[0];
                    $param = $filter[1];
                    if ($type == 'category') {
                        $list_id         = explode(',', $param);
                        $list_id_product = ProductCategory::whereIn('id_category', $list_id)->get()->pluck('id_product')->toArray();
                        $dataProduct     = $dataProduct->whereIn('id', $list_id_product);
                    } elseif ($type == 'brand') {
                        $whereBrand  = explode(',', $param);
                        $dataProduct = $dataProduct->whereIn('brand_id', $whereBrand);
                    } elseif ($type == 'price') {
                        $wherePrice  = explode('-', $param);
                        $dataProduct = $dataProduct->whereBetween('regular_price', [$wherePrice[0], $wherePrice[1]]);
                    } else {
                        $attribute_types_id        = explode('-', $type);
                        $array[]                   = $attribute_types_id[1];
                        $list_key                  = explode(',', $param);
                        $list_id_product_attribute = ProductAttributes::where('id_product_attribute_types', $attribute_types_id[1])->whereIn('key', $list_key)->get()->pluck('id_product')->toArray();
                        $dataProduct               = $dataProduct->whereIn('id', $list_id_product_attribute);
                    }
                }
            }

        } else {
            if ($category_id != 'product-page') {
                $category           = Categories::findOrFail($category_id);
                $list_id_children   = get_list_ids($category);
                $list_id_children[] = $category->id;
                $list_id_product    = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
                $dataProduct        = $dataProduct->whereIn('id', $list_id_product);
            }
        }
        if ($sort_fields == 'price') {
            $dataProduct = $dataProduct->orderBy('regular_price', $sort_type);
        } elseif ($sort_fields == 'product-selling') {
            $dataProduct = $dataProduct->where('is_selling', 1)->orderBy('is_selling', 'desc');
        }
        $data = $dataProduct->offset($offset)->take(16)->get();
        if ($offset == 0) {
            return view('frontend.pages.products.loop-products-filter', compact('data'))->render();
        }
        return view('frontend.pages.products.loop-products', compact('data'))->render();
    }

    public function getListBrand()
    {
        $dataContent = Pages::where('type', 'brand')->first();
        $this->createSeo($dataContent);
        $list_brands = Categories::where('type', 'brand_category')->orderBy('order', 'ASC')->orderBy('updated_at', 'DESC')->take(15)->get();
        return view('frontend.pages.list-brand', compact('dataContent', 'list_brands'));
    }

    public function getBrandAjax(Request $request)
    {
        $offset      = $request->offset;
        $list_brands = Categories::where('type', 'brand_category')->orderBy('order', 'ASC')->offset($offset)->take(15)->get();
        return view('frontend.components.loop-brand', compact('list_brands'));
    }

    public function getSingleBrand($slug)
    {
        $data = Categories::where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        $list_brands_display = Pages::where('type', 'brand')->first();
        $category_display    = null;
        if (!empty($data->meta_orthers)) {
            $list_brands_display = json_decode($data->meta_orthers);
            $category_display    = Categories::whereIn('id', @$list_brands_display->list_category)->get();
        }
        $products_hot_by_brand = Products::active()->where('is_hot', 1)->where('brand_id', $data->id)->order()->take(12)->get();
        $list_brands           = Categories::where('type', 'brand_category')->where('id', '!=', $data->id)->orderBy('created_at', 'DESC')->take(12)->get();
        return view('frontend.pages.single-brand', compact('data', 'list_brands', 'products_hot_by_brand', 'category_display'));
    }

    public function getProductsByBrand(Request $request)
    {
        $category_id = $request->category;
        $offset      = $request->offset;
        $brand_id    = $request->brand_id;
        if (empty($category_id)) {
            $data = Products::active()->where('is_hot', 1)->where('brand_id', $brand_id)->order()->offset($offset)->take(12)->get();
            return response()->json(
                [
                    'style_1' => view('frontend.components.loop-products-brand.loop-brand-style-1', compact('data'))->render(),
                    'style_2' => view('frontend.components.loop-products-brand.loop-brand-style-2', compact('data'))->render(),
                ]
            );
        } else {
            $category           = Categories::findOrFail($category_id);
            $list_id_children   = get_list_ids($category);
            $list_id_children[] = $category->id;
            $list_id_product    = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
            $data               = Products::whereIn('id', $list_id_product)->active()->where('brand_id', $brand_id)->offset($offset)->take(12)->get();
            return response()->json(
                [
                    'style_1' => view('frontend.components.loop-products-brand.loop-brand-style-1', compact('data'))->render(),
                    'style_2' => view('frontend.components.loop-products-brand.loop-brand-style-2', compact('data'))->render(),
                ]
            );
        }
    }

    public function getSearch(Request $request)
    {
        if ($request->ajax()) {
            $data = Products::active()->where(function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->q . '%')->orWhere('sku', 'like', '%' . $request->q . '%');
            })->order()->take(5)->get();
            return view('frontend.components.loop-search', compact('data'));
        } else {
            SEO::setTitle('Tìm kiếm từ khóa: ' . $request->q);
            $data = Products::active()->where(function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->q . '%')->orWhere('sku', 'like', '%' . $request->q . '%');
            })->order()->paginate(24);
            return view('frontend.pages.search', compact('data'));
        }
    }

    /* Add Cart -- Check Out */

    public function postAddCart(Request $request)
    {
        $idProduct   = $request->id_product;
        $dataProduct = Products::findOrFail($idProduct);
        $dataCart    = [
            'id'      => $dataProduct->id,
            'name'    => $dataProduct->name,
            'qty'     => $request->qty,
            'price'   => $request->price,
            'weight'  => 0,
            'options' => [
                'image'       => $dataProduct->image,
                'slug'        => $dataProduct->slug,
                'attributes'  => !empty($request->input('attributes')) ? $request->input('attributes') : null,
                'gift'        => !empty($request->gift) ? $request->gift : null,
                'choose_gift' => !empty($request->radiosale) ? $request->radiosale : null,
            ],
        ];
        Cart::add($dataCart);
        return back()->with(['toastr' => 'Thêm vào giỏ hàng thành công.']);
    }

    public function getAddCart(Request $request)
    {
        $idProduct   = $request->id;
        $dataProduct = Products::findOrFail($idProduct);
        $dataCart    = [
            'id'      => $dataProduct->id,
            'name'    => $dataProduct->name,
            'qty'     => 1,
            'price'   => !empty($dataProduct->sale_price) ? $dataProduct->sale_price : $dataProduct->regular_price,
            'weight'  => 0,
            'options' => [
                'image'       => $dataProduct->image,
                'slug'        => $dataProduct->slug,
                'attributes'  => !empty($request->input('attributes')) ? $request->input('attributes') : null,
                'gift'        => !empty($request->gift) ? $request->gift : null,
                'choose_gift' => !empty($request->radiosale) ? $request->radiosale : null,
            ],
        ];
        Cart::add($dataCart);
        return back()->with(['toastr' => 'Thêm vào giỏ hàng thành công.']);
    }

    public function getCart()
    {
        SEO::setTitle('Giỏ hàng');
        $dataProducts = Products::active()->order()->take(12)->get();
        return view('frontend.pages.cart', compact('dataProducts'));
    }

    public function getRemoveCart($row)
    {
        Cart::remove($row);
        return redirect()->back()->with([
            'toastr' => 'Xóa thành công sản phẩm ra khỏi giỏ hàng',
        ]);
    }

    public function getUpdateCart(Request $request)
    {
        Cart::update($request->id, $request->qty);
        return response()->json(Cart::get($request->id));
    }

    public function getCheckOut()
    {
        SEO::setTitle('Thanh toán');
        if (Cart::count()) {
            $jsValidator = JsValidator::make([
                'name'        => 'required|min:5|max:50',
                'phone'       => 'required',
                'address'     => 'required|max:250',
                'email'       => 'required|email',
                'note'        => 'max:300',
                'id_province' => 'required',
                'id_district' => 'required',
                'id_ward'     => 'required',
            ],
                [
                    'name.required'        => 'Bạn chưa nhập họ tên.',
                    'name.min'             => 'Họ tên không thể nhỏ hơn 5 ký tự.',
                    'name.max'             => 'Họ tên không thể lớn hơn 50 ký tự.',
                    'email.required'       => 'Bạn chưa nhập email.',
                    'phone.required'       => 'Bạn chưa nhập số điện thoại.',
                    'email.email'          => 'Email phải là một địa chỉ email hợp lệ.',
                    'note.max'             => 'Nội dung không thể lớn hơn 300 ký tự.',
                    'address.required'     => 'Bạn chưa nhập địa chỉ',
                    'address.max'          => 'Địa chỉ không thể lớn hơn 250 ký tự.',
                    'id_province.required' => 'Bạn chưa chọn Tỉnh Thành.',
                    'id_district.required' => 'Bạn chưa chọn Quận Huyện.',
                    'id_ward.required'     => 'Bạn chưa chọn Phường Xã.',
                ]);
            $province = DB::table('vn_province')->get();
            return view('frontend.pages.check-out', compact('province', 'jsValidator'));
        }
        return redirect('/')->with([
            'toastr' => 'Chưa có sản phẩm trong giỏ hàng',
        ]);
    }

    public function postCheckOut(Request $request)
    {
        $customer              = new Customers;
        $customer->name        = $request->name;
        $customer->email       = $request->email;
        $customer->phone       = $request->phone;
        $customer->id_province = $request->id_province;
        $customer->id_district = $request->id_district;
        $customer->id_ward     = $request->id_ward;
        $customer->address     = $request->address;
        $customer->save();

        $order                 = new Orders;
        $order->id_customers   = $customer->id;
        $order->subtotal_total = Cart::total();

        $order->tax_shipping    = 0;
        $order->note            = $request->note;
        $order->type_pay        = 'COD';
        $order->status          = 1;
        $order->grand_total     = session('grand_total', Cart::total());
        $order->id_coupon       = session('id_code');
        $order->discount_amount = session('discount_amount', 0);

        $order->save();

        session()->forget('id_code');
        session()->forget('discount_amount');
        session()->forget('grand_total');

        foreach (Cart::content() as $item) {
            $orderDetail                   = new OrderDetail;
            $orderDetail->order_id         = $order->id;
            $orderDetail->product_id       = $item->id;
            $orderDetail->product_quantity = $item->qty;
            $orderDetail->price            = $item->price;
            $orderDetail->price_total      = $item->price * $item->qty;
            $orderDetail->options          = @$item->options['attributes'];
            $orderDetail->gift             = !empty(@$item->options['gift']) ? json_encode(@$item->options['gift']) : null;
            $orderDetail->choice           = !empty(@$item->options['choose_gift']) ? json_encode(@$item->options['choose_gift']) : null;
            $orderDetail->save();
        }
        $this->initMailConfig();

        $dataMail = [
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'id_province' => $request->id_province,
            'id_district' => $request->id_district,
            'id_ward'     => $request->id_ward,
            'address'     => $request->address,
            'cart'        => Cart::content(),
            'total'       => Cart::total(),
        ];

        Mail::to(getOptions('general', 'email_admin'))->send(new SendMailOrders($dataMail));

        Cart::destroy();
        return redirect('/')->with([
            'toastr' => 'Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất.',
        ]);
    }

    public function getCheckCoupon(Request $request)
    {
        $this->resetCoupon();
        $coupons = Coupons::where('code', $request->q)->where('status', 1)->first();

        if ($coupons) {
        	if(!empty($coupons->condition) && $coupons->condition >= Cart::total()){
	        	return response()->json([
		            'message' => 'false',
		            'data'    => [],
		        ]);
	        }
            $type  = $coupons->type;
            $total = Cart::total();
            if ($type == 1) {
                $value_reduced   = ($total * $coupons->value) / 100;
                $grand_total     = $total - $value_reduced;
                $discount_amount = $value_reduced;
            } else {
                $grand_total     = $total - $coupons->value;
                $discount_amount = $coupons->value;
            }
            session(['id_code' => $coupons->id, 'grand_total' => $grand_total, 'discount_amount' => $discount_amount]);
            return response()->json([
                'message' => 'success',
                'data'    => [
                    'subtotal'        => Cart::total(),
                    'code'            => $coupons->code,
                    'grand_total'     => number_format($grand_total, 0, '.', '.'),
                    'discount_amount' => number_format($discount_amount, 0, '.', '.'),
                ],
            ]);
        }
        return response()->json([
            'message' => 'false',
            'data'    => [],
        ]);
    }

    public function resetCoupon()
    {
        if(session()->has('id_code')){
            session()->forget('id_code');
        }
        if(session()->has('grand_total')){
            session()->forget('grand_total');
        }
        if(session()->has('discount_amount')){
            session()->forget('discount_amount');
        }
    }

    public function getProvince(Request $request)
    {
        if ($request->type == 'district') {
            $district = DB::table('vn_district')->where('_province_id', $request->id)->get();
            echo "<option value=''>Chọn Quận / Huyện</option>";
            foreach ($district as $value) {
                echo "<option value='{$value->id}'>{$value->_name}</option>";
            }
        } else {
            $ward = DB::table('vn_ward')->where('_district_id', $request->id)->get();
            echo "<option value=''>Chọn Phường / Xã</option>";
            foreach ($ward as $value) {
                echo "<option value='{$value->id}'>{$value->_name}</option>";
            }
        }

    }

    public function getReviewPost($id)
    {
        if (\Auth::check()) {
            $data = Posts::findOrFail($id);
            $this->createSeoPost($data);
            $post_related = Posts::active()->published()->where('type', 'blog')->where('id', '!=', $data->id)->inRandomOrder()->take(4)->get();
            return view('frontend.pages.single-news', compact('data', 'post_related'));
        } else {
            return redirect('/')->with([
                'toastr' => 'Chưa đăng nhập',
            ]);
        }
    }

    public function getInstallment()
    {
        $dataSeo = Pages::where('type', 'installment')->first();
        $this->createSeo($dataSeo);
        return view('frontend.pages.installment', compact('dataSeo'));
    }

    public function getPagesComboProducts($slug)
    {
        $data = ProductPageCombo::where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        return view('frontend.pages.pages-combo', compact('data'));
    }

    public function getFlashSaleByCategory($slug)
    {
        $dataContent = Pages::where('type', 'flash_sale')->first();
        $this->createSeo($dataContent);
        $cate = Categories::where('slug', $slug)->where('type', 'product_category')->firstOrFail();

        $list_id_children   = get_list_ids($cate);
        $list_id_children[] = $cate->id;
        $list_id_product    = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
        $products_flash_sale = Products::active()->whereIn('id',  $list_id_product)->where('is_flash_sale', 1)->orderBy('order_sale_page', 'ASC')->take(20)->get();

        return view('frontend.pages.category-flash-sale', compact('dataContent', 'products_flash_sale', 'cate'));
    }
}
