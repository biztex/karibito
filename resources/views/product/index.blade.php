<x-layout :keyword="$keyword ?? ''">
{{-- <article> --}}
    <div id="breadcrumb">
        <div class="inner">
            <a href="{{ route('home') }}">ホーム</a>　&gt;
            @if (isset($parent_category_flg))
                @if ($parent_category_flg === 1)
                    <a href="{{ route('product.category.index', $category->id) }}">{{$category->name}}</a>
                @elseif ($parent_category_flg === 0)
                    <a href="{{ route('product.category.index', $child_category->mProductCategory->id) }}">{{$child_category->mProductCategory->name}}</a>　&gt;　
                    <a href="">{{$child_category->name}}</a>
                @endif
            @else
                <a>検索結果一覧</a>
            @endif　
        </div>
    </div>

    <article>
        <div id="teaser">
            <div class="inner">
                @if (isset($parent_category_flg))
                    @if ($parent_category_flg === 1)
                        <h2>{{$category->name}}</h2>
                    @elseif ($parent_category_flg === 0)
                        <h2>{{$child_category->mProductCategory->name}}</h2>
                    @endif
                @else
                    <h2>検索結果一覧</h2>
                @endif
            </div>
        </div><!-- /.teaser -->
        <div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>

        <div id="contents">
            <div class="inner clearfix">
                @if (isset($parent_category_flg))
                    <div class="titleStyle mt40 mb50">
                        {{-- <p class="sub">{{$category->detail}}仮、説明文が入る</p> --}}
                        <p class="sub"></p>デザイン制作から印刷まで依頼ができるサービスです。チラシ、名刺、封筒、個展の案内状、ポストカードのデザイン、<br>商品を入れるパッケージや箱のデザインサービスも揃っています。<br>ノベルティや趣味で使うステッカーやシール、クリアファイルなどもデザイン制作から印刷まで依頼できます。</p>
                    </div>
                @endif
                <div id="main">
                    <div class="cateList">
                        @if (isset($parent_category_flg))
                            <h2 class="hdM">カテゴリ一覧</h2>
                            <div class="list sliderSP02">
                                @if ($parent_category_flg === 1)
                                    @foreach ($child_categories as $child_category)
                                    {{-- dbに画像と詳細の文言を記入 --}}
                                        <div class="item">
                                            <a href="{{ route('product.category.index.show', $child_category->id) }}"><img src="img/service/img_service01.png" srcset="/img/service/img_service01@2x.png" alt="{{$child_category['name']}}">{{$child_category['name']}}</a>
                                        </div>
                                    @endforeach
                                @elseif ($parent_category_flg === 0)
                                    @foreach ($all_child_categories as $all_child_category)
                                    {{-- dbに画像と詳細の文言を記入 --}}
                                        <div class="item">
                                            <a href="{{ route('product.category.index.show', $all_child_category->id) }}"><img src="img/service/img_service01.png" srcset="/img/service/img_service02@2x.png" alt="{{$all_child_category->name}}">{{$all_child_category['name']}}</a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                    </div>

                    @if (isset($parent_category_flg) && $parent_category_flg === 1)
                        <div class="recommendList style2">
                            <h2 class="hdM">ランキング一覧</h2>
                            <div class="list sliderSP">
                                @foreach( $product_ranks as $product_rank)
                                    <div class="item">
                                        <p class="level"></p>
                                        <a href="{{route('product.show',$product_rank->id)}}" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
                                            <img src="{{ asset('storage/'.$product_rank->path) }}" alt="">
                                            {{-- <button class="favorite">お気に入り</button> --}}
                                        </a>
                                        <div class="info">
                                            <div class="breadcrumb">
                                                {{-- カテゴリのaタグ --}}
                                                <span>{{ $product_rank->mProductChildCategory->mProductCategory->name }}</span>&emsp;＞&emsp;
                                                <span>{{ $product_rank->mProductChildCategory->name }}</span>
                                            </div>
                                            <div class="draw">
                                                <p class="price"><font>{{ $product_rank->title }}</font><br>{{ number_format($product_rank->price) }}円</p>
                                            </div>
                                            <div class="single">
                                                @if($product_rank->is_online == App\Models\Product::OFFLINE)
                                                    <a>対面</a>
                                                @else
                                                    <a>非対面</a>
                                                @endif
                                            </div>
                                            <div class="aboutUser">
                                                <div class="user">
                                                    @if(empty($product_rank->user->userProfile->icon))
                                                        <p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
                                                    @else
                                                        <p class="ico"><img src="{{asset('/storage/'.$product_rank->user->userProfile->icon) }}" alt="" style="border-radius:50%;width:35px;height: 35px;object-fit: cover;"></p>
                                                    @endif
                                                    <div class="introd">
                                                        <p class="name">{{ $product_rank->user->name }}</p>
                                                        <p>({{ App\Models\UserProfile::GENDER[$product_rank->user->userProfile->gender] }}/{{ $product_rank->user->userProfile->birthday }} / {{ $product_rank->user->userProfile->prefecture->name }})</p>
                                                    </div>
                                                </div>
                                                {{-- <div class="evaluate three"><img src="/img/common/evaluate.svg" alt=""></div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- @if (!isset($parent_category_flg)) まだおすすめの決め方が決まっていない
                        <div class="recommendList style2">
                            <h2 class="hdM">おすすめのお仕事</h2>
                            <div class="list sliderSP">
                                <div class="item">
                                    <a href="#" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
                                        <img src="img/common/img_270x160.png" alt="">
                                        <button class="favorite">お気に入り</button>
                                    </a>
                                    <div class="info">
                                        <div class="breadcrumb"><a href="#">デザイン</a>&emsp;＞&emsp;<span>その他デザイン</span></div>
                                        <div class="draw">
                                            <p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>
                                        </div>
                                        <div class="single">
                                            <span>単発リクエスト</span>
                                            <a href="#">対面</a>
                                        </div>
                                        <div class="aboutUser">
                                            <div class="user">
                                                <p class="ico"><img src="img/common/ico_head.png" alt=""></p>
                                                <div class="introd">
                                                    <p class="name">クリエイター名</p>
                                                    <p>(女性/ 20代/ 東京都)</p>
                                                </div>
                                            </div>
                                            <p class="check"><a href="#">本人確認済み</a></p>
                                            <div class="evaluate three"><img src="img/common/evaluate.svg" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif --}}

                    <div class="recommendList style2">
                        <p class="cases">{{$products->total()}}件中
                            {{  ($products->currentPage() -1) * $products->perPage() + 1}} - {{ (($products->currentPage() -1) * $products->perPage() + 1) + (count($products) -1)  }}件の表示
                            {{-- <h3 class="col-7 col-md-9 mb-0 h3">商品一覧（{{$products->total() . '件中' . $products->firstItem() . '-' . $products->lastItem()}}件）</h3> --}}
                        </p>
                        <div class="list sliderSP02">
                            @foreach( $products as $product)
                                <div class="item">
                                    <p class="level"></p>
                                    <a href="{{route('product.show',$product->id)}}" class="img imgBox" data-img="img/common/img_work01@2x.jpg">
                                        <img src="{{ asset('storage/'.$product->path) }}" alt="">
                                        {{-- <button class="favorite">お気に入り</button> --}}
                                    </a>
                                    <div class="info">
                                        <div class="breadcrumb">
                                            <span>{{ $product->mProductChildCategory->mProductCategory->name }}</span>&emsp;＞&emsp;
                                            <span>{{ $product->mProductChildCategory->name }}</span>
                                        </div>
                                        <div class="draw">
                                            <p class="price"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p>
                                        </div>
                                        <div class="single">
                                            @if($product->is_online == App\Models\Product::OFFLINE)
                                                <a>対面</a>
                                            @else
                                                <a>非対面</a>
                                            @endif
                                        </div>
                                        <div class="aboutUser">
                                            <div class="user">
                                                @if(empty($product->user->userProfile->icon))
                                                    <p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
                                                @else
                                                    <p class="ico"><img src="{{asset('/storage/'.$product->user->userProfile->icon) }}" alt="" style="border-radius:50%;width:35px;height: 35px;object-fit: cover;"></p>
                                                @endif
                                                <div class="introd">
                                                    <p class="name">{{ $product->user->name }}</p>
                                                    <p>({{ App\Models\UserProfile::GENDER[$product->user->userProfile->gender] }}/{{ $product->user->userProfile->birthday }} / {{ $product->user->userProfile->prefecture->name }})</p>
                                                </div>
                                            </div>
                                            {{-- @if($product->user->userProfile->is_identify == App\Models\UserProfile::IS_IDENTIFY)
                                                <p class="check"><a href="#">本人確認済み</a></p>
                                            @endif --}}
                                            <div class="evaluate three"><img src="/img/common/evaluate.svg" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class=wp-pagenavi>
                            {{-- <span class="current">1</span>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">7</a>
                            ...
                            <a href="#" class="nextpostslink">次へ</a> --}}
                            {{ $products->links() }}
                        </div>
                    </div>
                </div><!-- /#main -->
                <aside id="side" class="pc">
                    <h2 class="cate cate02">
                        @if (isset($parent_category_flg))
                            @if ($parent_category_flg === 1)
                                {{$category->name}}から探す</h2>
                            @elseif ($parent_category_flg === 0)
                                {{$child_category->mProductCategory->name}}から探す</h2>
                            @endif
                        @endif
                    <ul class="links">
                        @if (isset($parent_category_flg))
                            @if ($parent_category_flg === 1)
                                @foreach ($child_categories as $child_category)
                                    <li><a href="show/{{ $child_category->id }}">{{$child_category->name}}</a></li>
                                @endforeach
                            @elseif ($parent_category_flg === 0)
                                @foreach ($all_child_categories as $all_child_category)
                                    {{-- <li><a href="show/{{ $all_child_category->id }}">{{$all_child_category->name}}</a></li> --}}
                                    <li><a href="{{route('product.category.index.show', $all_child_category->id) }}">{{$all_child_category->name}}</a></li>
                                @endforeach
                            @endif
                        @endif
                        {{-- <li><a href="#">チラシ・DM</a></li>
                        <li><a href="#">名刺</a></li>
                        <li><a href="#">メニュー表</a></li>
                        <li><a href="#">ポスター</a></li>
                        <li><a href="#">カタログ</a></li>
                        <li><a href="#">その他デザイン</a></li> --}}
                    </ul>
                    <form method="get" class="" enctype="multipart/form-data" action="{{ route('product.search') }}">
                        <h2 class="cate cate03">並べ替え</h2>
                        <div class="checkboxChoice">
                            <label><input type="radio" name="sort" value="1" @if (isset($sort) && $sort === '1') checked @endif>ランキングの高い順</label>
                            <label><input type="radio" name="sort" value="2" @if (isset($sort) && $sort === '2') checked @endif>お気に入りの多い順</label>
                            <label><input type="radio" name="sort" value="3" @if (isset($sort) && $sort === '3') checked @endif>新着順</label>
                        </div>
                        <h2 class="cate cate04">絞り込み</h2>
                        <div>
                            <table class="search">
                                <tr>
                                    <th>エリア</th>
                                    <td>
                                        <select name="prefecture_id">
                                            <option value="">-</option>
                                            @foreach($prefectures as $prefecture)
                                                <option value="{{ $prefecture->id }}" @if(isset($prefecture_id) && $prefecture_id == $prefecture->id) selected @endif>{{ $prefecture->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>金額</th>
                                    <td class="elements"><input type="text" name="low_price" placeholder="指定なし" @if(isset($low_price)) value="{{$low_price}}" @endif>~<input type="text" name="high_price" placeholder="指定なし" @if(isset($high_price)) value="{{$high_price}}" @endif></td>
                                </tr>
                                <tr>
                                    <th>仕事体系</th>
                                    <td>
                                        <select name="is_online">
                                            <option value="">-</option>
                                            <option value="{{App\Models\Product::OFFLINE}}" @if(isset($is_online) && $is_online === (string)App\Models\Product::OFFLINE) selected @endif>対面</option>
                                            <option value="{{App\Models\Product::ONLINE}}" @if(isset($is_online) && $is_online === (string)App\Models\Product::ONLINE) selected @endif>非対面</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>年代</th>
                                    <td>
                                        <select name="age_period">
                                            <option value="">-</option>
                                            @foreach(App\Libraries\Age::AGE_PERIOD as $key => $value)
                                                <option value="{{ $key }}" @if (isset($age_period) && $age_period == $key) selected @endif>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            {{-- 検索ではない時 --}}
                            @if (isset($parent_category_flg))
                                @if ($parent_category_flg === 1)
                                    <input type="hidden" name="parent_category_flg" value="1">
                                    <input type="hidden" name="parent_category_id" value="{{ $category->id }}">
                                @elseif ($parent_category_flg === 0)
                                    <input type="hidden" name="parent_category_flg" value="0">
                                    <input type="hidden" name="parent_category_id" value="{{ $child_category->mProductCategory->id }}">
                                    {{-- 連続で検索するとカテゴリーがなくなる --}}
                                    <input type="hidden" name="child_category_id" value="{{ $child_category->id }}">
                                @endif
                            @endif
                        </div>

                        {{-- 検索の時 --}}
                        @if (isset($child_category_id))
                            <input type="hidden" name="child_category_id" value="{{$child_category_id}}">
                        @elseif (isset($parent_category_id))
                            <input type="hidden" name="parent_category_id" value="{{$parent_category_id}}">
                        @endif
                        @if (isset($keyword))
                            <input type="hidden" name="keyword" value="{{$keyword}}">
                        @endif
                        <input type="submit" class="blue-button mb20" style="margin-left: 0" formaction="{{ route('product.search') }}" value="検索する">
                    </form>
                    <h2 class="cate cate05">その他サービスから探す</h2>
                    <ul class="other">
                        <ul class="other">
                            @foreach($categories as $category)
                                <li><a href="{{route('product.category.index', $category->id) }}" class="other{{$loop->iteration}}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </ul>
                </aside><!-- /#side -->
            </div><!--inner-->
        </div><!-- /#contents -->
    </article>
</x-layout>