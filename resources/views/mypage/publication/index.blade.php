<x-layout>
    <x-parts.post-button/>
        <article>
        <body id="publication">
            <div id="breadcrumb">
                <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　<span>掲載内容一覧</span>
                </div>
            </div><!-- /.breadcrumb -->
            <x-parts.ban-msg/>
            <x-parts.post-button/>
            <x-parts.flash-msg/>

            <div id="contents" class="otherPage">
                <div class="inner02 clearfix">
                    <div id="main">
                        <div class="subPagesWrap">
                            <h2 class="subPagesHd">掲載内容一覧</h2>
                            <div class="subPagesTab tabWrap">
                                <ul class="tabLink">
                                    <li><a href="#tab_box01" class="is_active">提供</a></li>
                                    <li><a href="#tab_box02" id="box02">リクエスト</a></li>
                                </ul>
                                <!---------------- 提供 ------------------>
                                <div class="tabBox is_active" id="tab_box01">
                                    <ul class="favoriteUl01">
                                        @if(empty($products[0]))
                                            <li><div>投稿がありません。</div></li>
                                        @else
                                            @foreach($products as $val)
                                            <li>
                                                @if($val->status === App\Models\Product::STATUS_PRIVATE)
                                                    <div class="cont01 public01">
                                                @elseif($val->status === App\Models\Product::STATUS_PUBLISH)
                                                    <div class="cont01 public02">
                                                @endif
                                                    @if(isset($val->productImage[0]))
                                                    <a href="{{ route('product.show',$val->id) }}">
                                                        <p class="img"><img src="{{ asset('/storage/'.$val->productImage[0]->path)}}" alt=""></p>
                                                    </a>
                                                    @else
                                                        <p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
                                                    @endif
                                                    <div class="info">
                                                        <div class="breadcrumb"><a href="{{ route('product.category.index', $val->mProductChildCategory->mProductCategory->id) }}"tabindex="0">{{ $val->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<a href="{{ route('product.category.index.show', $val->mProductChildCategory->id) }}">{{ $val->mProductChildCategory->name }}</a></div>
                                                        <a href="{{ route('product.show',$val->id) }}">
                                                            <div class="draw"><p class="price word-break"><font>{{ $val->title }}</font><br>{{ number_format($val->price) }}円</p></div>
                                                            <div class="single"><span tabindex="0">{{ App\Models\Product::IS_ONLINE[$val->is_online] }}</span></div>
                                                        </a>
                                                        <p class="link"><a href="{{ route('product.show',$val->id) }}">詳細見る</a></p>
                                                        <p >{{date('Y/m/d', strtotime($val->created_at))}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    {{ $products->fragment('')->links() }}
                                </div>

                                <!---------------- リクエスト ------------------>
                                <div class="tabBox" id="tab_box02">
                                    <ul class="favoriteUl01">
                                        @if(empty($job_requests[0]))
                                            <li><div>投稿がありません。</div></li>
                                        @else
                                            @foreach($job_requests as $val)
                                                <li>
                                                    <div class="cont01">
                                                        <a href="{{ route('job_request.show',$val->id) }}">
                                                            <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
                                                        </a>
                                                        <div class="info">
                                                            <div class="breadcrumb"><a href="{{ route('job_request.category.index', $val->mProductChildCategory->mProductCategory->id)}}" tabindex="0">{{ $val->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<a href="{{ route('job_request.category.index.show', $val->category_id)}}">{{ $val->mProductChildCategory->name }}</a></div>
                                                            <a href="{{ route('job_request.show',$val->id) }}">
                                                                <div class="draw"><p class="price word-break"><font>{{ $val->title }}</font><br>{{ number_format($val->price) }}円</p></div>
                                                                <div class="single"><span tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$val->is_online] }}</span></div>
                                                            </a>
                                                            @if($val->application_deadline < \Carbon\Carbon::now())
                                                                <div class="time-limit-over"><span tabindex="0">期限切れ</span></div>
                                                            @endif
                                                            <p class="link"><a href="{{ route('job_request.show',$val->id) }}">詳細見る</a></p>
                                                            <p>{{date('Y/m/d', strtotime($val->created_at))}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    {{ $job_requests->fragment('job-request')->links() }}
                                </div>
                            </div>
                        </div>
                    </div><!-- /#main -->
                    <x-side-menu/>
                </div><!--inner-->
            </div><!-- /#contents -->
        </article>
    </x-layout>
