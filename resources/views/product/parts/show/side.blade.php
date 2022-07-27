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
                        <input type="submit" class="full" style="box-shadow: 0 6px 0 #999999;height: 55px;font-size: 1.8rem;color:white;max-width: 100%;border-radius: 4px;font-weight:700;" value="削除">
                    </div>
                </form>
            @elseif($product->user_id !== Auth::id())
                <div class="functeBtns">
                    <a href="{{ route('chatroom.new.product', $product->id ) }}" class="orange full">交渉画面へ進む</a>
                </div>
            @endif
        </div>
        <p class="specialtyBtn"><span>この情報をシェアする</span></p>
    </div>
    <div class="box seller">
        <h3>スキル出品者</h3>
            @if(empty($product->user->userProfile->icon))
                <a href="{{ route('user.mypage', $product->user) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
            @else
                <a href="{{ route('user.mypage', $product->user) }}" class="head"><img src={{asset('/storage/'.$product->user->userProfile->icon) }} alt=""></a>
            @endif
        <!-- <p class="login">最終ログイン：8時間前</p> -->
        <p class="introd"><a href="{{ route('user.mypage', $product->user) }}" class="name">{{$product->user->name}}</a><br>({{App\Models\UserProfile::GENDER[$product->user->userProfile->gender]}} / {{$product->user->userProfile->birthday}}/ {{$product->user->userProfile->prefecture->name}})</p>
        <!-- <div class="evaluate three"></div> -->
        @if($product->user->userProfile->is_identify = 1)
            <p class="check"><a href="#">本人確認済み</a></p>
        @endif
    </div>
</aside>