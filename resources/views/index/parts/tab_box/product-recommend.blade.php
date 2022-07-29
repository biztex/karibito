<div class="recommendList style2">
    <h2 class="hdM">おすすめのお仕事</h2>
    <div class="list sliderSP">
        @if (!isset($recommend_products))
            <h2>現在、おすすめのお仕事は登録されていません。</h2>
        @else
            @foreach($recommend_products as $value)
                <x-parts.product-item :product='$value'/>
            @endforeach
        @endif
    </div>
</div>