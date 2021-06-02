<?php 
	$vote_info = getListStarProduct($data);
 	$averageVote = getStarProduct($data);
 ?>
<div class="info-rait">
	<div class="row">
		<div class="col-md-5">
			<div class="left">
				<div class="numb-rait">
					@if ($averageVote > 0)
						<span>{{ $averageVote }}</span>
						@for ($i = 1; $i <= round($averageVote); $i++)
							<i class="fa fa-star"></i>
						@endfor
						@for ($i = 0; $i < 5- round($averageVote); $i++)
							<i class="fa fa-star-o"></i>
						@endfor
						<label for="">{{ @$vote_info['all']['total_vote']  }} đánh giá</label>
					@endif
				</div>
				<div class="list-review">
					<div class="item">
						<div class="nb" data-star="5">5 <i class="fa fa-star"></i></div>
						<div class="line"><div class="per" style="width: {{ number_format($vote_info['5']['percent']) }}%"></div></div>
						<div class="percent">{{ number_format($vote_info['5']['percent']) }}%<span> | {{ number_format($vote_info['5']['total_vote']) }} đánh giá</span></div>
					</div>
					<div class="item">
						<div class="nb" data-star="4">4 <i class="fa fa-star"></i></div>
						<div class="line"><div class="per" style="width:{{ number_format($vote_info['4']['percent']) }}%"></div></div>
						<div class="percent">{{ number_format($vote_info['4']['percent']) }}%<span> | {{ number_format($vote_info['4']['total_vote']) }} đánh giá</span></div>
					</div>
					<div class="item">
						<div class="nb" data-star="3">3 <i class="fa fa-star"></i></div>
						<div class="line"><div class="per" style="width: {{ number_format($vote_info['3']['percent']) }}%"></div></div>
						<div class="percent">{{ number_format($vote_info['3']['percent']) }}%<span> | {{ number_format($vote_info['3']['total_vote']) }} đánh giá</span></div>
					</div>
					<div class="item">
						<div class="nb" data-star="2">2 <i class="fa fa-star"></i></div>
						<div class="line"><div class="per" style="width: {{ number_format($vote_info['2']['percent']) }}%"></div></div>
						<div class="percent">{{ number_format($vote_info['2']['percent']) }}%<span> | {{ number_format($vote_info['2']['total_vote']) }} đánh giá</span></div>
					</div>
					<div class="item">
						<div class="nb" data-star="1">1 <i class="fa fa-star"></i></div>
						<div class="line"><div class="per" style="width: {{ number_format($vote_info['1']['percent']) }}%"></div></div>
						<div class="percent">{{ number_format($vote_info['1']['percent']) }}%<span> | {{ number_format($vote_info['1']['total_vote']) }} đánh giá</span></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="right">
				<div class="tieuchi">
					<div class="title-tieuchi">Theo tiêu chí ({{ !empty($data->vote_question) ? $data->vote_question : 0 }} đánh giá)</div>
					<div class="list-tieuchi">
						@if (count($data->ProductQuestions()->order()->get()))
    						@foreach ($data->ProductQuestions()->order()->get() as $item)
								<div class="item">
									<p>{{ $item->content }}</p>
									<div class="bar-tc">
										<div class="co">{{ getPercentVoteYesQuestions($item) }}% <span>Có</span></div>
										<div class="line"><div class="per" style="width: {{ getPercentVoteYesQuestions($item) }}%"></div></div>
										<div class="khong">{{ getPercentVoteNoQuestions($item) }}% <span>Không</span></div>
									</div>
								</div>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>