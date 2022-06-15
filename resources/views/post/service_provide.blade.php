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
                    <h2 class="subPagesHd">サービスを提供する<a href="{{ route('support') }}" class="more checkGuide">カリビト安心サポートをご確認ください</a>
                    </h2>
                    <form method="post" class="contactForm" action="{{ route('product.store') }}">
                        @csrf
                        <p class="th">カテゴリ<span class="must">必須</span></p>
                        <div class="td">
                            <select name="child_category_id">
                                <option value="">選択してください</option>
                                @foreach ($categories as $category)
                                    <optgroup label="{{$category->name}}">
                                        @foreach ($category->mProductChildCategory as $child_category)
                                            <option value="{{$child_category->id}}">
                                                {{$child_category->name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        <p class="th">商品名<span class="must">必須</span></p>
                        <div class="td">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" name="title" class="@error('title') is-invalid @enderror"
                                   value="{{ old('title') }}">
                        </div>
                        <p class="th">商品の詳細<span class="must">必須</span></p>
                        <div class="td">
                            @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <textarea type="text" name="content" class="@error('content') is-invalid @enderror"
                                      value="{{ old('content') }}"></textarea>
                        </div>
                        <p class="th">価格<span class="must">必須</span></p>
                        <div class="td">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <p class="price"><input type="number" value="0" name="price"
                                                    class="@error('price') is-invalid @enderror"
                                                    value="{{ old('price') }}"></p>
                            <div class="warnNotes">
                                <p>【対面】：直接会って提供する内容を相手に行います。<br>【非対面】：互いが直接会わずに提供する内容を相手に行います。</p>
                            </div>
                        </div>
                        <p class="th">仕事体系<span class="must">必須</span></p>
                        <div class="td">
                            @error('is_online')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select name="is_online">
                                <option value="">選択してください</option>
                                <option value="0" @if(0 == old('is_online')) checked @endif required>
                                    対面
                                </option>
                                <option value="1" @if(1 == old('is_online')) checked @endif required>
                                    非対面
                                </option>
                            </select>
                        </div>
                        <p class="th">エリア（対面の場合のみ）</p>
                        <div class="td">
                            @error('prefecture')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select name="prefecture" class="@error('prefecture') is-invalid @enderror">
                                <option value="">選択してください</option>
                                @foreach ( $prefectures as $prefecture )
                                    <option value="{{$prefecture->id}}"
                                            @if($prefecture->id == old('prefecture')) selected @endif>{{$prefecture->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="th">所要時間<span class="must">必須</span></p>
                        <div class="td">
                            @error('number_of_day')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <p class="time"><input type="number" name="number_of_day" placeholder="入力してください"></p>
                        </div>
                        <p class="th">電話相談の受付<span class="must">必須</span></p>
                        <div class="td">
                            @error('is_call')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select name="is_call">
                                <option value="">選択してください</option>
                                <option value="0" @if(0 == old('is_call')) checked @endif required>
                                    電話を受け付ける
                                </option>
                                <option value="1" @if(1 == old('is_call')) checked @endif required>
                                    電話を受け付けない
                                </option>
                            </select>
                        </div>
                        <p class="th">販売数<span class="must">必須</span></p>
                        <div class="td">
                            @error('number_of_sale')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select name="number_of_sale">
                                <option value="0" @if(0 == old('number_of_sale')) checked
                                        @endif required>１人様限定
                                </option>
                                <option value="99" @if(99 == old('number_of_sale')) checked
                                        @endif required>無制限
                                </option>
                                {{-- <option>10</option> --}}
                            </select>
                        </div>
                        <p class="th">有料オプション1</p>
                        <div class="td">
                            @error('option_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="paid">
                                <div class="enter"><textarea class="@error('option_name') is-invalid @enderror"
                                                             value="{{ old('option_name') }}" name="option_name[]"
                                                             placeholder="入力してください"></textarea></div>
                                <div class="selects">
                                    <select name="option_price[]" value="">
                                        <option value="0" @if(0 == old('option_price')) checked @endif required>
                                            500円
                                        </option>
                                        <option value="1" @if(1 == old('option_price')) checked @endif required>
                                            1000円
                                        </option>
                                        <option value="2" @if(2 == old('option_price')) checked @endif required>
                                            1500円
                                        </option>
                                    </select>
                                    <select name="option_is_public[]">
                                        <option value="0" @if(0 == old('is_public')) checked
                                                @endif required>公開
                                        </option>
                                        <option value="1" @if(1 == old('is_public')) checked
                                                @endif required>不公開
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="paid">
                                <div class="enter"><textarea class="@error('option_name') is-invalid @enderror"
                                                             value="{{ old('option_name') }}" name="option_name[]"
                                                             placeholder="入力してください"></textarea></div>
                                <div class="selects">
                                    <select name="option_price[]" value="">
                                        <option value="0" @if(0 == old('option_price')) checked @endif required>
                                            500円
                                        </option>
                                        <option value="1" @if(1 == old('option_price')) checked @endif required>
                                            1000円
                                        </option>
                                        <option value="2" @if(2 == old('option_price')) checked @endif required>
                                            1500円
                                        </option>
                                    </select>
                                    <select name="option_is_public[]">
                                        <option value="0" @if(0 == old('is_public')) checked
                                                @endif required>公開
                                        </option>
                                        <option value="1" @if(1 == old('is_public')) checked
                                                @endif required>不公開
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="paid">
                                <div class="enter"><textarea class="@error('option_name') is-invalid @enderror"
                                                             value="{{ old('option_name') }}" name="option_name[]"
                                                             placeholder="入力してください"></textarea></div>
                                <div class="selects">
                                    <select name="option_price[]" value="">
                                        <option value="0" @if(0 == old('option_price')) checked @endif required>
                                            500円
                                        </option>
                                        <option value="1" @if(1 == old('option_price')) checked @endif required>
                                            1000円
                                        </option>
                                        <option value="2" @if(2 == old('option_price')) checked @endif required>
                                            1500円
                                        </option>
                                    </select>
                                    <select name="option_is_public[]">
                                        <option value="0" @if(0 == old('is_public')) checked
                                                @endif required>公開
                                        </option>
                                        <option value="1" @if(1 == old('is_public')) checked
                                                @endif required>不公開
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <p class="specialtyBtn"><a href="#"><img src="img/mypage/icon_add.svg" alt="">得意分野を追加</a>
                            </p>
                        </div>
                        <p class="th">質問のタイトル1</p>
                        <div class="td">
                            @error('question_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="enter">
                                <textarea type="text" name="question_title[]"
                                          class="@error('question_title') is-invalid @enderror"
                                          value="{{ old('question_title') }}" placeholder="質問のタイトル入力してください"></textarea>
                                <p class="taR">400</p>
                            </div>
                        </div>
                        <p class="th">質問の回答1</p>
                        <div class="td">
                            @error('answer')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="enter">
                                <textarea type="text" name="answer[]" class="@error('answer') is-invalid @enderror"
                                          value="{{ old('answer') }}" placeholder="質問の回答入力してください"></textarea>
                                <p class="taR">400</p>
                            </div>
                            <p class="th">質問のタイトル2</p>
                            <div class="td">
                                @error('question_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="enter">
                                <textarea type="text" name="question_title[]"
                                          class="@error('question_title') is-invalid @enderror"
                                          value="{{ old('question_title') }}" placeholder="質問のタイトル入力してください"></textarea>
                                    <p class="taR">400</p>
                                </div>
                            </div>
                            <p class="th">質問の回答2</p>
                            <div class="td">
                                @error('answer')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="enter">
                                <textarea type="text" name="answer[]" class="@error('answer') is-invalid @enderror"
                                          value="{{ old('answer') }}" placeholder="質問の回答入力してください"></textarea>
                                    <p class="taR">400</p>
                                </div>
                                <p class="th">質問のタイトル3</p>
                                <div class="td">
                                    @error('question_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="enter">
                                <textarea type="text" name="question_title[]"
                                          class="@error('question_title') is-invalid @enderror"
                                          value="{{ old('question_title') }}" placeholder="質問のタイトル入力してください"></textarea>
                                        <p class="taR">400</p>
                                    </div>
                                </div>
                                <p class="th">質問の回答3</p>
                                <div class="td">
                                    @error('answer')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="enter">
                                <textarea type="text" name="answer[]" class="@error('answer') is-invalid @enderror"
                                          value="{{ old('answer') }}" placeholder="質問の回答入力してください"></textarea>
                                        <p class="taR">400</p>
                                    </div>
                                    <p class="specialtyBtn"><a href="#"><img src="img/mypage/icon_add.svg" alt="">よくある質問を追加</a>
                                    </p>
                                </div>
                                <p class="th">画像投稿<span class="must">必須</span></p>
                                <div class="td">
                                    <div class="warnNotes">
                                        <p class="danger">写真を追加する<font class="colorRed">（１枚目は必須）</font></p>
                                        <p>
                                            カメラマークをタップして、写真をアップロードしてください。<br>複数の写真がアップロード可能です。<br>写真はチケット詳細画面に、ポートフォリオとして表示されます。<br>必須ではございませんので、アップロードなしでも問題ございません。<br>※登録１枚目の画像がサムネイルとして表示されます。
                                        </p>
                                    </div>
                                    <ul class="mypagePortfolioUl03 mt40">
                                        <li>
                                            <div class="img"><img src="img/service/img_provide01.jpg" alt=""></div>
                                            <div class="fun">
                                                <a href="#" class="del">削除</a>
                                                <a href="#" class="edit">編集</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="img"><img src="img/mypage/img_portfolio01.jpg" alt=""></div>
                                            <div class="fun">
                                                <a href="#" class="del">削除</a>
                                                <a href="#" class="edit">編集</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="img"><img src="img/service/img_provide02.jpg" alt=""></div>
                                            <div class="fun">
                                                <a href="#" class="del">削除</a>
                                                <a href="#" class="edit">編集</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="img"><img src="img/service/img_provide.jpg" alt=""></div>
                                            <div class="fun">
                                                <a href="#" class="del">削除</a>
                                                <a href="#" class="edit">編集</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="img"><img src="img/service/img_provide.jpg" alt=""></div>
                                            <div class="fun">
                                                <a href="#" class="del">削除</a>
                                                <a href="#" class="edit">編集</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="img"><img src="img/service/img_provide.jpg" alt=""></div>
                                        </li>
                                        <li>
                                            <div class="img"><img src="img/service/img_provide.jpg" alt=""></div>
                                        </li>
                                        <li>
                                            <div class="img"><img src="img/service/img_provide.jpg" alt=""></div>
                                        </li>
                                        <li>
                                            <div class="img"><img src="img/service/img_provide.jpg" alt=""></div>
                                        </li>
                                        <li>
                                            <div class="img"><img src="img/service/img_provide.jpg" alt=""></div>
                                        </li>
                                    </ul>
                                </div>
                                <p class="th">公開設定<span class="must">必須</span></p>
                                <div class="td">
                                    @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <select name="status">
                                        <option>選択してください</option>
                                        <option value="1" name="status" @if(1 == old('status')) checked @endif required>
                                            公開
                                        </option>
                                        <option value="2" name="status" @if(2 == old('status')) checked @endif required>
                                            非公開
                                        </option>
                                    </select>
                                </div>
                                <div class="functeBtns">
                                    <a href="{{ route('service_preview') }}" class="full">プレビュー画面を見る</a>
                                    {{-- <a href="{{ route('service_thanks') }}" class="full green">サービス提供を開始</a> --}}
                                    <ul class="loginFormBtn">
                                        {{-- <button type="submit" name="is_draft" class="full green" value="1">サービス提供を開始</button> --}}
                                        {{-- <input type="hidden" name="is_draft" value="1"> --}}
                                        <li><input type="submit" name="is_draft" class="full green" value="1"
                                            >サービス提供を開始
                                        </li>
                                    </ul>
                                    <a href="{{ route('draft') }}" class="full green_o">下書きとして保存</a>
                                </div>
                    </form>
                </div>
            </div><!--cancelWrap-->

        </div>
    </article>
</x-layout>
