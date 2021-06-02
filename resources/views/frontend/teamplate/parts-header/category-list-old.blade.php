@if (count($menuCategory))
    @foreach ($menuCategory as $item)
        @if ($item->parent_id == null)
            <li>
                <a title="{{ $item->title }}" href="{{ url($item->url) }}">
                    <img data-src="{{ $item->icon }}" class="img-fluid lazyload" alt="{{ $item->title }}">{{ $item->title }}
                </a>
                @if (count($item->get_child_cate()))
                    <div class="mega-menu">
                        <div class="row">
                            @foreach ($item->get_child_cate() as $value)
                                @if ($loop->index == 0)
                                    <div class="col-md-3">
                                        <div class="item">
                                            <div class="mega-tt">{{ $value->title }}</div>
                                            @if (count($value->get_child_cate()))
                                                <ul>
                                                    @foreach ($value->get_child_cate() as $child)
                                                        <li><a title="{{ $child->title }}" href="{{ url($child->url) }}">{{ $child->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-9">
                                        <div class="item">
                                            <div class="mega-tt">{{ $value->title }}</div>
                                            <div class="mega-right">
                                                @if (count($value->get_child_cate()))
                                                    <ul>
                                                        @foreach ($value->get_child_cate() as $child)
                                                            <li><a title="{{ $child->title }}" href="{{ url($child->url) }}">{{ $child->title }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </li>
        @endif
    @endforeach
@endif
