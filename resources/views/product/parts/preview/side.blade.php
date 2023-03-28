<aside id="side">
    <div class="box reservate">
        <h3>@if(!is_null($request->price))
                {{ number_format($request->price) }}
            @endif円
        </h3>
        <input type="hidden" value="@if(!is_null($request->price)){{ $request->price }}@endif" name="price">
        <p class="status">所用期間</p>
        <p class="date">{{$request->number_of_day}}
            @if ($request->time_unit == 1 )
                日
            @else
                時間
            @endif
        </p>

        <input type="hidden" value="@if(!is_null($request->time_unit)){{ $request->time_unit }}@endif" name="time_unit">
        <input type="hidden" value="@if(!is_null($request->number_of_day)){{ $request->number_of_day }}@endif" name="number_of_day">
        <!-- <div class="calendar"><div id="datepicker"></div></div> -->
    </div>
    <div>
        <div class="peace">
            <h3>カリビト安心への取り組み</h3>
            <p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
        </div>
        <div class="functeBtns">
            @if(empty($product))
                <input type="submit" class="orange_o" style="color:#EB6A1A;font-weight:700;font-size: 1.8rem;height: 55px;" formaction="{{ route('product.post.create') }}" value="編集画面に戻る">
            @else
                <input type="submit" class="orange_o" style="color:#EB6A1A;font-weight:700;font-size: 1.8rem;height: 55px;" formaction="{{ route('product.post.edit', $product->id) }}" value="編集画面に戻る">
            @endif
        </div>
        <div class="functeBtns">
            <input type="submit" class="orange" style="color: #fff;font-weight:700;box-shadow: 0 6px 0 #d85403;height: 55px;font-size: 1.8rem;" value="サービスを登録する">
        </div>
    </div>

    <x-parts.box-seller :user="$user" :cancel_count="$cancel_count" :total_sales_count="$total_sales_count"/>
</aside>
