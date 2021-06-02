<section id="search-tags" class="pb-80">
	<div class="container">
		<div class="content">
			<div class="info-tags">
				<ul class="list-inline">
					<li class="list-inline-item"><span>Tìm kiếm nhiều nhất: </span></li>
					@if (!empty($tags_link->content))
						<?php $content_tags = json_decode( $tags_link->content ); ?>
						@if (!empty($content_tags->tags))
							@foreach ($content_tags->tags as $key => $value)
								<li class="list-inline-item">
									<a title="{{ $value->title }}" href="{{ $value->link }}">{{ $value->title }}</a>
								</li>
							@endforeach
						@endif
					@endif
				</ul>
			</div>
		</div>
	</div>
</section>