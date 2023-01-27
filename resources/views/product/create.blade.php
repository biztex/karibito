<x-layout>
    <article>

        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　&gt;　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                <a href="{{ route('post') }}">投稿する</a>　>　
                <a href="{{ route('product.create') }}">サービスを出品する</a>
            </div>
        </div>
        <div id="contents">
            <div class="cancelWrap">
                <div class="inner inner05">
                    <h2 class="subPagesHd">サービスを出品する<p class="checkGuideOriginal"><a href="{{ route('support') }}" target="_blank">カリビト安心サポートをご確認ください</a></p></h2>
                    <form method="post" id="form"  class="contactForm" enctype="multipart/form-data">
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

                        <p class="th">サービス名<span class="must">必須</span></p>
                            @error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
							<input type="text" name="title" value="{{ old('title',$request->title) }}" onkeyup="ShowLengthProduct(value);">
                            <p class="max-string" id="inputlengthProduct">{{ mb_strlen(old('title')) }}/30</p>
                        </div>

                        <p class="th">サービスの詳細<span class="must">必須</span></p>
                            @error('content')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <textarea type="text" name="content" onkeyup="ShowLengthProductShow(value);">{{ old('content', $request->content) }}</textarea>
                            <p class="max-string" id="inputlengthProductShow">{{ mb_strlen(old('content')) }}/3000</p>
                        </div>

                        <p class="th">価格<span class="must">必須</span></p>
                            @error('price')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <p class="budget price"><input type="text" placeholder="0" name="price" value="{{ old('price', $request->price) }}"></p>
                        </div>

                        <div class="td">
                            <div class="warnNotes">
                                <p>【対面】：お互いが直接会ってサービスを提供します。<span style="color:red;">対面の場合、本人確認が必要になります。</span>
                                <br>
                                【非対面】：お互いが直接会わずに、オンライン上などで、サービスを提供します。</p>
                            </div>
                        </div>
                        <p class="th">仕事体系<span class="must">必須</span></p>
                            @error('is_online')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="is_online">
                                <option value="">選択してください</option>
                                <option value="{{App\Models\Product::OFFLINE}}" @if(!is_null(old('is_online', $request->is_online)) && old('is_online', $request->is_onine) == App\Models\Product::OFFLINE) selected @endif>対面</option>
                                <option value="{{App\Models\Product::ONLINE}}" @if(old('is_online', $request->is_online) == App\Models\Product::ONLINE) selected @endif>非対面</option>
                            </select>
                        </div>

                        <p class="th">エリア（対面の場合のみ）</p>
                            @error('prefecture_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="prefecture_id">
                                <option value="">選択してください</option>
                                @foreach(App\Models\Prefecture::all() as $prefecture)
                                    <option value="{{ $prefecture->id }}" @if( old('prefecture_id', $request->prefecture_id) == $prefecture->id) selected @endif>{{ $prefecture->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <p class="th">所要期間<span class="must">必須</span></p>
                            @error('time_unit')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            @error('number_of_day')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <select name="time_unit">
                            <option value="">選択してください</option>
                            <option value="1" {{ old('time_unit') == 1 ? 'selected' : ''}}>日にち</option>
                            <option value="2" {{ old('time_unit') == 2 ? 'selected' : ''}}>時間</option>
                        </select>
                        <div class="td">
                            <p class="time"><input type="number" name="number_of_day" value="{{ old('number_of_day', $request->number_of_day) }}" placeholder="入力してください"></p>
                        </div>

                        {{-- <p class="th">電話相談の受付<span class="must">必須</span></p>
                            @error('is_call')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="is_call">
                                <option value="">選択してください</option>
                                <option value="{{App\Models\Product::ON_CALL}}" @if(old('is_call', $request->is_call) == App\Models\Product::ON_CALL) selected @endif>電話を受け付ける</option>
                                <option value="{{App\Models\Product::OFF_CALL}}" @if(!is_null(old('is_call', $request->is_call)) && old('is_call', $request->is_call) == App\Models\Product::OFF_CALL) selected @endif>電話を受け付けない</option>
                            </select>
                        </div> --}}

                        <p class="th">販売数<span class="must">必須</span></p>
                            @error('number_of_sale')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="number_of_sale">
                                <option value="">選択してください</option>
                                <option value="{{App\Models\Product::ONE_OF_SALE}}" @if(!is_null(old('number_of_sale', $request->number_of_sale)) && old('number_of_sale', $request->number_of_sale) == App\Models\Product::ONE_OF_SALE) selected @endif>１人様限定</option>
                                <option value="{{App\Models\Product::UNLIMITED_OF_SALE}}" @if(old('number_of_sale', $request->number_of_sale) == App\Models\Product::UNLIMITED_OF_SALE) selected @endif>無制限</option>
                            </select>
                        </div>

                        <div class="formOptionsArea">
                            @if(old('option_name'))
                                @foreach(old('option_name') as $k => $v)
                                    <div class="js-optionForm">
                                        <p class="th">有料オプション {{$k + 1}}</p>
                                        @error('option_name.'.$k)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="paid">
                                                <div class="enter">
                                                    <textarea class="" type="text" name="option_name[]" placeholder="入力してください">{{ $v }}</textarea>
                                                </div>
                                                <div class="selects">
                                                    <select name="option_price[]">
                                                        @foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)
                                                            <option value="{{ $key }}" @if(old('option_price.'.$k) == $key) selected @endif>
                                                                {{ $value }}円
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <select name="option_is_public[]">
                                                        <option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if(old('option_is_public.'.$k) == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif>公開</option>
                                                        <option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public.'.$k)) && old('option_is_public.'.$k) == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif>非公開</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <a href="javascript:;" class="fs25 ml05 js-deleteOption">×</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif(collect($request->option_name)->isNotEmpty())
                                @foreach($request->option_name as $num => $additional_option)
                                    <div class="js-optionForm">
                                        <p class="th">有料オプション {{$num + 1}}</p>
                                        @error('option_name.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="paid">
                                                <div class="enter">
                                                    <textarea class="" type="text" name="option_name[]" placeholder="入力してください">{{ old('option_name.'.$num, $additional_option) }}</textarea>
                                                </div>
                                                <div class="selects">
                                                    <select name="option_price[]">
                                                        @foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)
                                                            <option value="{{ $key }}" @if(old('option_price.'.$num, $request->option_price[$num]) == $key) selected @endif>
                                                            {{ $value }}円
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <select name="option_is_public[]">
                                                        <option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if((old('option_is_public.'.$num, $request->option_is_public[$num])) == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif>公開</option>
                                                        <option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public.'.$num, $request->option_is_public[$num])) && old('option_is_public.'.$num, $request->option_is_public[$num]) == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif>非公開</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <a href="javascript:;" class="fs25 ml05 js-deleteOption">×</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="js-optionForm">
                                    <p class="th">有料オプション1</p>
                                    @error('option_name.'.'0')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    <div class="td">
                                        <div class="paid">
                                            <div class="enter">
                                                <textarea type="text" name="option_name[]" placeholder="入力してください">{{ old('option_name[]') }}</textarea>
                                            </div>
                                            <div class="selects">
                                                <select name="option_price[]">
                                                    @foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)
                                                        <option value="{{ $key }}" @if(old('option_price.0') == $key) selected @endif>
                                                            {{ $value }}円
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <select name="option_is_public[]">
                                                    <option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if(old('option_is_public') == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif>公開</option>
                                                    <option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public')) && old('option_is_public') == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif>非公開</option>
                                                </select>
                                            </div>
                                            <div>
                                                <a href="javascript:;" class="fs25 ml05 js-deleteOption">×</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <p class="specialtyBtn"><a href="javascript:;" onclick="addOption();"><img src="/img/mypage/icon_add.svg" alt="">有料オプションを追加</a></p>

                        <div class="formQuestionsArea">
                            @if((old('question_title') || old('answer')))
                                @foreach(old('question_title') as $k => $v)
                                    <div class="js-questionForm">
                                        <p class="th js-title">質問のタイトル {{$k + 1}}</p>
                                        @error('question_title.'.$k)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="enter">
                                                <textarea type="text" name="question_title[]" placeholder="質問のタイトル入力してください">{{$v}}</textarea>
                                                {{-- 一旦コメントアウト(岩上) --}}
                                                {{-- <!-- <p class="max-string" >{{ mb_strlen(old('question_title.'.$k)) }</p> --> --}}
                                            </div>
                                            <p class="th js-answer">質問の回答 {{$k + 1}}</p>
                                            @error('answer.'.$k)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            <div class="enter">
                                                <textarea type="text" name="answer[]" placeholder="質問の回答入力してください">{{ old('answer.'.$k)}}</textarea>
                                                {{-- 一旦コメントアウト(岩上) --}}
                                                {{-- <p class="max-string" ></p> --}}
                                            </div>
                                            <div>
                                                <a href="javascript:;" class="fs25 ml05 js-deleteQuestion">×</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif(collect($request->question_title)->isNotEmpty())
                                @foreach($request->question_title as $num => $product_question)
                                    <div class="js-questionForm">
                                        <p class="th js-title">質問のタイトル {{$num + 1}}</p>
                                        @error('question_title.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="enter">
                                                <textarea type="text" name="question_title[]" placeholder="質問のタイトル入力してください">{{ old('question_title.'.$num, $product_question) }}</textarea>
                                                {{-- 一旦コメントアウト(岩上) --}}
                                                {{-- <!-- <p class="max-string" >{{ mb_strlen(old('question_title')) }}</p> --> --}}
                                            </div>
                                            <p class="th js-answer">質問の回答 {{$num + 1}}</p>
                                            @error('answer.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            <div class="enter">
                                                <textarea type="text" name="answer[]" placeholder="質問の回答入力してください">{{ old('answer.'.$num, $request->answer[$num]) }}</textarea>
                                                {{-- 一旦コメントアウト(岩上) --}}
                                                {{-- <p class="max-string" >{{ mb_strlen(old('answer')) }}</p> --}}
                                            </div>
                                            <div>
                                                <a href="javascript:;" class="fs25 ml05 js-deleteQuestion">×</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="js-questionForm">
                                    <p class="th js-title">質問のタイトル1</p>
                                    @error('question_title.'.'0')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    <div class="td">
                                        <div class="enter">
                                            <textarea type="text" name="question_title[]" placeholder="質問のタイトル入力してください"></textarea>
                                            {{-- 一旦コメントアウト(岩上) --}}
                                            {{-- <p class="max-string">{{ mb_strlen(old('question_title')) }}</p> --}}
                                        </div>
                                        <p class="th js-answer">質問の回答1</p>
                                        @error('answer.'.'0')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="enter">
                                            <textarea type="text" name="answer[]" placeholder="質問の回答入力してください"></textarea>
                                            {{-- 一旦コメントアウト(岩上) --}}
                                            {{-- <p class="max-string">{{ mb_strlen(old('answer')) }}</p> --}}
                                        </div>
                                        <div>
                                            <a href="javascript:;" class="fs25 ml05 js-deleteQuestion">×</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <p class="specialtyBtn"><a href="javascript:;" onclick="addQuestion();"><img src="/img/mypage/icon_add.svg" alt="">よくある質問を追加</a></p>

                        <div class="formLinksArea">
                            @if(old('youtube_link'))
                                @foreach(old('youtube_link') as $k => $v)
                                    <div class="js-youtubeForm">
                                        <p class="th js-link">動画(YouTubeのみ) {{$k + 1}}</p>
                                        @error('youtube_link.'.$k)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="enter">
                                                <input type="text" name="youtube_link[]" placeholder="YouTubeのリンクを入力してください" value="{{$v}}">
                                            </div>
                                            <div>
                                                <a href="javascript:;" class="fs25 ml05 js-deleteYoutube">×</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif(collect($request->youtube_link)->isNotEmpty())
                                @foreach($request->youtube_link as $num => $link)
                                    <div class="js-youtubeForm">
                                        <p class="th js-link">動画(YouTubeのみ) {{$num + 1}}</p>
                                        @error('youtube_link.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="enter">
                                                <input type="text" name="youtube_link[]" placeholder="YouTubeのリンクを入力してください" value="{{ old('youtube_link.'.$num, $link) }}">
                                            </div>
                                            <div>
                                                <a href="javascript:;" class="fs25 ml05 js-deleteYoutube">×</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="js-youtubeForm">
                                    <p class="th js-link">動画(YouTubeのみ)</p>
                                    @error('youtube_link.'.'0')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    <div class="td">
                                        <div class="enter">
                                            <input type="text" name="youtube_link[]" placeholder="YouTubeのリンクを入力してください" {{ old('title',$request->title) }}>
                                        </div>
                                        <div>
                                            <a href="javascript:;" class="fs25 ml05 js-deleteYoutube">×</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <p class="specialtyBtn"><a href="javascript:;" onclick="addYoutube();"><img src="/img/mypage/icon_add.svg" alt="">動画を追加</a></p>
                        <p class="small ml-2 mb-0">対応URL形式</p>
                        <p class="small ml-2 mb-0">https://www.youtube.com/watch?v=xxxxxxxxxx</p>
                        <p class="small ml-2 mb-0">https://youtube/xxxxxxxxxx</p>

                        <p class="th">画像投稿<span class="must">必須</span></p>
                        <div class="td">
                            @error('product_pic')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <div class="warnNotes">
                                <p class="danger">写真を追加する<font class="colorRed">（１枚目は必須）</font></p>
                                <p>カメラマークをタップして、写真をアップロードしてください。<br>複数の写真がアップロード可能です。<br>写真はサービス詳細画面に、ポートフォリオとして表示されます。<br>※登録１枚目の画像がサムネイルとして表示されます。</p>
                            </div>
                            @error('base64_text.0')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <ul class="mypagePortfolioUl03 mt40">
                                @for($i = 0; $i < 10; $i++)
                                    <li>
                                        <div id="product_pic{{$i}}" class="img">
                                                @if(old('image_status'.$i, $request['image_status'.$i] ) === "delete")
                                                    <img id="preview_product{{$i}}" src="/img/service/img_provide.jpg" alt="" style="width: 144px;height: 144px;object-fit: cover;">
                                                    <input type="file" name="paths[{{$i}}]" accept="image/*" style="display:none;" multiple>
                                                    <input type="hidden" name="base64_text[{{$i}}]" value="{{ old('base64_text.'.$i) }}">
                                                @elseif(old('image_status'.$i, $request['image_status'.$i] ) === "insert")
                                                    <img id="preview_product{{$i}}" src="{{ old('base64_text.'.$i)}}" alt="" style="width: 144px;height: 144px;object-fit: cover;">
                                                    <input type="file" name="paths[{{$i}}]" accept="image/*" style="display:none;" multiple >
                                                    @if($request->base64_text)
                                                        <input type="hidden" name="base64_text[{{$i}}]" value="{{ old('base64_text.'.$i, $request->base64_text[$i]) }}">
                                                    @else
                                                        <input type="hidden" name="base64_text[{{$i}}]" value="{{ old('base64_text.'.$i) }}">
                                                    @endif
                                                @else
                                                    <img id="preview_product{{$i}}" src="/img/service/img_provide.jpg" alt="" style="width: 144px;height: 144px;object-fit: cover;">
                                                    <input type="file" name="paths[{{$i}}]" accept="image/*" style="display:none;" multiple>
                                                    <input type="hidden" name="base64_text[{{$i}}]" value="{{ old('base64_text.'.$i) }}">
                                                @endif
                                        </div>
                                        <div class="fun">
                                            <div class="del" id="storage_delete{{$i}}">削除</div>
                                        </div>
                                    </li>
                                <input type="hidden" name="image_status{{$i}}" value="{{ old('image_status'.$i, $request['image_status'.$i]) }}">
                                @endfor
                            </ul>
                        </div>

                        <p class="th">公開設定<span class="must">必須</span></p>
                        <div class="td">
                            @error('status')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <select name="status">
                                <option value="">選択してください</option>
                                <option value="{{App\Models\Product::STATUS_PUBLISH}}" @if(old('status', $request->status) == App\Models\Product::STATUS_PUBLISH) selected @endif>公開</option>
                                <option value="{{App\Models\Product::STATUS_PRIVATE}}" @if(old('status', $request->status) == App\Models\Product::STATUS_PRIVATE) selected @endif>非公開</option>
                            </select>
                        </div>
                        <div class="functeBtns">
                            <input type="submit" class="full loading-disabled" style="color:white;" formaction="{{ route('product.preview') }}" value="プレビュー画面を見る">
                            <input type="submit" class="full green loading-disabled" style="color:white;" formaction="{{ route('product.store') }}" value="サービスを登録する">
                            <input type="submit" class="full green_o loading-disabled" formaction="{{ route('product.store.draft') }}" value="下書きとして保存">
                        </div>
                    </form>
                </div>
            </div><!--cancelWrap-->
        </div>
    </article>
</x-layout>
<script>
$(function(){

    for (let i = 0; i < 10; i++) {
		if (localStorage.getItem('status'+i) === "delete") {
			$("input[name='image_status"+i+"']").attr('value',"{{ old('image_status'.$i,'delete')}}");
			$("#preview_product"+i).attr('src', '/img/service/img_provide.jpg');
		} else if (localStorage.getItem('status'+i) === "insert") {
			$("input[name='image_status"+i+"']").attr('value',"{{ old('image_status'.$i,'insert')}}");
			$("input[name='base64_text["+i+"]']").val(localStorage.getItem("pic"+i));
			$("#preview_product"+i).attr('src',  localStorage.getItem("pic"+i));
		}
	}

        delOption(); // 追加されたボタンのイベントが発火されないためここで呼び出す
        delQuestion();
        delYoutube();
    })
    function addOption(){
        let str = '<div class="js-optionForm"><p class="th">有料オプション%NUM%</p>@error('option_name.'.'%NUM%')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="td"> <div class="paid"> <div class="enter"><textarea type="text" name="option_name[]" placeholder="入力してください">{{ old('option_name.'.'%NUM%') }}</textarea> </div> <div class="selects"><select name="option_price[]">@foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)<option value="{{ $key }}" @if(old('option_price.'.'%NUM%') == $key) selected @endif>{{ $value }}円</option>@endforeach</select><select name="option_is_public[]"><option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if(old('option_is_public.'.'%NUM%') == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif>公開</option><option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public'.'%NUM%')) && old('option_is_public.'.'%NUM%') == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif>非公開</option></select></div><div><a href="javascript:;" class="fs25 ml05 js-deleteOption">×</a></div></div></div></div></div>'
        let number_js_optionForm = $(".formOptionsArea").children(".js-optionForm").length;

        if (number_js_optionForm < 10) {
            str = str.replace(/%\w+%/g, number_js_optionForm + 1);
            $('.formOptionsArea').append(str);
            delOption(); // 追加されたボタンのイベントが発火されないためここで呼び出す
        }
    }

    function delOption(){
        $('.js-deleteOption').on('click', function () {
            let number_js_optionForm = $(".formOptionsArea").children(".js-optionForm").length;
            if (number_js_optionForm > 1 ) {
                $(this).parents('.js-optionForm').remove(); //divだけを消す
                $(".formOptionsArea").children(".js-optionForm").each(function(index, element){
                    $(element).children(".th").text("有料オプション" + (index + 1));
                })
            }
        });
    }

    function addQuestion(){
        let str = '<div class="js-questionForm"><p class="th js-title">質問のタイトル%NUM%</p><div class="td">@error('question_title.'.'%NUM%')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="enter"> <textarea type="text" name="question_title[]" placeholder="質問のタイトル入力してください"></textarea></div><p class="th js-answer">質問の回答%NUM%</p>@error('answer')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="enter"><textarea type="text" name="answer[]" placeholder="質問の回答入力してください"></textarea> </div><div> <a href="javascript:;" class="fs25 ml05 js-deleteQuestion">×</a> </div></div></div>'
        let number_js_questionForm = $(".formQuestionsArea").children(".js-questionForm").length;

        if(number_js_questionForm < 10) {
            str = str.replace(/%\w+%/g, number_js_questionForm + 1);
            $('.formQuestionsArea').append(str);
        }
        delQuestion();
    }

    function delQuestion() {
        $('.js-deleteQuestion').click(function(){
            let number_js_questionForm = $(".formQuestionsArea").children(".js-questionForm").length;
            if (number_js_questionForm > 1 ) {
                $(this).parents('.js-questionForm').remove(); //divだけを消す
                $(".formQuestionsArea").children(".js-questionForm").each(function(index, element){
                    $(element).find(".js-title").text("質問のタイトル" + (index + 1));
                    $(element).find(".js-answer").text("質問の回答" + (index + 1));
                })
            }
        });
    }

    function addYoutube() {
        let str = '<div class="js-youtubeForm"><p class="th js-link">動画(YouTubeのみ)%NUM%</p><div class="td">@error('js-link.'.'%NUM%')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="enter"> <input type="text" name="youtube_link[]" placeholder="YouTubeのリンクを入力してください"></div><div> <a href="javascript:;" class="fs25 ml05 js-deleteYoutube">×</a> </div></div></div>'
        let number_js_youtubeForm = $(".formLinksArea").children(".js-youtubeForm").length;

        if(number_js_youtubeForm < 10) {
            str = str.replace(/%\w+%/g, number_js_youtubeForm + 1);
            $('.formLinksArea').append(str);
        }
        delYoutube();
    }

    function delYoutube() {
        $('.js-deleteYoutube').click(function(){
            let number_js_youtubeForm = $(".formLinksArea").children(".js-youtubeForm").length;
            if (number_js_youtubeForm > 1 ) {
                $(this).parents('.js-youtubeForm').remove(); //divだけを消す
                $(".formLinksArea").children(".js-youtubeForm").each(function(index, element){
                    $(element).find(".js-link").text("動画(YouTubeのみ)" + (index + 1));
                })
            }
        });
    }
    
    // 打ち込んだ文字数の表示
    function ShowLengthProduct( str ) {
        document.getElementById("inputlengthProduct").innerHTML = str.length + "/30";
    }

    function ShowLengthProductShow( str ) {
        document.getElementById("inputlengthProductShow").innerHTML = str.length + "/3000";
    }
</script>
