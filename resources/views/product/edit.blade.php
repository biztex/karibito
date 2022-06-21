<x-layout>
    <article>

        <div id="breadcrumb">
            <div class="inner">
                <a href="index.html">ホーム</a>　&gt;　<span>サービスを編集する</span>
            </div>
        </div>

        <div id="contents">
            <div class="cancelWrap">
                <div class="inner inner05">
                    <h2 class="subPagesHd">サービスを編集する<a href="{{ route('support') }}" class="more checkGuide">カリビト安心サポートをご確認ください</a></h2>
                    <form method="post" class="contactForm" action="{{ route('product.update',$product->id) }}">
                        @csrf @method('put')
                        <p class="th">カテゴリ<span class="must">必須</span></p>
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
                            <textarea type="text" name="content" class="@error('content') is-invalid @enderror" value="{{old('content', $product->content)}}">{{old('content', $product->content)}}</textarea>
                        </div>

                        <p class="th">価格<span class="must">必須</span></p>
                            @error('price')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <p class="price"><input type="number" name="price" class="@error('price') is-invalid @enderror" value="{{old('price', $product->price)}}"></p>
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
                            @error('prefecture')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            <select name="prefecture" class="@error('prefecture') is-invalid @enderror">
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

                        <p class="th">有料オプション1</p>
                            @error('option_name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <div class="td">
                            @foreach($product->additionalOptions as $additional_option)
                                <div class="paid">
                                    <div class="enter">
                                        <textarea class="@error('option_name') is-invalid @enderror" value="{{ old('option_name', $additional_option->title) }}" name="option_name[]" placeholder="入力してください">{{ old('option_name', $additional_option->name)}}</textarea>
                                    </div>
                                    <div class="selects">
                                        <select name="option_price[]" value="">
                                            @foreach(App\Models\AdditionalOption::OPTION_PRICE as $key => $value)
                                                <option value="{{ $key }}" @if(old('option_price', $additional_option->price) == $key) selected @endif>
                                                    {{ $value }}円
                                                </option>
                                            @endforeach
                                        </select>
                                        <select name="option_is_public[]">
                                            <option value="{{App\Models\AdditionalOption::NOT_PUBLIC}}" @if(!is_null(old('option_is_public', $additional_option->is_public )) && old('option_is_public', $additional_option->is_public ) == App\Models\AdditionalOption::NOT_PUBLIC) selected @endif required>非公開</option>
                                            <option value="{{App\Models\AdditionalOption::IS_PUBLIC}}" @if(old('option_is_public', $additional_option->is_public) == App\Models\AdditionalOption::IS_PUBLIC) selected @endif required>公開</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                            <p class="specialtyBtn add"><a href="#"><img src="img/mypage/icon_add.svg" alt="" class="add">得意分野を追加</a></p>
                        </div>


                        @for($i = 0; $i < 3; $i++)
                        <p class="th">質問のタイトル1</p>
                        @error('question_title')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <div class="td">
                                <div class="enter">
                                    <textarea type="text" name="question_title[]" class="@error('question_title') is-invalid @enderror" value="{{ old('question_title', $product->productQuestions[$i]?->title ?? '' )}}" placeholder="質問のタイトル入力してください">{{ old('question_title', $product->productQuestions[$i]?->title ?? '' )}}</textarea>
                                    <p class="taR">400</p>
                                    <div>
{{--                                        <a  class="fs25 flR" href="{{ route('product.question.destroy', ["product" => $product->id, "question_id" => $product->productQuestions[$i]->id]) }}">×</a>--}}
                                    </div>
                                </div>
                            </div>
                            <p class="th">質問の回答1</p>
                            @error('answer')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <div class="td">
                                <div class="enter">
                                    <textarea type="text" name="answer[]" class="@error('answer') is-invalid @enderror" value="{{ old('answer', $product->productQuestions[$i]?->answer ?? '' )}}" placeholder="質問の回答入力してください">{{ old('answer', $product->productQuestions[$i]?->answer ?? '' )}}</textarea>
                                    <p class="taR">400</p>
                                </div>
                        @endfor
{{--                        @foreach($product->productQuestion as $question)--}}
{{--                            <p class="th">質問のタイトル1</p>--}}
{{--                                @error('question_title')<div class="alert alert-danger">{{ $message }}</div>@enderror--}}
{{--                            <div class="td">--}}
{{--                                <div class="enter">--}}
{{--                                <textarea type="text" name="question_title[]" class="@error('question_title') is-invalid @enderror" value="{{ old('question_title', $question->title) }}" placeholder="質問のタイトル入力してください">{{ old('question_title', $question->title) }}</textarea>--}}
{{--                                    <p class="taR">400</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <p class="th">質問の回答1</p>--}}
{{--                                @error('answer')<div class="alert alert-danger">{{ $message }}</div>@enderror--}}
{{--                            <div class="td">--}}
{{--                                <div class="enter">--}}
{{--                                <textarea type="text" name="answer[]" class="@error('answer') is-invalid @enderror" value="{{ old('answer', $question->answer) }}" placeholder="質問の回答入力してください">{{ old('answer', $question->answer) }}</textarea>--}}
{{--                                    <p class="taR">400</p>--}}
{{--                                </div>--}}
{{--                        @endforeach--}}
                                <p class="specialtyBtn"><a href="#"><img src="img/mypage/icon_add.svg" alt="">よくある質問を追加</a></p>
                            </div>

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
                                    @for($i = 0; $i < 10; $i++) <li>
                                        <div id="product_pic{{$i}}" class="img">
                                        @if(isset($product->productImage[$i]))
                                            <img id="preview_product{{$i}}" src="{{ asset('/storage/'.$product->productImage[$i]->path)}}" alt="" style="width: 144px;height: 144px;object-fit: cover;">
                                            <input type="file" name="path[{{$i}}]" accept="image/*" style="display:none;" multiple >
                                        @else
                                            <img id="preview_product{{$i}}" src="/img/service/img_provide.jpg" alt="" style="width: 144px;height: 144px;object-fit: cover;">
                                            <input type="file" name="path[{{$i}}]" accept="image/*" style="display:none;" multiple>
                                        @endif
                                        </div>
                                        <div class="fun">
                                            <div class="del" id="storage_delete{{$i}}">削除</div>
                                        </div>
                                        </li>
                                
                                    @endfor
                                    <input type="hidden" name="image_status" value="">
                                </ul>
                            </div>

                            <p class="th">公開設定<span class="must">必須</span></p>
                                @error('status')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <div class="td">
                                <select name="status">
                                    <option>選択してください</option>
                                    <option value="{{App\Models\Product::NOT_PUBLIC}}" @if(old('status',$product->status) == App\Models\Product::NOT_PUBLIC)) selected @endif required>非公開</option>
                                    <option value="{{App\Models\Product::IS_PUBLIC}}" @if(old('status', $product->status) == App\Models\Product::IS_PUBLIC)) selected @endif required>公開</option>
                                </select>
                            </div>
                            <div class="functeBtns">
                                <a href="{{ route('service_preview') }}" class="full">プレビュー画面を見る</a>
                                <input type="submit" class="full green" style="color:white;" formenctype="multipart/form-data" formaction="{{ route('product.update', $product->id) }}" value="サービス提供を開始">
                                <a href="{{ route('draft') }}" class="full green_o">下書きとして保存</a>
                            </div>
                    </form>
                </div>
            </div><!--cancelWrap-->

        </div>
    </article>
</x-layout>
