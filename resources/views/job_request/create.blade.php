<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　&gt;　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                <a href="{{ route('post') }}">投稿する</a>　>　
                <a href="{{ route('job_request.create') }}">サービスをリクエストする</a>
			</div>
		</div>

		<div id="contents">
			<div class="cancelWrap">
				<div class="inner inner05">
					<h2 class="subPagesHd">サービスをリクエストする<p class="checkGuideOriginal"><a href="{{ route('support') }}" target="_blank">カリビト安心サポートをご確認ください</a></p></h2>
					<form class="contactForm" id="form" method="POST">
						@csrf



						<p class="th">カテゴリ<span class="must">必須</span></p>
							@error('category_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="category_id">
								<option value="">選択してください</option>
								@foreach (App\Models\MProductCategory::all() as $category)
                                    <optgroup label="{{$category->name}}">
                                        @foreach ($category->mProductChildCategory as $child_category)
                                            <option value="{{$child_category->id}}" @if( old('category_id', $request->category_id) == $child_category->id ) selected @endif>{{ $child_category->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
							</select>
						</div>

						<p class="th">リクエスト名<span class="must">必須</span></p>
							@error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
								<input type="text" name="title" value="{{ old('title') }}" onkeyup="ShowLengthProduct(value);">
                <p class="max-string" id="inputlengthProduct">{{ mb_strlen(old('title')) }}/30</p>
						</div>


						<p class="th">リクエスト詳細（30文字以上）<span class="must">必須</span></p>
							@error('content')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<textarea type="text" name="content" onkeyup="ShowLengthProductShow(value);">{{ old('content', $request->content) }}</textarea>
							<p class="max-string" id="inputlengthProductShow">{{ mb_strlen(old('content')) }}/3000</p>
						</div>


						<p class="th">予算<span class="must">必須</span></p>
							@error('price')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<p class="budget"><input type="text" placeholder="0" name="price" value="{{ old('price', $request->price) }}"></p>
						</div>


						<p class="th">応募期限<span class="must">必須</span></p>
							@error('application_deadline')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<input type="date" name="application_deadline" value="{{ old('application_deadline', $request->application_deadline) }}" style="color:#333">
						</div>


						<p class="th">納期希望日</p>
							@error('required_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<input type="date" name="required_date" value="{{ old('required_date', $request->required_date) }}" style="color:#333">
						</div>

						<p class="th">仕事体系<span class="must">必須</span></p>
						<div class="warnNotes" style="margin-bottom:5px; margin-top: 0;">
							<p>
								【対面】：お互いが直接会ってサービスを提供します。<span style="color:red;">対面の場合、本人確認が必要になります。</span>
								<br>【非対面】：お互いが直接会わずに、オンライン上などで、サービスを提供します。
								<div class="flex">
									<span>【どちらでも】：</span>
									<div class="inlineBlock">
										対面と非対面どちらの体系でもサービスを提供します。
										<br>
										<span style="color:red;">どちらでもの場合、本人確認が必要になります。</span>
									</div>
								</div>
							</p>
						</div>
						@error('is_online')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="is_online">
								<option value="">選択してください</option>
								@foreach (App\Models\Product::IS_ONLINE as $k => $v)
									<option value="{{ $k }}" @if(!is_null(old('is_online')) && old('is_online') == $k) selected @endif>{{ $v }}</option>
								@endforeach
							</select>
						</div>


						<p class="th">エリア（対面・どちらでもの場合のみ）</p>
							@error('prefecture_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="prefecture_id">
								<option value="">選択してください</option>
								@foreach(App\Models\Prefecture::all() as $prefecture)
								<option value="{{ $prefecture->id }}" @if( old('prefecture_id', $request->prefecture_id) == $prefecture->id) selected @endif>{{ $prefecture->name }}</option>
								@endforeach
							</select>
						</div>


						{{-- <p class="th">電話相談の受付<span class="must">必須</span></p>
							@error('is_call')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="is_call">
								<option value="">選択してください</option>
								<option value="1" @if(old('is_call', $request->is_call) == 1) selected @endif>電話を受け付ける</option>
								<option value="0" @if(!is_null(old('is_call', $request->is_call)) && old('is_call', $request->is_call) == 0) selected @endif>電話を受け付けない</option>
							</select>
						</div> --}}


						<div class="functeBtns">
							<input type="submit" class="full loading-disabled" style="color:white;" formaction="{{ route('job_request.preview') }}" value="プレビュー画面を見る">
							<input type="submit"  class="full green loading-disabled" style="color:white;" formaction="{{ route('job_request.store') }}" value="リクエストを登録する">
							<input type="submit" class="full green_o loading-disabled" formaction="{{ route('job_request.store.draft') }}" value="下書きとして保存">
						</div>
					</form>
				</div>
			</div><!--cancelWrap-->

		</div>
	</article>
</x-layout>

<script>
	// 打ち込んだ文字数の表示
	function ShowLengthProduct( str ) {
			document.getElementById("inputlengthProduct").innerHTML = str.length + "/30";
	}

    function ShowLengthProductShow( str ) {
        document.getElementById("inputlengthProductShow").innerHTML = str.length + "/3000";
    }
</script>
