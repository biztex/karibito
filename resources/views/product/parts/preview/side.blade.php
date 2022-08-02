<aside id="side">
    <div class="box reservate">
        <h3>@if(!is_null($request->price))
                {{ number_format($request->price) }}
            @endif円
        </h3>
        <input type="hidden" value="@if(!is_null($request->price)){{ $request->price }}@endif" name="price">
        <p class="status">所用期間</p>
        <p class="date">
            @if(!is_null($request->number_of_day))
                {{ number_format($request->number_of_day) }}
            @endif日
        </p>
        <input type="hidden" value="@if(!is_null($request->number_of_day)){{ $request->number_of_day }}@endif" name="number_of_day">
        <!-- <div class="calendar"><div id="datepicker"></div></div> -->
    </div>
    <div>
        <div class="peace">
            <h3>カリビト安心への取り組み</h3>
            <p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
        </div>
        <div class="functeBtns">
            <input type="submit" class="orange_o" style="color:#EB6A1A;font-weight:700;font-size: 1.8rem;height: 55px;" formaction="{{ route('product.post.create') }}" value="編集画面に戻る">
        </div>
        <div class="functeBtns">
            <input type="submit" class="orange full" style="color: #fff;font-weight:700;box-shadow: 0 6px 0 #d85403;height: 55px;font-size: 1.8rem;" value="サービス提供を開始">
        </div>
    </div>
    
    <x-parts.box-seller :user='$user'/>

</aside>