<aside id="side">
    <div class="box reservate">
        <h3>{{number_format($product->price)}}円</h3>
        <p class="status">所用期間</p>
        <p class="date">{{$product->number_of_day}}
            @if ( $product->time_unit === 1 ) 
                日
            @else 
                時間
            @endif
        </p>
        <!-- <div class="calendar"><div id="datepicker"></div></div> -->
    </div>
    <div class="functeBtns">
        @if(empty($product->user))
            <div class="indexNotice">
                <h3 class="hd">このユーザーは退会しました。</h3>
            </div>
        @elseif($product->user_id === Auth::id() )
            <div class="functeBtns">
                <a href="{{ route('product.edit', $product->id)}}" class="orange full">編集</a>
            </div>
            <form id="delete-product" method="post" action="{{ route('product.destroy', $product->id ) }}">
                @csrf @method('delete')
                <div class="functeBtns">
                    <input type="button" class="full js-alertModal" style="box-shadow: 0 6px 0 #999999;height: 55px;font-size: 1.8rem;color:white;max-width: 100%;border-radius: 4px;font-weight:700;" value="削除">
                </div>
            </form>
        @elseif ($product->number_of_sale === App\Models\Product::ONE_OF_SALE && $number_of_sold !== 0) {{--販売個数が一つで、かつ既に購入されているものをこの分岐に入れる--}}
            <div class="functeBtns">
                <a tabindex="-1" class="full">交渉画面へ進む</a>
                <span style="font-size: 0.8em;">このサービスは売り切れています。<br>ユーザーにDMでお問い合わせください。</span>
            </div>
        @else
            <div class="functeBtns">
                <a href="{{ route('chatroom.new.product', $product->id ) }}" class="orange full">交渉画面へ進む</a>
            </div>
        @endif
    </div>
    <div>
        <div class="peace">
            <h3>カリビト安心への取り組み</h3>
            <p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
        </div>
        @if(isset($product->user))
            <p class="specialtyBtn share"><span>この情報をシェアする</span></p>
            <form action="{{ route('contact') }}" method="get">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <p class="specialtyBtn"><input type="submit" class="report_btn" value="このサービスを通報する"></p>
            </form>
        @endif
    </div>

    <x-parts.box-seller :user='$product->user'/>
</aside>
<x-parts.alert-modal formId="delete-product" />
