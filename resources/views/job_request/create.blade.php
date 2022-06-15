<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　&gt;　<span>サービスをリクエストする</span>
			</div>
		</div>
		<div class="btnFixed"><a href="{{ route('post') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>

		<div id="contents">
			<div class="cancelWrap">
				<div class="inner inner05">
					<h2 class="subPagesHd">サービスをリクエストする<a href="{{ route('support') }}" class="more checkGuide">カリビト安心サポートをご確認ください</a></h2>
					<form class="contactForm" method="POST">
						@csrf


							
						<p class="th">カテゴリ<span class="must">必須</span></p>
							@error('category_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="category_id">
								<option value="">選択してください</option>
								@foreach ($categories as $category)
                                    <optgroup label="{{$category->name}}">
                                        @foreach ($category->mProductChildCategory as $child_category)
                                            <option value="{{$child_category->id}}" @if( old('category_id') == $child_category->id ) selected @endif>{{ $child_category->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
							</select>				
						</div>

							
						<p class="th">商品名<span class="must">必須</span></p>
							@error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<input type="text" name="title" value="{{ old('title') }}">
						</div>


						<p class="th">商品の詳細<span class="must">必須</span></p>
							@error('content')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<textarea type="text" name="content">{{ old('content') }}</textarea>
						</div>


						<p class="th">予算<span class="must">必須</span></p>
							@error('price')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<p class="budget"><input type="text" name="price" value="{{ old('price',0) }}"></p>
						</div>
					

						<p class="th">応募期限<span class="must">必須</span></p>
							@error('application_deadline')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<input type="date" name="application_deadline" value="{{ old('application_deadline') }}">
						</div>


						<p class="th">納期希望日</p>
							@error('required_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<input type="date" name="required_date" value="{{ old('required_date') }}">
						</div>
						
							<div class="warnNotes" style="margin-bottom:5px;">
								<p>【対面】：直接会って提供する内容を相手に行います。<br>【非対面】：互いが直接会わずに提供する内容を相手に行います。</p>
							</div>
						<p class="th">仕事体系<span class="must">必須</span></p>
							@error('is_online')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="is_online">
								<option value=" ">選択してください</option>
								<option value="1" @if(old('is_online') == 1) selected @endif>対面</option>
								<option value="0" @if(!is_null(old('is_online')) && old('is_online') == 0) selected @endif>非対面</option>
							</select>
						</div>


						<p class="th">エリア（対面の場合のみ）</p>
							@error('prefecture_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="prefecture_id">
								<option value="">選択してください</option>
								@foreach($prefectures as $prefecture)
								<option value="{{ $prefecture->id }}" @if( old('prefecture_id') == $prefecture->id) selected @endif>{{ $prefecture->name }}</option>
								@endforeach
							</select>
						</div>


						<p class="th">電話相談の受付<span class="must">必須</span></p>
							@error('is_call')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="is_call">
								<option value="">選択してください</option>
								<option value="0" @if(!is_null(old('is_call')) && old('is_call') == 0) selected @endif>電話を受け付ける</option>
								<option value="1" @if(old('is_call') == 1) selected @endif>電話を受け付けない</option>
							</select>
						</div>


						<div class="functeBtns">
							<a href="{{ route('service_preview') }}" class="full">プレビュー画面を見る</a>
							<input type="submit"  class="full green" style="color:white;" formaction="{{ route('job_request.store') }}" value="サービス提供を開始">
							<a href="{{ route('draft') }}" class="full green_o">下書きとして保存</a>
						</div>
					</form>
				</div>
			</div><!--cancelWrap-->

		</div>
	</article>
</x-layout>