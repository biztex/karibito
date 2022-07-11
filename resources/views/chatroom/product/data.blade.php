@foreach($messages as $message)
    <!-- 通常メッセージ -->
    @if($message->reference_type === null)
    <li>
        <div class="img">
            @if(null !== $message->user->userProfile->icon)
                <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
            @else
                <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
            @endif
            <div class="info">
                <p class="name">{{$message->user->name}}</p>
                <p>{!! nl2br(e($message->text)) !!}</p>
            </div>
        </div>
        <p class="time">既読 {{date('Y年m月d日 G:i', strtotime($message->created_at))}}</p>
    </li>

    <!-- 提案 -->
    @elseif($message->reference_type === 'App\Models\ProductProposal')
        <!-- 未購入 -->
        @if($message->reference->is_purchese === 0)
            <!-- 購入者側 -->
            @if($message->reference->user_id !== Auth::id())
            <li>
                <div class="img">
                    @if(null !== $message->user->userProfile->icon)
                        <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                    @else
                        <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                    @endif
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p>掲載内容の提案をしました</p>
                        <div class="proposeBuy">
                            <p class="tit">{{$product->title}}</p>
                            <p>提供価格：¥{{ number_format($product_chatroom->productProposal[0]->price) }}</p>
                            <p class="buy"><a href="{{route('chatroom.product.purchese', $message->reference->id)}}">購入する</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <!-- 出品者側 -->
            @else
            <li>
                <div class="img">
                    @if(null !== $message->user->userProfile->icon)
                        <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                    @else
                        <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                    @endif
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p>掲載内容の提案をしました</p>
                        <div class="proposeBuy">
                            <p class="tit">{{$product->title}}<p>
                            <p>提供価格：¥{{ number_format($product_chatroom->productProposal[0]->price) }}</p>
                            <p class="buy"><input type="submit" value="購入されていません" disabled></p>
                        </div>
                    </div>
                </div>
            </li>
            @endif
        <!-- 購入済 -->
        @else

            <li>
                <div class="img">
                    @if(null !== $product_chatroom->sellerUser->userProfile->icon)
                        <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$product_chatroom->sellerUser->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                    @else
                        <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                    @endif
                    <div class="info">
                        <p class="name">{{$product_chatroom->sellerUser->name}}</p>
                        <p>掲載内容の提案をしました</p>
                        <div class="proposeBuy">
                            <p class="tit">{{$product->title}}</p>
                            <p>提供価格：¥{{ number_format($product_chatroom->productProposal[0]->price) }}</p>
                            <p class="buy"><input type="submit" class="white" value="購入済み"></p>
                        </div>
                    </div>
                </div>
            </li>


            <li>
                <div class="img">
                    @if(null !== $product_chatroom->buyerUser->userProfile->icon)
                        <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$product_chatroom->buyerUser->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                    @else
                        <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                    @endif
                    <div class="info">
                        <p class="name">{{$product_chatroom->buyerUser->name}}</p>
                        <p>商品を購入しました</p>
                        <div class="proposeBuy">
                            <p class="tit">{{$product->title}}</p>
                            <p>提供価格：¥{{ number_format($product_chatroom->productProposal[0]->price) }}</p>
                        </div>
                    </div>
                </div>
                <p class="time">既読 2021年7月26日9:10</p>
            </li>


        @endif
    @endif
@endforeach