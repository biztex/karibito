<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                <a href="{{ route('post') }}">投稿する</a>
            </div>
        </div><!-- /.breadcrumb -->
        <x-parts.ban-msg/>

        <div id="contents">
            <div class="cancelWrap">
                <div class="inner inner05">
                    <h2 class="subPagesHd">投稿</h2>
                    <div class="postLinks mb50">
                        <a href="{{ route('product.create') }}" class="fun camera">サービスを出品する</a>
                        <a href="{{ route('job_request.create') }}" class="fun note">サービスをリクエストする</a>
                        <div class="common">
                            <a href="{{ route('draft') }}">下書きを見る</a>
                            <a href="#" class="st2">ブログを投稿する</a>
                            <a href="{{ route('portfolio.create') }}" class="st2">ポートフォリオを投稿する</a>
                        </div>
                    </div>

                    <p class="casesOffer"><span>提供中のサービス</span></p>
                    <ul class="favoriteUl01">
                        @if(empty($products[0]))
                            <li><div>投稿がありません。</div></li>
                        @else
                            @foreach($products as $val)
                            <li>
                                <a href="{{ route('product.show',$val->id) }}">
                                    @if($val->status === App\Models\Product::STATUS_PRIVATE)
                                        <div class="cont01 public01">
                                    @elseif($val->status === App\Models\Product::STATUS_PUBLISH)
                                        <div class="cont01 public02">
                                    @endif
                                    @if(isset($val->productImage[0]))
                                        <p class="img"><img src="{{ asset('/storage/'.$val->productImage[0]->path)}}" alt=""></p>
                                    @else
                                        <p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
                                    @endif
                                </a>
                                <div class="info">
                                    <div class="breadcrumb">
                                        <a href="{{ route('product.category.index', $val->mProductChildCategory->mProductCategory->id)}}" tabindex="0">{{$val->mProductChildCategory->mProductCategory->name}}</a> ＞ 
                                        <a href="{{ route('product.category.index.show', $val->category_id) }}">{{$val->mProductChildCategory->name}}</a>
                                    </div>
                                    <a href="{{ route('product.show',$val->id) }}">
                                        <div class="draw">
                                            <p class="price">
                                                <font>{{$val->title}}</font><br>{{number_format($val->price)}}円
                                            </p>
                                        </div>
                                        <div class="single">
                                            <span tabindex="0">{{ App\Models\Product::IS_ONLINE[$val->is_online] }}</span>
                                        </div>
                                    </a>
                                    <p class="link"><a href="{{ route('product.show', $val->id) }}">詳細見る</a></p>
                                </div>
                                </div>
                            </li>
                            @endforeach
                            <a href="{{ route('publication') }}" class="more">出品中のサービスをもっと見る</a>
                        @endif
                    </ul>

                    <p class="casesOffer" style="margin-top:50px;"><span>掲載中のリクエスト</span></p>
                    <ul class="favoriteUl01">
                        @if(empty($job_requests[0]))
                            <li><div>投稿がありません。</div></li>
                        @else
                            @foreach($job_requests as $val)
                            <li>
                                <a href="{{ route('job_request.show',$val->id) }}">
                                <div class="cont01">
                                    <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
                                    </a>
                                    <div class="info">
                                        <div class="breadcrumb">
                                            <a href="{{ route('job_request.category.index', $val->category_id)}}" tabindex="0">{{$val->mProductChildCategory->mProductCategory->name}}</a> ＞ 
                                            <a href="{{ route('job_request.category.index.show', $val->mProductChildCategory->id)}}">{{$val->mProductChildCategory->name}}</a>
                                        </div>
                                        <a href="{{ route('job_request.show',$val->id) }}">
                                            <div class="draw">
                                                <p class="price">
                                                    <font>{{$val->title}}</font><br>{{number_format($val->price)}}円
                                                </p>
                                            </div>
                                            <div class="single">
                                                <span tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$val->is_online] }}</span>
                                            </div>
                                        </a>
                                        <p class="link"><a href="{{ route('job_request.show', $val->id) }}">詳細見る</a></p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            <a href="{{ route('publication').'#job-request' }}" class="more">掲載中のリクエストをもっと見る</a>
                        @endif
                    </ul>

                </div><!--inner-->
            </div>{{-- /.cancelWrap --}}
        </div><!-- /#contents -->
    </article>
</x-layout>
<script>
    // product画像 localStrageリセット
    $(function() {
        for (let i = 0; i < 10; i++) {
            localStorage.removeItem("pic" + i);
            localStorage.removeItem("status" + i);
        }
    });
</script>
