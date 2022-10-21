<aside id="side">
    <div class="sideItem">
        <p class="sideHd">掲載内容</p>
        <div class="sideUl01">
            @if ($chatroom->referencePurchased !== null)
                @if ($chatroom->purchased_reference_type === 'App\Models\PurchasedProduct')

                    @include('chatroom.parts.show.product.purchased-product')

                @elseif ($chatroom->purchased_reference_type === 'App\Models\PurchasedJobRequest')

                    @include('chatroom.parts.show.product.purchased-job-request')

                @endif
            @else
                @if($chatroom->reference === null)

                    <div style="padding:15px; font-weight:100;">この商品は削除されました</div>

                @elseif($chatroom->reference_type === 'App\Models\Product')

                    @include('chatroom.parts.show.product.product')

                @else

                    @include('chatroom.parts.show.product.job-request')

                @endif
            @endif
        </div>

        @if(empty($partner->deleted_at))
            <div class="functeBtns">
                @if($chatroom->seller_user_id === Auth::id())
                    @if($chatroom->status === App\Models\Chatroom::STATUS_START || $chatroom->status === App\Models\Chatroom::STATUS_PROPOSAL)
                        <a href="#fancybox_proposal" class="orange fancybox">提案する</a>
                    @elseif($chatroom->status === App\Models\Chatroom::STATUS_WORK)
                        <form id="form" action="{{ route('chatroom.complete', $chatroom->id) }}" method="get">
                            @csrf
                            <input type="submit" class="orange loading-disabled" style="height: 55px;font-size: 1.8rem;max-width: 280px;color:white;font-weight: bold;" onclick='return confirm("納品完了報告をしてもよろしいですか？");'value="納品を完了する">
                        </form>
                    @endif
                    @if($chatroom->isCancelable())
                        <a href="{{ route('cancel.create', $chatroom->purchase->id) }}" class="cancel">キャンセル申請をする</a>
                    @endif
                @endif
            </div>
        @else
            <p>このユーザーは退会しています。</p>
        @endif
    </div>
</aside>

@if($chatroom->reference !== null)
    <div class="hide"><!-- #fancybox_proposal -->
        <div id="fancybox_proposal" class="fancyboxWrap">
            <form id="form" action="{{ route('chatroom.proposal', $chatroom->id) }}" method="POST">
            @csrf
                <p class="fancyboxHd">掲載内容の提案</p>
                <div class="fancyboxCont">
                    <div class="fancyboxProposal">
                        <ul class="contactForm">
                            <li>
                                <p><span class="th">商品名</span><br>{{ $chatroom->reference->title }}</p>
                            </li>
                            <li>
                                <div class="amount">
                                    <p>希望報酬額</p>
                                    <p class="num">¥{{ number_format($chatroom->reference->price) }}</p>
                                </div>
                                @error('price')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                <p class="th">提供価格</p>
                                <p class="budget"><input type="text" name="price" placeholder="0" autofocus value="{{old('price')}}"></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="functeBtns">
                    <input type="submit" class="orange loading-disabled" value="この内容で商品を提案する">
                </div>
            </form>
        </div>
    </div><!-- /#fancybox_proposal -->
@endif