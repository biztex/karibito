<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                <a href="{{route('publication')}}">掲載内容一覧</a>　>　
                <a href="{{(url()->previous())}}">リクエストの詳細</a>　>　
                <a href="{{(url()->current())}}">リクエストを編集する</a>
			</div>
		</div>

		<div id="contents">
			<div class="cancelWrap">
				<div class="inner inner05">
					<h2 class="subPagesHd">リクエストを編集する<p class="checkGuideOriginal"><a href="{{ route('support') }}" target="_blank">カリビト安心サポートをご確認ください</a></p></h2>
					<form class="contactForm" method="POST">
						@csrf

                        <input type="hidden" value="{{ $job_request->id }}" name="id">

						<p class="th">カテゴリ<span class="must">必須</span></p>
							@error('category_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="category_id">
								<option value="">選択してください</option>
								@foreach (App\Models\MProductCategory::all() as $category)
                                    <optgroup label="{{$category->name}}">
                                        @foreach ($category->mProductChildCategory as $child_category)
                                            <option value="{{$child_category->id}}" @if( old('category_id' , $job_request->category_id) == $child_category->id ) selected @endif>{{ $child_category->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
							</select>
						</div>


						<p class="th">サービス名<span class="must">必須</span></p>
							@error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<input type="text" name="title" value="{{ old('title', $job_request->title ) }}" onkeyup="ShowLengthProduct(value);">
							<p class="max-string" id="inputlengthProduct">{{ (mb_strlen(old('title', $job_request->title))) }}/30</p>
						</div>

						<p class="th">サービスの詳細<span class="must">必須</span></p>
							@error('content')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<textarea type="text" name="content" onkeyup="ShowLengthProductShow(value);">{{ old('content', $job_request->content) }}</textarea>
							<p class="max-string" id="inputlengthProductShow">{{ mb_strlen(old('content', $job_request->content)) }}/3000</p>
						</div>


						<p class="th">予算<span class="must">必須</span></p>
							@error('price')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<p class="budget"><input type="text" name="price" value="{{ old('price', $job_request->price ) }}"></p>
						</div>


						<p class="th">応募期限<span class="must">必須</span></p>
							@error('application_deadline')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<input type="date" name="application_deadline" value="{{ old('application_deadline', $job_request->application_deadline) }}" style="color:#333">
						</div>


						<p class="th">納期希望日</p>
							@error('required_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<input type="date" name="required_date" value="{{ old('required_date', $job_request->required_date ) }}" style="color:#333">
						</div>

							<div class="warnNotes" style="margin-bottom:5px;">
								<p>【対面】：お互いが直接会ってサービスを提供します。<span style="color:red;">対面の場合、本人確認が必要になります。</span><br>【非対面】：お互いが直接会わずに、オンライン上などで、サービスを提供します。</p>
							</div>
						<p class="th">仕事体系<span class="must">必須</span></p>
							@error('is_online')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="is_online">
								<option value="">選択してください</option>
								@foreach (App\Models\Product::IS_ONLINE as $k => $v)
									<option value="{{ $k }}" @if(!is_null(old('is_online', $job_request->is_online)) == $k) selected @endif>{{ $v }}</option>
								@endforeach
							</select>
						</div>


						<p class="th">エリア（対面・どちらでもの場合のみ）</p>
							@error('prefecture_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="prefecture_id">
								<option value="">選択してください</option>
								@foreach(App\Models\Prefecture::all() as $prefecture)
								<option value="{{ $prefecture->id }}" @if( old('prefecture_id', $job_request->prefecture_id) == $prefecture->id ) selected @endif>{{ $prefecture->name }}</option>
								@endforeach
							</select>
						</div>


						{{-- <p class="th">電話相談の受付<span class="must">必須</span></p>
							@error('is_call')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<div class="td">
							<select name="is_call">
								<option value="">選択してください</option>
								<option value="0" @if(!is_null(old('is_call', $job_request->is_call )) && old('is_call', $job_request->is_call ) == 0) selected @endif>電話を受け付けない</option>
								<option value="1" @if(old('is_call', $job_request->is_call ) == 1) selected @endif>電話を受け付ける</option>
							</select>
						</div> --}}
                        <input type="hidden" value="{{ $job_request->created_at }}" name="created_at">


                        <div class="functeBtns">
							<input type="submit" class="full" style="color:white;" formaction="{{ route('job_request.edit.preview',$job_request->id) }}" value="プレビュー画面を見る">
							<input type="submit"  class="full green" style="color:white;" formaction="{{ route('job_request.update',$job_request->id) }}" value="リクエストを登録する">
							<input type="submit" class="full green_o" formaction="{{ route('job_request.update.draft', $job_request->id) }}" value="下書きとして保存">

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
