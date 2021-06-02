<div class="title-bar-news">Tin tức mới nhất</div>
<?php $list_news_sidebar = \App\Models\Posts::active()->where('type', 'blog')->order()->take(5)->get(); ?>
<div class="list-new-bar">
	@if (count($list_news_sidebar))
		@foreach ($list_news_sidebar as $item)
			<div class="item">
				<div class="avarta">
					<a title="{{ $item->name }}" href="{{ route('home.post.single', $item->slug) }}">
						<img data-src="{{ @$item->image }}" class="img-fluid lazyload" width="100%" alt="{{ $item->name }}">
					</a>
				</div>
				<div class="info">
					<h4><a title="{{ $item->name }}" href="{{ route('home.post.single', $item->slug) }}">{{ $item->name }}</a></h4>
					<div class="date">{{ $item->created_at->format('d/m/yy') }}</div>
				</div>
			</div>
		@endforeach
	@endif
</div>