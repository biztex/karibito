<div class="recommendList style2">
    <h2 class="hdM">カテゴリ別ランキング</h2>
    @if (!isset($product_category_ranks))
        <h2>現在、カテゴリ別ランキングはありません。</h2>
    @else
        @foreach($product_category_ranks as $m_product_category)
            <div class="js-hide_product_categories @if ($loop->index >= 10) hide @endif">
                <h3 class="cateTit"><span>{{ $m_product_category->name }}</span><a href="{{route('product.category.index', $m_product_category->id) }}" class="more">{{ $m_product_category->name }}から探す</a></h3>
                <div class="list sliderSP">
                {{ $count = 0 }}
                    @foreach($products as $product)
                        @if( $product->mProductChildCategory->mProductCategory->id === $m_product_category->id)
                            {{ $count++ }}
                            @if($count <= 10)
                                <x-parts.product-item :product='$product'/>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="otherBtn"><a href="javascript:;" class="js-productOtherBtn">その他カテゴリ別ランキングをみる</a></div>