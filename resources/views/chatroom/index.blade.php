<x-layout>
    <article>
    <x-parts.post-button/>
        <div id="breadcrumb">
			<div class="inner">
				<a href="{{route('home')}}">ホーム</a>　>　<span>やり取り一覧</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.ban-msg/>
        <div id="contents">
			<div class="cancelWrap chatroomIndex">
				<div class="inner02">
					<h2 class="subPagesHd">やりとり</h2>
					<div class="tabWrap">
						<div class="indexTab tabWrap">
							<div class="inner">
								<ul class="tabLink">
									<li><a href="#seller_tab_box01" class="is_active">出品に関するやりとり</a></li>
									<li><a href="#buyer_tab_box02">購入に関するやりとり</a></li>
								</ul>
							</div>
						</div>
						@include('chatroom.parts.index.seller')
                        @include('chatroom.parts.index.buyer')
					</div>
				</div><!--inner-->
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>
