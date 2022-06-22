<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
{{--                <a href="{{ route('home') }}">ホーム</a>　>　<span>サービスを提供する</span>　>　<span>プレビュー</span>--}}
            </div>
        </div><!-- /.breadcrumb -->
        <div class="btnFixed"><a href="{{ route('product.index') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a>
        </div>
        <div id="contents" class="detailStyle">
            @if(empty($product))
                {{--                <form class="contactForm" method="post" action="{{ route('product.store.preview') }}">--}}
                @csrf
            @else
                {{--                        <form class="contactForm" method="post" action="{{ route('product.update.preview',$product->id) }}">--}}
                @csrf @method('put')
            @endif
            <input type="hidden" value="@if(!is_null($request->category_id)){{ $request->category_id }}@endif"
                   name="category_id">
            {{--                            <input type="hidden" value="@if(!is_null($request->application_deadline)){{ $request->application_deadline }}@endif" name="application_deadline">--}}
            {{--                            <input type="hidden" value="@if(!is_null($request->required_date)){{ $request->required_date }}@endif" name="required_date">--}}

            <div class="inner02 ">
                <div class="clearfix">
                    <div id="main">
                        <div class="title">
                            <div class="fun">
                                <div class="single">
                                    <a href="#" tabindex="0">@if(!is_null($request->is_online))
                                            {{ App\Models\Product::IS_ONLINE[$request->is_online] }}
                                        @endif</a>
                                    <input type="hidden"
                                           value="@if(!is_null($request->is_online)){{ $request->is_online }}@endif"
                                           name="is_online">
                                </div>
                                <!-- <a href="#" class="favorite">お気に入り(11)</a> -->
                            </div>
                            <div class="datas">
                                <span class="data">電話相談の受付：@if(!is_null($request->is_call))
                                        {{ App\Models\Product::IS_CALL[$request->is_call] }}
                                    @endif</span>
                                <input type="hidden"
                                       value="@if(!is_null($request->is_call)){{ $request->is_call }}@endif"
                                       name="is_call">
                                <!-- <span class="data">閲覧：1000</span> -->
                                <span class="data">エリア：@if(!is_null($request->prefecture_id))
                                        {{ App\Models\Prefecture::find($request->prefecture_id)->name }}
                                    @endif</span>
                                <input type="hidden"
                                       value="@if(!is_null($request->prefecture_id)){{ $request->prefecture_id }}@endif"
                                       name="prefecture_id">
                                <!-- <span class="data">販売数：無制限</span> -->
                            </div>
                            <h2><span>@if(!is_null($request->title))
                                        {{ $request->title }}
                                    @endif</span></h2>
                            <input type="hidden" value="@if(!is_null($request->title)){{ $request->title }}@endif"
                                   name="title">
                        </div>
                        <div class="slider">
                            <div class="big">
                            @for($i = 0; $i < 10; $i++)
                                <div class="item"><img id="preview_slider{{$i}}" style="aspect-ratio:16/9; object-fit:cover;" src="" srcset="" alt=""></div>
                            @endfor
                            </div>
                            <div class="small">
                            @for($i = 0; $i < 10; $i++)
                                <div class="item"><img id="preview_slider{{$i.$i}}" style="aspect-ratio:16/9; object-fit:cover;" src="img/service/img_slider_small.jpg" alt=""></div>
                            @endfor
                            </div>
                        </div>
                        <div class="content">
                            <h2 class="hdM">サービス内容</h2>
                            <p style="overflow-wrap: break-word;">
                                @if(!is_null($request->content)){!! nl2br(e($request->content)) !!}@endif
                            </p>
                            <textarea style="display:none;" name="content">
                                @if(!is_null($request->content)){{ $request->content }}@endif
                            </textarea>
                        </div>
                        <div class="optional">
                            <h2 class="hdM">オプション追加料金</h2>
                            <ul>
                                @for($i = 0; $i < 10; $i++)
                                    @if(isset($request->option_name[$i]) && $request->option_is_public[$i] == App\Models\AdditionalOption::IS_PUBLIC)
                                        <li>
                                            <span class="add">＋ {{$request->option_name[$i]}}</span>
                                            <span class="price">￥{{ App\Models\AdditionalOption::OPTION_PRICE[$request->option_price[$i]]}}</span>
                                        </li>
                                    @endif
                                @endfor
                            </ul>
                        </div>
                        <div class="optional faq">
                            <h2 class="hdM">よくあるご質問</h2>
                            <ul class="toggleWrapPC">
                                @for($i = 0; $i < 10; $i++)
                                    @if(isset($request->question_title[$i]))
                                        <li>
                                            <p class="quest toggleBtn"><span>{{$request->question_title[$i]}}</span><span class="more">回答を見る</span></p>
                                            <p class="answer toggleBox">{{$request->answer[$i]}}</p>
                                        </li>
                                    @endif
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <aside id="side" class="pc">
                        <div class="box reservate">
                            <h3>@if(!is_null($request->price))
                                    {{ number_format($request->price) }}
                                @endif円
                            </h3>
                            <input type="hidden" value="@if(!is_null($request->price)){{ $request->price }}@endif" name="price">
                            <p class="status">所用期間</p>
                            <p class="date">
                                @if(!is_null($request->number_of_day))
                                    {{ number_format($request->number_of_day) }}
                                @endif日
                            </p>
                            <input type="hidden" value="@if(!is_null($request->number_of_day)){{ $request->number_of_day }}@endif" name="number_of_day">
                            {{--                                            <div class="calendar"><div id="datepicker"></div></div>--}}
                        </div>
                        <div>
                            <div class="peace">
                                <h3>カリビト安心への取り組み</h3>
                                <p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
                            </div>
                            <div class="functeBtns">
                                <a href="javascript:history.back();" class="orange_o">編集画面に戻る</a>
                            </div>
                            <div class="functeBtns">
                                <input type="submit" name="regist" class="orange" style="color:white;"
                                       value="サービス提供を開始">
                            </div>
                        </div>
                        <div class="box seller">
                            <h3>スキル出品者</h3>
                            @if(empty($user->userProfile->icon))
                                <a href="#" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
                            @else
                                <a href="#" class="head"><img src="{{asset('/storage/'.$user_profile->icon) }}" alt=""></a>
                            @endif
                            <!-- <p class="login">最終ログイン：8時間前</p> -->
                            <p class="introd"><a href="#"
                                                 class="name">{{ $user->name }}</a><br>({{ App\Models\UserProfile::GENDER[$user->userProfile->gender] }}
                                / {{ $age }} / {{ $user->userProfile->prefecture->name }})</p>
                            <!-- <div class="evaluate three"></div> -->
                            @if($user->userProfile->is_identify == 1)
                                <p class="check"><a href="#">本人確認済み</a></p>
                            @endif
                        </div>
                    </aside>
                </div>
                </form>
            </div><!--inner-->
        </div>
    </article>
</x-layout>
<script type="text/javascript">
    $(function(){
        $( "#datepicker" ).datepicker();
    });

    var _content = [];
    var moreload = {
        _default:5, // 初期化により5つのメッセージが表示されます
        _loading:3, // 一度にさらに3つのアイテムを表示する
        init:function(){
            var lis = $(".clientEvaluate .ftBox li");
            $(".clientEvaluate ul").html("");
            for(var n=0;n<moreload._default;n++){
                lis.eq(n).appendTo(".clientEvaluate ul");
            }
            for(var i=moreload._default;i<lis.length;i++){
                _content.push(lis.eq(i));
            }
            $(".clientEvaluate .ftBox").html("");
        },
        loadMore:function(){
            var mLis = $(".clientEvaluate li").length;
            for(var i =0;i<moreload._loading;i++){
                var target = _content.shift();
                if(!target){
                    $('.clientEvaluate .more').html("").addClass('load');
                    break;
                }
                $(".clientEvaluate ul").append(target);
            }
        }
    }
    moreload.init();
</script>
