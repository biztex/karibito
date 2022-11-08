<x-layout>
    <article>
    <body id="estimate">
        <div id="favorite">
            <div id="breadcrumb">
                <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　
                    <a href="{{ route('mypage') }}">マイページ</a>　>　
                    <span>お気に入り</span>
                </div>
            </div><!-- /.breadcrumb -->
            <x-parts.ban-msg/>
            <x-parts.post-button/>
            <x-parts.flash-msg/>

            <div id="contents" class="otherPage">
                <div class="inner02 clearfix">
                    <div id="main">
                        <div class="subPagesWrap favoriteWrap">
                            <h2 class="subPagesHd">お気に入り</h2>
                            <div class="subPagesTab tabWrap">
                                <ul class="tabLink">
                                    <li><a href="#tab_box01" class="is_active">提供</a></li>
                                    <li><a href="#tab_box02" id="box02">リクエスト</a></li>
                                </ul>
							    <!---------------- 提供 ------------------>
                                <div class="tabBox is_active" id="tab_box01">
                                    <ul class="favoriteUl01 status">
                                        @if(empty($products[0]))
                                          <li><div>投稿がありません。</div></li>
                                        @else
                                            @foreach ($products as $product)
                                            <li @if ($product->reference->number_of_sale === App\Models\Product::UNLIMITED_OF_SALE || ($product->reference->number_of_sale === App\Models\Product::ONE_OF_SALE && $product->reference->number_of_sold < 1)) class="during" @endif>
                                                <div class="cont01">
                                                    @if(isset($product->reference->productImage[0]))
                                                        <a href="{{ route('product.show',$product->reference_id) }}">
                                                            <p class="img"><img src="{{ asset('/storage/'.$product->reference->productImage[0]->path)}}" alt=""></p>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('product.show',$product->reference_id) }}">
                                                            <p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
                                                        </a>
                                                    @endif
                                                    <div class="info">
                                                        <div class="breadcrumb"><a href="{{ route('product.category.index', $product->reference->mProductChildCategory->mProductCategory->id) }}"tabindex="0">{{ $product->reference->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<a href="{{ route('product.category.index.show', $product->reference->mProductChildCategory->id) }}">{{ $product->reference->mProductChildCategory->name }}</a></div>
                                                        <a href="{{ route('product.show',$product->reference_id) }}">
                                                            <div class="draw"><p class="price word-break"><font>{{ $product->reference->title }}</font><br>{{ number_format($product->reference->price) }}円</p></div>
                                                            <div class="single"><span tabindex="0">{{ App\Models\Product::IS_ONLINE[$product->reference->is_online] }}</span></div>
                                                        </a>
                                                        <p class="link"><a href="{{ route('product.show',$product->reference_id) }}">詳細見る</a></p>
                                                        <p>{{date('Y/m/d', strtotime($product->reference->created_at))}}</p>
                                                    </div>
                                                </div>
                                                <div class="cont02">
                                                    <div class="user">
                                                        @if(empty($product->reference->user->userProfile->icon))
                                                            <a href="{{ route('user.mypage', $product->reference->user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                                        @else
                                                            <a href="{{ route('user.mypage', $product->reference->user_id) }}" class="ico"><img src="{{asset('/storage/'.$product->reference->user->userProfile->icon) }}" alt=""></a>
                                                        @endif
                                                        <div class="introd">
                                                            <p class="name word-break">{{$product->reference->user->name}}</p>
                                                            <p>({{ App\Models\UserProfile::GENDER[$product->reference->user->userProfile->gender] }}/
                                                                {{ $product->reference->user->userProfile->age }}/
                                                                {{ $product->reference->user->userProfile->prefecture->name}})</p>
                                                        </div>
                                                    </div>
                                                    <x-parts.evaluation-star :star='$product->reference->user->avg_star'/>
                                                </div>
                                            </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    {{ $products->links() }}
                                </div>

                                <!---------------- リクエスト ------------------>
                                <div class="tabBox" id="tab_box02">
                                    <ul class="favoriteUl01 status">
                                        @if(empty($job_requests[0]))
                                            <li><div>投稿がありません。</div></li>
                                        @else
                                            @foreach($job_requests as $job_request)
                                            @if(isset($job_request->reference->user))
                                            <li @if ($job_request->reference->is_purchased === false && $job_request->reference->carbon_deadline->gte($today)) class="during" @endif>
                                                <div class="cont01">
                                                    <a href="{{ route('job_request.show',$job_request->reference->id) }}">
                                                        <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
                                                    </a>
                                                    <div class="info">
                                                        <div class="breadcrumb"><a href="{{ route('job_request.category.index', $job_request->reference->mProductChildCategory->mProductCategory->id)}}" tabindex="0">{{ $job_request->reference->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<a href="{{ route('job_request.category.index.show', $job_request->reference->category_id)}}">{{ $job_request->reference->mProductChildCategory->name }}</a></div>
                                                        <a href="{{ route('job_request.show',$job_request->reference->id) }}">
                                                            <div class="draw"><p class="price word-break"><font>{{ $job_request->reference->title }}</font><br>{{ number_format($job_request->reference->price) }}円</p></div>
                                                            <div class="single"><span tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$job_request->reference->is_online] }}</span></div>
                                                        </a>
                                                        <p class="link"><a href="{{ route('job_request.show',$job_request->reference->id) }}">詳細見る</a></p>
                                                        <p>{{date('Y/m/d', strtotime($job_request->reference->created_at))}}</p>
                                                    </div>
                                                </div>
                                                <div class="cont02">
                                                    <div class="user">
                                                        @if(empty($job_request->reference->user->userProfile->icon))
                                                            <a href="{{ route('user.mypage', $job_request->reference->user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                                        @else
                                                            <a href="{{ route('user.mypage', $job_request->reference->user_id) }}" class="ico"><img src="{{asset('/storage/'.$job_request->reference->user->userProfile->icon) }}" alt=""></a>
                                                        @endif
                                                        <div class="introd">
                                                            <p class="name word-break">{{$job_request->reference->user->name}}</p>
                                                            <p>({{ App\Models\UserProfile::GENDER[$job_request->reference->user->userProfile->gender] }}/
                                                                {{ $job_request->reference->user->userProfile->age }}/
                                                                {{ $job_request->reference->user->userProfile->prefecture->name}})</p>
                                                        </div>
                                                    </div>
                                                    <x-parts.evaluation-star :star='$job_request->reference->user->avg_star'/>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                    {{ $job_requests->fragment('job-request')->links() }}
                                </div><!-- リクエスト-->

                            </div><!-- /subPagesTab -->
                        </div><!-- /favoriteWrap -->
                    </div><!-- /#main -->
                    <x-side-menu/>
                </div><!--inner-->
            </div><!-- /#contents -->
        <x-hide-modal/>
    </article>
</x-layout>
