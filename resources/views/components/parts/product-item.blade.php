<div class="item">
	<!-- <p class="level"></p> topのカテゴリー別のみ仕様 -->
    <a href="{{ route('product.show',$product->id) }}" class="img imgBox">
        @if(isset($product->productImage[0]))
            <img src="{{ asset('/storage/'.$product->productImage[0]->path) }}" alt="" style="width: 192px;height: 160px;object-fit: cover;">
            <button class="favorite">お気に入り</button>
        @else
            <img src="/img/common/img_work01@2x.jpg" alt="">
            <button class="favorite">お気に入り</button>
        @endif
    </a>
    <div class="infoTop">
        <div>
            <div class="breadcrumb">
                <a href="{{ route('product.category.index',$product->mProductChildCategory->mProductCategory->id) }}">
                    {{ $product->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;
                <a href="{{ route('product.category.index.show',$product->mProductChildCategory->id)}}">
                    {{ $product->mProductChildCategory->name }}</a>
            </div>
            <div class="draw">
                <p class="price" style="width:100%"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p>
            </div>
            <div class="single">
                @if($product->is_online == App\Models\Product::OFFLINE)
                    <span>対面</span>
                @else
                    <span>非対面</span>
                @endif
            </div>
        </div>
        <div class="aboutUser">
            <div class="user" style="margin-bottom:6px;">
                @if(empty($product->user->userProfile->icon))
                    <p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
                @else
                    <p class="ico"><img src="{{asset('/storage/'.$product->user->userProfile->icon) }}" alt=""></p>
                @endif
                <div class="introd">
                    <p class="name">{{ $product->user->name }}</p>
                    <p>({{ App\Models\UserProfile::GENDER[$product->user->userProfile->gender] }}/ {{ $product->user->userProfile->age }}/ {{ $product->user->userProfile->prefecture->name }})</p>
                </div>
            </div>

            <x-parts.evaluation-star :star='$product->user->avg_star'/>

        </div>
    </div>
</div>