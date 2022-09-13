<x-layout>
    <div id="friends">
        <body id="estimate">
            <x-parts.post-button/>
            <x-parts.ban-msg/>
            <article>
                <div id="breadcrumb">
                    <div class="inner">
                        <a href="{{ route('home') }}">ホーム</a>　>　<span>お気に入り</span>
                    </div>
                </div><!-- /.breadcrumb -->
                <x-parts.flash-msg/>
                <div id="contents" class="otherPage">
                    <div class="inner02 clearfix">
                        <div id="main">
                            <div class="subPagesWrap favoriteWrap">
                                <h2 class="subPagesHd">お気に入り</h2>
                                <div class="subPagesTab tabWrap">
                                    <ul class="tabLink">
                                        <li><a href="#tab_box01" class="is_active">提供</a></li>
                                        <li><a href="#tab_box02">リクエスト</a></li>
                                    </ul>
                                    <div class="tabBox is_active" id="tab_box01">
                                        <ul class="favoriteUl01 status">
                                            @foreach ($products as $product)
                                                <li @if ($product->number_of_sale === App\Models\Product::UNLIMITED_OF_SALE || ($product->number_of_sale === App\Models\Product::ONE_OF_SALE && $product->number_of_sold == 0)) class="during" @endif> {{-- 販売数が無制限のものまたは、販売数が一つで、かつ販売されていないものにduringクラスをつける --}}
                                                    <div class="cont01">
                                                        @if(isset($product->productImage[0]))
                                                            <a href="{{ route('product.show',$product->id) }}">
                                                                <p class="img"><img src="{{ asset('/storage/'.$product->productImage[0]->path)}}" alt=""></p>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('product.show',$product->id) }}">
                                                                <p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
                                                            </a>
                                                        @endif
                                                        <div class="info">
                                                            <div class="breadcrumb"><a href="{{ route('product.category.index', $product->mProductChildCategory->mProductCategory->id) }}"tabindex="0">{{ $product->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<a href="{{ route('product.category.index.show', $product->mProductChildCategory->id) }}">{{ $product->mProductChildCategory->name }}</a></div>
                                                            <a href="{{ route('product.show',$product->id) }}">
                                                                <div class="draw"><p class="price word-break"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p></div>
                                                                <div class="single"><span tabindex="0">{{ App\Models\Product::IS_ONLINE[$product->is_online] }}</span></div>
                                                            </a>
                                                            <p class="link"><a href="{{ route('product.show',$product->id) }}">詳細見る</a></p>
                                                            <p>{{date('Y/m/d', strtotime($product->created_at))}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="cont02">
                                                        <div class="user">
                                                            @if(empty($product->user->userProfile->icon))
                                                                <a href="{{ route('user.mypage', $product->user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                                            @else
                                                                <a href="{{ route('user.mypage', $product->user_id) }}" class="ico"><img src="{{asset('/storage/'.$product->user->userProfile->icon) }}" alt=""></a>
                                                            @endif
                                                            <div class="introd">
                                                                <p class="name word-break">{{$product->user->name}}</p>
                                                                <p>({{ App\Models\UserProfile::GENDER[$product->user->userProfile->gender] }}/
                                                                    {{ $product->user->userProfile->age }}代/
                                                                    {{ $product->user->userProfile->prefecture->name}})</p>
                                                            </div>
                                                        </div>
                                                        <x-parts.evaluation-star :star='$product->user->avg_star'/>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                        {{-- <div class=wp-pagenavi>
                                            <span class="current">1</span>
                                            <a href="#">2</a>
                                            <a href="#">3</a>
                                            <a href="#">4</a>
                                            <a href="#">5</a>
                                            <a href="#">6</a>
                                            <a href="#">7</a>
                                            ...
                                            <a href="#" class="nextpostslink">次へ</a>
                                        </div> --}}
                                </div>
                                <div class="tabBox" id="tab_box02">
                                    <ul class="favoriteUl01 status">
                                        @if(empty($job_requests[0]))
                                            <li><div>投稿がありません。</div></li>
                                        @else
                                            @foreach($job_requests as $job_request)
                                                <li> {{-- 掲載中か否かの判断はまだ未実装 --}}
                                                    <div class="cont01">
                                                        <a href="{{ route('job_request.show',$job_request->id) }}">
                                                            <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
                                                        </a>
                                                        <div class="info">
                                                            <div class="breadcrumb"><a href="{{ route('job_request.category.index', $job_request->mProductChildCategory->mProductCategory->id)}}" tabindex="0">{{ $job_request->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<a href="{{ route('job_request.category.index.show', $job_request->category_id)}}">{{ $job_request->mProductChildCategory->name }}</a></div>
                                                            <a href="{{ route('job_request.show',$job_request->id) }}">
                                                                <div class="draw"><p class="price word-break"><font>{{ $job_request->title }}</font><br>{{ number_format($job_request->price) }}円</p></div>
                                                                <div class="single"><span tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$job_request->is_online] }}</span></div>
                                                            </a>
                                                            <p class="link"><a href="{{ route('job_request.show',$job_request->id) }}">詳細見る</a></p>
                                                            <p>{{date('Y/m/d', strtotime($job_request->created_at))}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="cont02">
                                                        <div class="user">
                                                            @if(empty($job_request->user->userProfile->icon))
                                                                <a href="{{ route('user.mypage', $job_request->user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                                            @else
                                                                <a href="{{ route('user.mypage', $job_request->user_id) }}" class="ico"><img src="{{asset('/storage/'.$job_request->user->userProfile->icon) }}" alt=""></a>
                                                            @endif
                                                            <div class="introd">
                                                                <p class="name word-break">{{$job_request->user->name}}</p>
                                                                <p>({{ App\Models\UserProfile::GENDER[$job_request->user->userProfile->gender] }}/
                                                                    {{ $job_request->user->userProfile->age }}代/
                                                                    {{ $job_request->user->userProfile->prefecture->name}})</p>
                                                            </div>
                                                        </div>
                                                        <x-parts.evaluation-star :star='$job_request->user->avg_star'/>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    {{-- <div class=wp-pagenavi>
                                        <span class="current">1</span>
                                        <a href="#">2</a>
                                        <a href="#">3</a>
                                        <a href="#">4</a>
                                        <a href="#">5</a>
                                        <a href="#">6</a>
                                        <a href="#">7</a>
                                        ...
                                        <a href="#" class="nextpostslink">次へ</a>
                                    </div> --}}
                                </div>
                            </div><!-- favoriteWrap -->
                        </div><!-- /#main -->
                        <x-side-menu/>
                    </div><!--inner-->
                </div><!-- /#contents -->
            </article>
        <x-hide-modal/>
        </body>
    </div>
</x-layout>