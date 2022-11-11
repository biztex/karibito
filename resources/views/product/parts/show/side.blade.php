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
            
            <div id="overflow" style="width:100%; height:100%; background-color:rgba(0,0,0,0.2); position:fixed; top:0; left:0; z-index: 10; display: none;">
                <div class="conf" style="background:#FFF; padding:20px; position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">
                    <p class="">本当に削除してもいいですか？</p>
                    <form action="{{ route('product.destroy', $product->id )}}" method="post">
                        @csrf
                        @method('delete')
                        <div class="" >
                            <input type="button" value="キャンセル" class="js-alertCancel" style="box-shadow: 0 6px 0 #999999;height: 55px;font-size: 1.8rem;color:white;max-width: 100%;border-radius: 4px;font-weight:700;">
                            <input type="submit" value="削除" class="orange" style="box-shadow: 0 6px 0 #d85403; height: 55px;font-size: 1.8rem;color:white;max-width: 100%;border-radius: 4px;font-weight:700;">   
                        </div>
                    </form>
                </div>
            </div>
            <div class="functeBtns">
                <input type="button" class="full js-alertModal" style="box-shadow: 0 6px 0 #999999;height: 55px;font-size: 1.8rem;color:white;max-width: 100%;border-radius: 4px;font-weight:700;" value="削除">
            </div>
        @elseif ($product->number_of_sale === App\Models\Product::ONE_OF_SALE && $number_of_sold !== 0) {{--販売個数が一つで、かつ既に購入されているものをこの分岐に入れる--}}
            <div class="functeBtns">
                <a tabindex="-1" class="full">交渉画面へ進む</a>
                <span style="font-size: 0.8em;">この商品は売り切れています。<br>ユーザーにDMでお問い合わせください。</span>
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
        @endif
    </div>

    <x-parts.box-seller :user='$product->user'/>

</aside>
