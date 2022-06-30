<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                <a href="{{ route('product.index') }}">投稿する</a>
            </div>
        </div><!-- /.breadcrumb -->
        <div class="btnFixed">
            <!-- <a href="{{ route('product.index') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a> -->
        </div>

        <div id="contents">
            <div class="cancelWrap">
                <div class="inner inner05">
                    <h2 class="subPagesHd">投稿</h2>
                    <div class="postLinks mb50">
                        <a href="{{ route('product.create') }}" class="fun camera">サービスを提供する</a>
                        <a href="{{ route('job_request.create') }}" class="fun note">サービスをリクエストする</a>
                        <div class="common">
                            <a href="{{ route('draft') }}">下書きを見る</a>
                            <a href="#" class="st2">ブログを投稿する</a>
                            <a href="#" class="st2">ポートフォリオを投稿する</a>
                        </div>
                    </div>

                    <p class="casesOffer"><span>提供中のサービス</span></p>
                    <ul class="favoriteUl01">
                        @if(empty($products[0]))
                            <li><div>投稿がありません。</div></li>
                        @else
                            @foreach($products as $val)
                            <li>
                                <div class="cont01">
                                    <!-- 画像1枚必須なため、ここのif分いらない。現段階で画像登録機能完了してないため入れてます -->
                                    @if(isset($val->productImage[0]))
                                    <p class="img"><img src="{{ asset('/storage/'.$val->productImage[0]->path)}}" alt="" style="width: 120px;height: 100px;object-fit: cover;"></p>
                                    @else
                                    <p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
                                    @endif
                                    <div class="info">
                                        <div class="breadcrumb">
                                            <a href="#" tabindex="0">@if(!is_null($val->category_id)){{$val->mProductChildCategory->mProductCategory->name}} @endif</a> ＞ 
                                            <span>@if(!is_null($val->category_id)){{$val->mProductChildCategory->name}}@endif</span>
                                        </div>
                                        <div class="draw">
                                            <p class="price">
                                                <font>{{$val->title}}</font><br>{{$val->price}}円
                                            </p>
                                        </div>
                                        <div class="single">
                                            <a href="#" tabindex="0">{{ App\Models\Product::IS_ONLINE[$val->is_online] }}</a>
                                        </div>
                                    </div>
                                    <p class="link"><a href="{{ route('product.show', $val->id) }}">詳細見る</a></p>

                                </div>
                            </li>
                            @endforeach
                            <a href="{{ route('publication') }}" class="more">提供中のサービスをもっと見る</a>
                        @endif
                    </ul>
                    <p class="casesOffer" style="margin-top:50px;"><span>掲載中のリクエスト</span></p>
                    <ul class="favoriteUl01">
                        @if(empty($job_requests[0]))
                            <li><div>投稿がありません。</div></li>
                        @else
                            @foreach($job_requests as $val)
                            <li>
                                <div class="cont01">
                                    <!-- リクエスト画像ないためクライアントに要確認 -->
                                    <!-- <p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p> -->
                                    <div class="info">
                                        <div class="breadcrumb">
                                            <a href="#" tabindex="0">@if(!is_null($val->category_id)){{$val->mProductChildCategory->mProductCategory->name}} @endif</a> ＞ 
                                            <span>@if(!is_null($val->category_id)){{$val->mProductChildCategory->name}}@endif</span>
                                        </div>
                                        <div class="draw">
                                            <p class="price">
                                                <font>{{$val->title}}</font><br>{{$val->price}}円
                                            </p>
                                        </div>
                                        <div class="single">
                                            <a href="#" tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$val->is_online] }}</a>
                                        </div>
                                    </div>
                                    <p class="link"><a href="{{ route('job_request.show', $val->id) }}">詳細見る</a></p>

                                </div>
                            </li>
                            @endforeach
                            <a href="{{ route('publication').'#job-request' }}" class="more">掲載中のリクエストをもっと見る</a>
                        @endif
                    </ul>
                </div>
                <!--inner-->
            </div>
        </div><!-- /#contents -->
    </article>
</x-layout>
<script>
    // product画像 localStrageリセット
    $(function() {
        for (let i = 0; i < 10; i++) {
            localStorage.removeItem("pic" + i);
        }
    });
</script>
