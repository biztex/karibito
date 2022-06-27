<x-layout>
    <article>

        <div id="breadcrumb">
            <div class="inner">
                <a href="index.html">ホーム</a>　&gt;　<span>サービスを提供する</span>
            </div>
        </div>

        <div id="contents">
            <div class="cancelWrap">
                <div class="inner inner05">
                    <h2 class="subPagesHd">サービスを提供する<a href="{{ route('support') }}" class="more checkGuide">カリビト安心サポートをご確認ください</a></h2>
                    <form method="post" class="contactForm" enctype="multipart/form-data">
                        @csrf

                        <p class="th">カテゴリ<span class="must">必須</span></p>
                        @error('category_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="category_id">
                                <option value="">選択してください</option>
                                @foreach ($categories as $category)
                                    <optgroup label="{{$category->name}}">
                                        @foreach ($category->mProductChildCategory as $child_category)
                                            <option value="{{$child_category->id}}"
                                                    @if( old('category_id') == $child_category->id ) selected @endif>{{ $child_category->name }}</option>
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

                        <p class="th">価格<span class="must">必須</span></p>
                            @error('price')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <p class="budget price"><input type="text" placeholder="0" name="price" value="{{ old('price') }}"></p>
                        </div>

                        <div class="td">
                            <div class="warnNotes">
                                <p>【対面】：直接会って提供する内容を相手に行います。<br>【非対面】：互いが直接会わずに提供する内容を相手に行います。</p>
                            </div>
                        </div>
                        <p class="th">仕事体系<span class="must">必須</span></p>
                        @error('is_online')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="is_online">
                                <option value="">選択してください</option>
                                <option value="{{App\Models\Product::OFFLINE}}" @if(!is_null(old('is_online')) && old('is_online') == App\Models\Product::OFFLINE) selected @endif>対面</option>
                                <option value="{{App\Models\Product::ONLINE}}" @if(old('is_online') == App\Models\Product::ONLINE) selected @endif>非対面</option>
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

                        <p class="th">所要期間<span class="must">必須</span></p>
                            @error('number_of_day')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <p class="time"><input type="number" name="number_of_day" value="{{ old('number_of_day') }}" placeholder="入力してください"></p>
                        </div>

                        <p class="th">電話相談の受付<span class="must">必須</span></p>
                        @error('is_call')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="is_call">
                                <option value="">選択してください</option>
                                <option value="{{App\Models\Product::OFF_CALL}}" @if(!is_null(old('is_call')) && old('is_call') == App\Models\Product::OFF_CALL) selected @endif>電話を受け付けない</option>
                                <option value="{{App\Models\Product::ON_CALL}}" @if(old('is_call') == App\Models\Product::ON_CALL) selected @endif>電話を受け付ける</option>
                            </select>
                        </div>

                        <p class="th">販売数<span class="must">必須</span></p>
                            @error('number_of_sale')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="number_of_sale">
                                <option value="">選択してください</option>
                                <option value="{{App\Models\Product::ONE_OF_SALE}}" @if(!is_null(old('number_of_sale')) && old('number_of_sale') == App\Models\Product::ONE_OF_SALE) selected @endif required>１人様限定</option>
                                <option value="{{App\Models\Product::UNLIMITED_OF_SALE}}" @if(old('number_of_sale') == App\Models\Product::UNLIMITED_OF_SALE) selected @endif required>無制限</option>
                            </select>
                        </div>

                        <div class="formOptionsArea">
                            <div class="js-formOption">


                            <p class="th">有料オプション1</p>
                            @error('option_name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <div class="paid">
                                <div class="enter">
                                    <textarea class="@error('option_name[]') is-invalid @enderror" type="text" value="{{ old('option_name[]') }}" name="option_name[]" placeholder="入力してください">{{ old('option_name[]') }}</textarea>
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
                                        <option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public')) && old('option_is_public') == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif required>非公開</option>
                                        <option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if(old('option_is_public') == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif required>公開</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            </div>
                            @if(!is_null(old('option_name.'.'1')))
{{--                                    {{dd(old('option_name.'.'2'))}}--}}
                                @for($i = 1; $i > 5; $i++)
                                    <p class="th">有料オプション%NUM%</p>
                                    @error('option_name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    <div class="td">
                                        <div class="paid">
                                            <div class="enter">
                                                <textarea class="" type="text" value="{{ old('option_name.'.$i) }}" name="option_name[]" placeholder="入力してください">{{ old('option_name.'.$i) }}</textarea>
                                            </div>
                                            <div class="selects">
                                                <select name="option_price[]">
                                                    @foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)
                                                        <option value="{{ $key }}" @if(old('option_price.'.$i) == $key) selected @endif>
                                                            {{ $value }}円
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <select name="option_is_public[]">
                                                    <option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public.'.'0')) && old('option_is_public.'.'0') == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif required>非公開</option>
                                                    <option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if(old('option_is_public.'.'0') == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif required>公開</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif

                        <p class="specialtyBtn"><a href="javascript:;" onclick="addOption();"><img src="img/mypage/icon_add.svg" alt="">有料オプションを追加</a></p>

                        <div class="formFaqArea">
                            <p class="th">質問のタイトル1</p>
                            <div class="td">
                                @error('question_title')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                <div class="enter">
                                    <textarea type="text" name="question_title[]" class="@error('question_title') is-invalid @enderror" value="{{ old('question_title[]') }}" placeholder="質問のタイトル入力してください"></textarea>
                                    <p class="taR">400</p>
                                </div>
{{--                            </div>--}}
                            <p class="th">質問の回答1</p>
{{--                            <div class="td">--}}
                                @error('answer')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                <div class="enter">
                                    <textarea type="text" name="answer[]" class="@error('answer') is-invalid @enderror" value="{{ old('answer[]') }}" placeholder="質問の回答入力してください"></textarea>
                                    <p class="taR">400</p>
                                </div>
                            </div>
                        </div>
                        <p class="specialtyBtn"><a href="javascript:;" onclick="addFaq();"><img src="img/mypage/icon_add.svg" alt="">よくある質問を追加</a></p>

                        <p class="th">画像投稿<span class="must">必須</span></p>
                        <div class="td">
                            <div class="warnNotes">
                                <p class="danger">写真を追加する<font class="colorRed">（１枚目は必須）</font>
                                </p>
                                <p>
                                    カメラマークをタップして、写真をアップロードしてください。<br>複数の写真がアップロード可能です。<br>写真はチケット詳細画面に、ポートフォリオとして表示されます。<br>必須ではございませんので、アップロードなしでも問題ございません。<br>※登録１枚目の画像がサムネイルとして表示されます。
                                </p>
                            </div>
                                    <ul class="mypagePortfolioUl03 mt40">
                                        @for($i = 0; $i < 10; $i++) <li >
                                            <div id="product_pic{{$i}}" class="img">
                                                <img id="preview_product{{$i}}" src="/img/service/img_provide.jpg" alt="" style="width: 144px;height: 144px;object-fit: cover;">
                                                <input type="file" name="paths[{{$i}}]" accept="image/*" style="display:none;" multiple>
                                            </div>
                                            <div class="fun">
                                                <div class="del" id="storage_delete{{$i}}">削除</div>
                                            </div>
                                            </li>
                                        @endfor
                                    </ul>
                                </div>

                                <p class="th">公開設定<span class="must">必須</span></p>
                                <div class="td">
                                    @error('status')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    <select name="status">
                                        <option value="">選択してください</option>
                                        <option value="{{App\Models\Product::STATUS_PRIVATE}}" @if(old('status') == App\Models\Product::STATUS_PRIVATE) selected @endif>非公開</option>
                                        <option value="{{App\Models\Product::STATUS_PUBLISH}}" @if(old('status') == App\Models\Product::STATUS_PUBLISH) selected @endif>公開</option>
                                    </select>
                                </div>
                                <div class="functeBtns">
                                    <input type="submit" class="full" style="color:white;" formaction="{{ route('product.preview') }}" value="プレビュー画面を見る">
                                    <input type="submit" class="full green" style="color:white;" formaction="{{ route('product.store') }}" value="サービス提供を開始">
                                    <input type="submit" class="full green_o" formaction="{{ route('product.storeDraft') }}" value="下書きとして保存">
                                </div>
                    </form>
                </div>
            </div><!--cancelWrap-->
        </div>
    </article>
</x-layout>Z
<script type="text/javascript">
    var options_num = 2;
    function addOption(){
        // var str = '<p class="th">有料オプション%NUM%</p><div class="td"><div class="paid"><div class="enter"><textarea name="options%NUM%" placeholder="入力してください"></textarea></div><div class="selects"><select name="options_price%NUM%"><option>500円</option><option>1000円</option><option>1500円</option></select><select name="options_states%NUM%"><option>公開</option><option>不公開</option></select></div></div></div>'
        var str = '<div class="js-formOption"><p class="th">有料オプション%NUM%</p>@error('option_name.'.'%NUM%')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="td"> <div class="paid"> <div class="enter"> <textarea type="text" value="{{ old('option_name.'.'%NUM%') }}" name="option_name[]" placeholder="入力してください">{{ old('option_name.'.'%NUM%') }}</textarea> </div> <div class="selects"><select name="option_price[]">@foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)<option value="{{ $key }}" @if(old('option_price.'.'%NUM%') == $key) selected @endif>{{ $value }}円</option>@endforeach</select><select name="option_is_public[]"><option value="{{App\Models\AdditionalOption::NOT_PUBLIC}}" @if(!is_null(old('option_is_public'.'%NUM%')) && old('option_is_public.'.'%NUM%') == App\Models\AdditionalOption::NOT_PUBLIC) selected @endif required>非公開</option><option value="{{App\Models\AdditionalOption::IS_PUBLIC}}" @if(old('option_is_public.'.'%NUM%') == App\Models\AdditionalOption::IS_PUBLIC) selected @endif required>公開</option></select></div><div><a href="javascript:;" class="fs25 ml05 js-deleteOption">×</a></div></div></div></div>'

        str = str.replace(/%\w+%/g, options_num);
        $('.js-formOption').append(str);
        options_num = options_num + 1;

        $('.js-deleteOption').on('click', '.js-formOption', function() {
            $(this).remove();
        });
    }

    var faq_num = 2;
    function addFaq(){
        // var str = '<p class="th">質問のタイトル%NUM%</p><div class="td"><div class="enter"><textarea name="faq_questions%NUM%" placeholder="質問のタイトル入力してください"></textarea><p class="taR">400</p></div></div><p class="th">質問の回答%NUM%</p><div class="td"><div class="enter"><textarea name="faq_answer%NUM%" placeholder="質問の回答入力してください"></textarea><p class="taR">400</p></div></div>'
        var str = '<p class="th">質問のタイトル%NUM%</p><div class="td">@error('question_title')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="enter"> <textarea type="text" name="question_title[]" class="@error('question_title') is-invalid @enderror" value="{{ old('question_title[]') }}" placeholder="質問のタイトル入力してください"></textarea><p class="taR">400</p></div><p class="th">質問の回答%NUM%</p>@error('answer')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="enter"> <textarea type="text" name="answer[]" class="@error('answer') is-invalid @enderror" value="{{ old('answer[]') }}" placeholder="質問の回答入力してください"></textarea> <p class="taR">400</p> </div> </div>'

        str = str.replace(/%\w+%/g, faq_num);
        $('.formFaqArea').append(str);
        faq_num = faq_num + 1;
    }
</script>
