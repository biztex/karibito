<aside id="side">
    <div class="box reservate">
        <h3>{{number_format($product->price)}}円</h3>
        <p class="status">所用期間</p>
        <p class="date">{{$product->number_of_day}}日</p>
        <!-- <div class="calendar"><div id="datepicker"></div></div> -->
    </div>
    <div>
        <div class="peace">
            <h3>カリビト安心への取り組み</h3>
            <p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
        </div>
        <div class="functeBtns">
            @if($product->user_id === Auth::id() )
                <div class="functeBtns">
                    <a href="{{ route('product.edit', $product->id)}}" class="orange full">編集</a>
                </div>
                <form method="post" action="{{ route('product.destroy', $product->id ) }}">
                    @csrf @method('delete')
                    <div class="functeBtns">
                        <input type="submit" onclick='return confirm("削除してもよろしいですか？");' class="full" style="box-shadow: 0 6px 0 #999999;height: 55px;font-size: 1.8rem;color:white;max-width: 100%;border-radius: 4px;font-weight:700;" value="削除">
                    </div>
                </form>
            @elseif ($product->number_of_sale === App\Models\Product::ONE_OF_SALE && $chatroom_status === 6) {{--販売個数が一つで、かつ既に購入されているものをこの分岐に入れる--}}
                <div class="functeBtns">
                    <a tabindex="-1" class="full">交渉画面へ進む</a>
                    <span>この商品は売り切れています。ユーザーにDMでお問い合わせください。</span>
                </div>
            @else
                <div class="functeBtns">
                    <a href="{{ route('chatroom.new.product', $product->id ) }}" class="orange full">交渉画面へ進む</a>
                </div>
            @endif
        </div>
        <p class="specialtyBtn share"><span>この情報をシェアする</span></p>
    </div>

    <x-parts.box-seller :user='$product->user'/>

</aside>
<x-parts.share-modal/>