<x-layout>
    <article>

        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                <a href="{{route('publication')}}">掲載内容一覧</a>　>　
                <a href="{{(url()->previous())}}">サービス提供の詳細</a>　>　
                <a href="{{(url()->current())}}">サービスを編集する</a>
            </div>
        </div>

        <div id="contents">
            <div class="cancelWrap">
                <div class="inner inner05">
                    <h2 class="subPagesHd">サービスを編集する<a href="{{ route('support') }}" target="_blank" class="more checkGuide">カリビト安心サポートをご確認ください</a></h2>
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
                                            <option value="{{$child_category->id}}" @if( old('category_id' , $product->category_id) == $child_category->id ) selected @endif>{{ $child_category->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        <p class="th">商品名<span class="must">必須</span></p>
                            @error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <input type="text" name="title" class="@error('title') is-invalid @enderror" value="{{old('title', $product->title)}}">
                        </div>

                        <p class="th">商品の詳細<span class="must">必須</span></p>
                            @error('content')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <textarea type="text" name="content">{{old('content', $product->content)}}</textarea>
                        </div>

                        <p class="th">価格<span class="must">必須</span></p>
                            @error('price')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <p class="budget price"><input type="text" placeholder="0" name="price" value="{{ old('price', $product->price) }}"></p>
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
                                <option value="{{App\Models\Product::OFFLINE}}" @if(!is_null(old('is_online',$product->is_online)) && old('is_online',$product->is_online) == App\Models\Product::OFFLINE) selected @endif>対面</option>
                                <option value="{{App\Models\Product::ONLINE}}" @if(old('is_online', $product->is_online) == App\Models\Product::ONLINE) selected @endif>非対面</option>
                            </select>
                        </div>

                        <p class="th">エリア（対面の場合のみ）</p>
                            @error('prefecture_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="prefecture_id" class="">
                                <option value="">選択してください</option>
                                @foreach ( $prefectures as $prefecture )
                                    <option value="{{ $prefecture->id }}" @if( old('prefecture_id', $product->prefecture_id) == $prefecture->id ) selected @endif>{{ $prefecture->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <p class="th">所要時間<span class="must">必須</span></p>
                            @error('number_of_day')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <p class="time"><input type="number" name="number_of_day" placeholder="入力してください" value="{{old('number_of_day', $product->number_of_day)}}"></p>
                        </div>

                        <p class="th">電話相談の受付<span class="must">必須</span></p>
                            @error('is_call')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="is_call">
                                <option value="">選択してください</option>
                                <option value="{{App\Models\Product::OFF_CALL}}" @if(!is_null(old('is_call', $product->is_call )) && old('is_call', $product->is_call ) == App\Models\Product::OFF_CALL) selected @endif>電話を受け付けない</option>
                                <option value="{{App\Models\Product::ON_CALL}}" @if(old('is_call', $product->is_call ) == App\Models\Product::ON_CALL) selected @endif>電話を受け付ける</option>
                            </select>
                        </div>

                        <p class="th">販売数<span class="must">必須</span></p>
                            @error('number_of_sale')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="number_of_sale">
                                <option value="">選択してください</option>
                                <option value="{{App\Models\Product::ONE_OF_SALE}}" @if(!is_null(old('number_of_sale', $product->number_of_sale )) && old('number_of_sale', $product->number_of_sale ) == App\Models\Product::ONE_OF_SALE) selected @endif>1人様限定</option>
                                <option value="{{App\Models\Product::UNLIMITED_OF_SALE}}" @if(old('number_of_sale', $product->number_of_sale ) == App\Models\Product::UNLIMITED_OF_SALE) selected @endif>無制限</option>
                            </select>
                        </div>
                        <div class="formOptionsArea">
                            @if(null !== old('option_name'))
                                @foreach(old('option_name') as $num => $additional_option)
                                    <div class="js-optionForm">
                                        <p class="th">有料オプション {{$num + 1}}</p>
                                            @error('option_name.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="paid">
                                                <div class="enter">
                                                    <textarea class="" type="text" name="option_name[]" placeholder="入力してください">{{ old('option_name.'.$num) }}</textarea>
                                                </div>
                                                <div class="selects">
                                                    <select name="option_price[]">
                                                        @foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)
                                                            <option value="{{ $key }}" @if(old('option_price.'.$num) == $key) == $key) selected @endif>
                                                                {{ $value }}円
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <select name="option_is_public[]">
                                                        <option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public.'.$num)) && old('option_is_public.'.$num) == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif>非公開</option>
                                                        <option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if(old('option_is_public.'.$num) == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif>公開</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <a href="javascript:;" class="fs25 ml05 js-deleteOption">×</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif($product->option_name)
                                @foreach($product->option_name as $num => $additional_option)
                                    <div class="js-optionForm">
                                        <p class="th">有料オプション {{$num + 1}}</p>
                                        @error('option_name.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="paid">
                                                <div class="enter">
                                                    <textarea class="" type="text" name="option_name[]" placeholder="入力してください">{{ old('option_name.'.$num, $additional_option.$num) }}</textarea>
                                                </div>
                                                <div class="selects">
                                                    <select name="option_price[]">
                                                        @foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)
                                                            <option value="{{ $key }}" @if(old('option_price.'.$num, $product->option_price[$num]) == $key) == $key) selected @endif>
                                                            {{ $value }}円
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <select name="option_is_public[]">
                                                        <option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public.'.$num, $product->option_is_public[$num])) && old('option_is_public.'.$num, $product->option_is_public[$num]) == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif>非公開</option>
                                                        <option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if(old('option_is_public.'.$num, $product->option_is_public[$num]) == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif>公開</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <a href="javascript:;" class="fs25 ml05 js-deleteOption">×</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif(collect($product->additionalOptions)->isNotEmpty())
                                @foreach($product->additionalOptions as $num => $additional_option)
                                    <div class="js-optionForm">
                                        <p class="th">有料オプション {{$num + 1}}</p>
                                        @error('option_name.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="paid">
                                                <div class="enter">
                                                    <textarea class="" type="text" name="option_name[]" placeholder="入力してください">{{ old('option_name.'.$num, $additional_option->name) }}</textarea>
                                                </div>
                                                <div class="selects">
                                                    <select name="option_price[]">
                                                        @foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)
                                                            <option value="{{ $key }}" @if(old('option_price.'.$num, $additional_option->price) == $key) == $key) selected @endif>
                                                            {{ $value }}円
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <select name="option_is_public[]">
                                                        <option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public.'.$num, $additional_option->is_public)) && old('option_is_public.'.$num, $additional_option->is_public) == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif>非公開</option>
                                                        <option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if(old('option_is_public.'.$num, $additional_option->is_public) == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif>公開</option>
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
                                                <textarea type="text" name="option_name[]" placeholder="入力してください">{{ old('option_name.0') }}</textarea>
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
                                                    <option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public.0')) && old('option_is_public.0') == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif>非公開</option>
                                                    <option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if(old('option_is_public.0') == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif>公開</option>
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
                        <p class="specialtyBtn"><a href="javascript:;" onclick="addOption();"><img src="img/mypage/icon_add.svg" alt="">有料オプションを追加</a></p>

                        <div class="formQuestionsArea">
                            @if((old('question_title') || old('answer')))
                                @foreach(old('question_title') as $num => $product_question)
                                    <div class="js-questionForm">
                                        <p class="th">質問のタイトル {{$num + 1}}</p>
                                        @error('question_title.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="enter">
                                                <textarea type="text" name="question_title[]" placeholder="質問のタイトル入力してください">{{ old('question_title.'.$num) }}</textarea>
                                                <p class="taR">400</p>
                                            </div>
                                            <p class="th">質問の回答 {{$num + 1}}</p>
                                            @error('answer.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            <div class="enter">
                                                <textarea type="text" name="answer[]" placeholder="質問の回答入力してください">{{ old('answer.'.$num) }}</textarea>
                                                <p class="taR">400</p>
                                            </div>
                                            <div>
                                                <a href="javascript:;" class="fs25 ml05 js-deleteQuestion">×</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif($product->question_title)
                                @foreach($product->question_title as $num => $product_question)
                                <div class="js-questionForm">
                                    <p class="th">質問のタイトル {{$num + 1}}</p>
                                    @error('question_title.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    <div class="td">
                                        <div class="enter">
                                            <textarea type="text" name="question_title[]" placeholder="質問のタイトル入力してください">{{ old('question_title.'.$num, $product_question.$num) }}</textarea>
                                            <p class="taR">400</p>
                                        </div>
                                        <p class="th">質問の回答 {{$num + 1}}</p>
                                        @error('answer.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="enter">
                                            <textarea type="text" name="answer[]" placeholder="質問の回答入力してください">{{ old('answer.'.$num, $product->answer[$num]) }}</textarea>
                                            <p class="taR">400</p>
                                        </div>
                                        <div>
                                            <a href="javascript:;" class="fs25 ml05 js-deleteQuestion">×</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @elseif(collect($product->productQuestions)->isNotEmpty())
                                @foreach($product->productQuestions as $num => $product_question)
                                    <div class="js-questionForm">
                                        <p class="th">質問のタイトル {{$num + 1}}</p>
                                        @error('question_title.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="td">
                                            <div class="enter">
                                                <textarea type="text" name="question_title[]" placeholder="質問のタイトル入力してください">{{ old('question_title.'.$num, $product_question->title) }}</textarea>
                                                <p class="taR">400</p>
                                            </div>
                                            <p class="th">質問の回答 {{$num + 1}}</p>
                                            @error('answer.'.$num)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            <div class="enter">
                                                <textarea type="text" name="answer[]" placeholder="質問の回答入力してください">{{ old('answer.'.$num, $product_question->answer) }}</textarea>
                                                <p class="taR">400</p>
                                            </div>
                                            <div>
                                                <a href="javascript:;" class="fs25 ml05 js-deleteQuestion">×</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="js-questionForm">
                                    <p class="th">質問のタイトル1</p>
                                    @error('question_title.'.'0')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    <div class="td">
                                        <div class="enter">
                                            <textarea type="text" name="question_title[]" placeholder="質問のタイトル入力してください"></textarea>
                                            <p class="taR">400</p>
                                        </div>
                                        <p class="th">質問の回答1</p>
                                        @error('answer.'.'0')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                        <div class="enter">
                                            <textarea type="text" name="answer[]" placeholder="質問の回答入力してください"></textarea>
                                            <p class="taR">400</p>
                                        </div>
                                        <div>
                                            <a href="javascript:;" class="fs25 ml05 js-deleteQuestion">×</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <p class="specialtyBtn"><a href="javascript:;" onclick="addQuestion();"><img src="img/mypage/icon_add.svg" alt="">よくある質問を追加</a></p>

                        <p class="th">画像投稿<span class="must">必須</span></p>
                            @error('product_pic')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <div class="td">
                                <div class="warnNotes">
                                    <p class="danger">写真を追加する<font class="colorRed">（１枚目は必須）</font></p>
                                    <p>カメラマークをタップして、写真をアップロードしてください。<br>複数の写真がアップロード可能です。<br>写真はチケット詳細画面に、ポートフォリオとして表示されます。<br>必須ではございませんので、アップロードなしでも問題ございません。<br>※登録１枚目の画像がサムネイルとして表示されます。</p>
                                </div>
                                @error('base64_text.0')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                <ul class="mypagePortfolioUl03 mt40">
                                    @for($i = 0; $i < 10; $i++)

                                        <li>
                                            <div id="product_pic{{$i}}" class="img">
                                                @if(isset($product->productImage[$i]) && old('image_status'.$i) === null)
                                                    <img id="preview_product{{$i}}" src="{{ asset('/storage/'.$product->productImage[$i]->path)}}" alt="" style="width: 144px;height: 144px;object-fit: cover;">
                                                    <input type="file" name="paths[{{$i}}]" accept="image/*" style="display:none;" multiple >
                                                    <input type="hidden" name="base64_text[{{$i}}]" value="{{ old('base64_text[$i]', '#') }}">
                                                    <input type="hidden" name="old_image[{{$i}}]" value="{{ $product->productImage[$i]->path }}">
                                                @elseif(old('image_status'.$i) === "delete")
                                                    <img id="preview_product{{$i}}" src="/img/service/img_provide.jpg" alt="" style="width: 144px;height: 144px;object-fit: cover;">
                                                    <input type="file" name="paths[{{$i}}]" accept="image/*" style="display:none;" multiple>
                                                    <input type="hidden" name="base64_text[{{$i}}]" value="{{ old('base64_text[$i]') }}">
                                                    <input type="hidden" name="old_image[{{$i}}]" value="">
                                                @elseif(old('image_status'.$i) === "insert")
                                                    <img id="preview_product{{$i}}" src="{{ old('base64_text[$i]')}}" alt="" style="width: 144px;height: 144px;object-fit: cover;">
                                                    <input type="file" name="paths[{{$i}}]" accept="image/*" style="display:none;" multiple >
                                                    <input type="hidden" name="base64_text[{{$i}}]" value="{{ old('base64_text[$i]') }}">
                                                    <input type="hidden" name="old_image[{{$i}}]" value="">
                                                @else
                                                    <img id="preview_product{{$i}}" src="/img/service/img_provide.jpg" alt="" style="width: 144px;height: 144px;object-fit: cover;">
                                                    <input type="file" name="paths[{{$i}}]" accept="image/*" style="display:none;" multiple>
                                                    <input type="hidden" name="base64_text[{{$i}}]" value="{{ old('base64_text[$i]') }}">
                                                    <input type="hidden" name="old_image[{{$i}}]" value="">
                                                @endif
                                            </div>
                                            <div class="fun">
                                                <div class="del" id="storage_delete{{$i}}">削除</div>
                                            </div>
                                        </li>
                                        <input type="hidden" name="image_status{{$i}}" value="{{ old('image_status'.$i) }}">
                                    @endfor
                                </ul>
                            </div>

                            <p class="th">公開設定<span class="must">必須</span></p>
                                @error('status')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <div class="td">
                                <select name="status">
                                    <option value="">選択してください</option>
                                    <option value="{{App\Models\Product::STATUS_PRIVATE}}" @if(!is_null(old('status', $product->status )) && old('status', $product->status ) == App\Models\Product::STATUS_PRIVATE) selected @endif>非公開</option>
                                    <option value="{{App\Models\Product::STATUS_PUBLISH}}" @if(old('status', $product->status) == App\Models\Product::STATUS_PUBLISH) selected @endif>公開</option>
                                </select>
                            </div>
                            <div class="functeBtns">
                                <input type="submit" class="full" style="color:white;" formaction="{{ route('product.edit.preview', $product->id) }}" value="プレビュー画面を見る">
                                <input type="submit" class="full green" style="color:white;" formaction="{{ route('product.update', $product->id) }}" value="サービス提供を開始">
                                <input type="submit" class="full green_o" formaction="{{ route('product.updateDraft', $product->id) }}" value="下書きとして保存">
                            </div>
                    </form>
                </div>
            </div><!--cancelWrap-->
        </div>
    </article>
</x-layout>
<script type="text/javascript">
    $(function(){
        delOption(); // 追加されたボタンのイベントが発火されないためここで呼び出す
        delQuestion();
    })
    function addOption(){
        let str = '<div class="js-optionForm"><p class="th">有料オプション%NUM%</p>@error('option_name.'.'%NUM%')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="td"> <div class="paid"> <div class="enter"> <textarea type="text" name="option_name[]" placeholder="入力してください">{{ old('option_name.'.'%NUM%') }}</textarea> </div> <div class="selects"><select name="option_price[]">@foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)<option value="{{ $key }}" @if(old('option_price.'.'%NUM%') == $key) selected @endif>{{ $value }}円</option>@endforeach</select><select name="option_is_public[]"><option value="{{App\Models\AdditionalOption::STATUS_PRIVATE}}" @if(!is_null(old('option_is_public'.'%NUM%')) && old('option_is_public.'.'%NUM%') == App\Models\AdditionalOption::STATUS_PRIVATE) selected @endif required>非公開</option><option value="{{App\Models\AdditionalOption::STATUS_PUBLISH}}" @if(old('option_is_public.'.'%NUM%') == App\Models\AdditionalOption::STATUS_PUBLISH) selected @endif required>公開</option></select></div><div><a href="javascript:;" class="fs25 ml05 js-deleteOption">×</a></div></div></div></div></div>'
        let number_js_optionForm = $(".formOptionsArea").children(".js-optionForm").length;

        if (number_js_optionForm < 10) {
            str = str.replace(/%\w+%/g, number_js_optionForm + 1);
            $('.formOptionsArea').append(str);
        }
        delOption(); // 追加されたボタンのイベントが発火されないためここで呼び出す
    }

    function delOption() {
        $('.js-deleteOption').click(function () {
            let number_js_optionForm = $(".formOptionsArea").children(".js-optionForm").length;
            if (number_js_optionForm > 1) {
                $(this).parents('.js-optionForm').remove(); //divだけを消す
                $(".formOptionsArea").children(".js-optionForm").each(function (index, element) {
                    $(element).children(".th").text("有料オプション" + (index + 1));
                })
            }
        });
    }

    function addQuestion() {
        let str = '<div class="js-questionForm"><p class="th">質問のタイトル%NUM%</p><div class="td">@error('question_title.'.'%NUM%')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="enter"> <textarea type="text" name="question_title[]" placeholder="質問のタイトル入力してください"></textarea><p class="taR">400</p></div><p class="th">質問の回答%NUM%</p>@error('answer')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="enter"><textarea type="text" name="answer[]" placeholder="質問の回答入力してください"></textarea> <p class="taR">400</p></div><div> <a href="javascript:;" class="fs25 ml05 js-deleteQuestion">×</a> </div></div></div>'
        let number_js_questionForm = $(".formQuestionsArea").children(".js-questionForm").length;

        if (number_js_questionForm < 10) {
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
                    $(element).find(".th").text("質問のタイトル" + (index + 1));
                    $(element).find(".th").text("質問の回答" + (index + 1));
                })
            }
        });
    }



	$(function()  {
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

        if (@json($errors->has('base64_text.0'))) {
            $("#preview_product0").attr('src', '/img/service/img_provide.jpg');
		}


	});

</script>
