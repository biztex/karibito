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
					<div class="subPagesTab st2 tabWrap">
						<ul class="tabLink">
							<li><a href="#tab_box01" class="is_active">進行中のやりとり</a></li>
							<li><a href="#tab_box02" class="" id="box02">過去のやりとり</a></li>
						</ul>

						@include('chatroom.parts.index.active')

            @if(empty($value->buyerUser) && empty($value->sellerUser))
              <p style="margin:20px;">やりとりしていたユーザーはおりません。</p>
            @else
						  @include('chatroom.parts.index.inactive')
            @endif
					</div>
				</div><!--inner-->
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>