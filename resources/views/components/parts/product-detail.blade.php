<!--　使用例 <x-parts.product-detail :product="$product"/> -->

<div class="item">
    <a href="{{route('product.show',$product->id)}}" class="img imgBox">
        @if(isset($product->productImage[0]))
            <p class="img"><img src="{{ asset('/storage/'.$product->productImage[0]->path) }}" alt="" style="width: 192px;height: 160px;object-fit: cover;"></p>
            <button class="favorite">お気に入り</button>
        @else
            <p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
            <button class="favorite">お気に入り</button>
        @endif
    </a>
    <div class="infoTop">
        <div>
            <div class="breadcrumb"><a href="#">{{ $product->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $product->mProductChildCategory->name }}</span></div>
            <div class="draw">
                <p class="price" style="width:100%"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p>
            </div>
            <div class="single">
                @if($product->is_online == App\Models\Product::OFFLINE)
                <a href="#">対面</a>
                @else
                <a href="#">非対面</a>
                @endif
            </div>
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
            @if($product->user->userProfile->is_identify == App\Models\UserProfile::IS_IDENTIFY)
                <p class="check"><a href="#">本人確認済み</a></p>
            @endif
            <div class="evaluate three"><img src="/img/common/evaluate.svg" alt=""></div>
        </div>
    </div>
</div>