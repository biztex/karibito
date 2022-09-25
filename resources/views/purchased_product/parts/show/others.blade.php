<div id="">
    <div class="recommendList style2">
        <h2 class="hdM">{{$product->user->name}}さんのその他の出品</h2>
        <div class="list sliderSP">
            @foreach($all_products as $value)
                <x-parts.product-item :product="$value"/>
            @endforeach
        </div>
    </div>
</div>