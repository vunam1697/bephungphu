@if (count($menuCategory))
    @foreach ($menuCategory as $item)
        <li>
            <a title="{{ $item->title }}" href="{{ url($item->url) }}">
                <img data-src="{{ $item->icon }}" class="img-fluid lazyload" alt="{{ $item->title }}">{{ $item->title }}
            </a>
            @if (count($item->get_child_cate()))
                <div class="mega-menu">
                    <div class="row">
                        <?php $category_menu = App\Models\CategoryMenu::where('parent_id', $item->id)->whereType('category')->orderBy('position', 'asc')->get(); ?>
                        @if (count($category_menu))
                            <div class="col-md-3">
                                <div class="item">
                                    <div class="mega-tt">Loại sản phẩm</div>
                                    <ul>
                                        @foreach ($category_menu as $value)
                                             <li><a title="{{ $value->title }}" href="{{ url($value->url) }}">{{ $value->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <?php $brand_menu = App\Models\CategoryMenu::where('parent_id', $item->id )->whereType('brand')->orderBy('position', 'asc')->get(); ?>
                        @if (count($brand_menu))
                            <div class="col-md-9">
                                <div class="item">
                                    <div class="mega-tt">Thương hiệu</div>
                                    <div class="mega-right">
                                        <ul>
                                            @foreach ($brand_menu as $value)
                                                <li><a title="{{ $value->title }}" href="{{ url($value->url) }}">{{ $value->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </li>
       
    @endforeach
@endif
