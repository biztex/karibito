<div id="">
    <div class="recommendList style2 moreRecommendList">
        <h2 class="hdM">{{$product->user->name}}さんのその他の出品</h2>
        <div class="list sliderSP">
            @foreach($all_products as $value)
                <div class="item"  style="height:372.71px">
                    <a href="{{route('product.show',$product->id)}}" class="imgBox">
                        @if(isset($value->productImage[0]))
                            <img class="moreRecommendListImg" src="{{ asset('/storage/'.$value->productImage[0]->path) }}" alt="" >
                        @else
                            <img class="moreRecommendListImg" src="/img/common/img_work01@2x.jpg" alt="">
                        @endif
                            <button class="favorite">お気に入り</button>
                    </a>
                    <div class="info moreRecommendListInfo">
                        <div class="breadcrumb"><a href="#">@if(!is_null($value->category_id)){{$value->mProductChildCategory->mProductCategory->name}} @endif</a>&emsp;＞&emsp;<span>@if(!is_null($value->category_id)){{$value->mProductChildCategory->name}}@endif</span></div>
                        <div class="draw">
                            <p class="ico"><img src="/img/service/ico_color.png" alt=""></p>
                            <p class="price word-break"><font>{{$value->title}}</font><br>{{ number_format($value->price) }}円</p>
                        </div>
                        <div class="single">
                            <span>{{App\Models\Product::IS_ONLINE[$value->is_online]}}</span>
                        </div>
                        <div class="aboutUser">
                            <div class="user">
                                @if(empty($value->user->userProfile->icon))
                                    <a href="{{ route('user.mypage', $value->user->id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                @else
                                    <a href="{{ route('user.mypage', $value->user->id) }}" class="ico"><img src="{{asset('/storage/'.$value->user->userProfile->icon) }}" alt=""></a>
                                @endif
                                <div class="introd">
                                    <p class="name word-break">{{$value->user->name}}</p>
                                    <p>({{App\Models\UserProfile::GENDER[$value->user->userProfile->gender]}}/ {{$value->user->userProfile->age}}/ {{$value->user->userProfile->prefecture->name}})</p>
                                </div>
                            </div>
                            <div class="evaluates">
                                <span class="good">{{ $evaluation_counts['good'] }}</span>
                                <span class="usually">{{ $evaluation_counts['usually'] }}</span>
                                <span class="pity">{{ $evaluation_counts['pity'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>