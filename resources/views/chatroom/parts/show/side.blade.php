<aside id="side">
    <div class="sideItem">
        <p class="sideHd">掲載内容</p>
        <div class="sideUl01">

        @if($chatroom->reference_type === 'App\Models\Product')
            <div class="publicate">
                <div class="cont">
                    @if(isset($chatroom->reference->productImage[0]))
                        <p class="img"><img src="{{ asset('/storage/'.$chatroom->reference->productImage[0]->path)}}" alt="" style="width: 75px;height: 62.5px;object-fit: cover;"></p>
                    @else
                        <p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
                    @endif
                    <p class="txt">{{ $chatroom->reference->title }}</p>
                </div>
                <div class="amount">
                    <p>希望報酬額</p>
                    <p class="num">¥{{ number_format($chatroom->reference->price) }}</p>
                </div>
            </div>
        @else
            <div class="publicate">
                <div class="cont">
                    <p class="txt">{{ $chatroom->reference->title }}</p>
                </div>
                <div class="amount">
                    <p>予算額</p>
                    <p class="num">¥{{ number_format($chatroom->reference->price) }}</p>
                </div>
            </div>

        @endif

        </div>

        <div class="functeBtns">
            @if($chatroom->seller_user_id === Auth::id())
                @if($chatroom->status === 1)
                    <a href="#fancybox_proposal" class="orange fancybox">提案する</a>
                @elseif($chatroom->status === 3)
                    <a href="{{route('chatroom.complete', $chatroom->id)}}" class="orange">作業完了報告をする</a>
                @endif
            @endif
            @if($chatroom->status > 2 && $chatroom->status < 5)
                <input type="submit" class="" value="キャンセル申請をする">
            @endif
        </div>

    </div>
</aside>

<div class="hide"><!-- #fancybox_proposal -->
    <div id="fancybox_proposal" class="fancyboxWrap">
        <form action="{{ route('chatroom.proposal', $chatroom->id) }}" method="POST">
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
                            <p class="th">提供価格</p>
                            <p class="budget"><input type="text" name="price" placeholder="0" autofocus></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="functeBtns">
                <input type="submit" class="orange" value="この内容で商品を提案する">
            </div>
        </form>
    </div>
</div><!-- /#fancybox_proposal -->