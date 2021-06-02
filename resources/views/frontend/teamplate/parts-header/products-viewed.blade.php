<div class="slide-header">
    <?php $products_viewed = \App\Models\Products::whereIn('id', session('product_viewed'))->get(); ?>
    @if (count($products_viewed))
        @foreach ($products_viewed as $item)
             <div class="item">
                <div class="avarta">
                    <a title="{{ $item->name }}" href="{{ route('home.single.product', $item->slug) }}">
                        <img data-src="{{ $item->image }}" class="img-fluid lazyload" alt="{{ $item->name }}">
                    </a>
                </div>
                <div class="info text-center">
                    <h3><a title="{{ $item->name }}" href="{{ route('home.single.product', $item->slug) }}">{{ $item->name }}</a></h3>
                    @if (!is_null($item->sale_price))
                        <div class="price">{{ number_format($item->sale_price,0, '.', '.') }}đ</div>
                        <del>{{ number_format($item->regular_price,0, '.', '.') }}đ</del>
                    @else
                        <div class="price">{{ number_format($item->regular_price,0, '.', '.') }}đ</div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
