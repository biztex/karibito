@foreach($messages as $message)
    <!-- 作業完了報告 購入者評価前-->
    @if($message->is_complete_message === 1 && $product_chatroom->status === 4)
        <!-- 購入者側　相手を評価するボタン -->
        @if($message->user_id !== Auth::id())
        <li>
            <div class="img">
                @if(null !== $message->user->userProfile->icon)
                    <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @else
                    <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>作業報告が完了しました</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$product->title}}</p>
                        <p>提供価格：¥{{ number_format($product_chatroom->productProposal[0]->price) }}</p>
                        <p class="buy"><a href="{{route('chatroom.product.evaluation',$product_chatroom->id)}}" class="red">お相手を評価する</a></p>
                    </div>
                </div>
            </div>
        </li>

        <!-- 出品者側 相手の評価待ち -->
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
                    <p>作業報告が完了しました</p>
                    <div class="proposeBuy">
                        <p class="tit">作業報告が完了しました</p>
                        <p>提供価格：¥{{ number_format($product_chatroom->productProposal[0]->price) }}</p>
                        <p class="buy"><input type="submit" value="お相手の評価をお待ちください" disabled></p>
                    </div>
                </div>
            </div>
        </li>
        @endif

    @elseif($message->is_complete_message === 1 && $product_chatroom->status === 5)
        <!-- 購入者側　評価完了-->
        @if($message->user_id !== Auth::id())
        <li>
            <div class="img">
                @if(null !== $message->user->userProfile->icon)
                    <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @else
                    <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>作業報告が完了しました</p>
                    <div class="proposeBuy">
                        <p class="tit">作業報告が完了しました</p>
                        <p>提供価格：¥{{ number_format($product_chatroom->productProposal[0]->price) }}</p>
                        <p class="buy"><input type="submit" value="評価しました" disabled></p>
                    </div>
                </div>
            </div>
        </li>
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
                    <p>作業報告が完了しました</p>
                    <div class="proposeBuy">
                        <p class="tit">作業報告が完了しました</p>
                        <p>提供価格：¥{{ number_format($product_chatroom->productProposal[0]->price) }}</p>
                    </div>
                </div>
            </div>
        </li>
        @endif

    @elseif($message->is_complete_message === 1 && $product_chatroom->status === 6)

        <li>
            <div class="img">
                @if(null !== $message->user->userProfile->icon)
                    <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @else
                    <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>作業報告が完了しました</p>
                    <div class="proposeBuy">
                        <p class="tit">作業報告が完了しました</p>
                        <p>提供価格：¥{{ number_format($product_chatroom->productProposal[0]->price) }}</p>
                        <p class="buy"><input type="submit" value="評価しました" disabled></p>
                    </div>
                </div>
            </div>
        </li>

    <!-- 作業完了報告 出品者評価前-->
    @elseif($message->reference_type === 'App\Models\ProductEvaluation' && $product_chatroom->status === 5)

        <!-- 購入者側　評価完了 -->
        @if($message->user_id === Auth::id())
        <li>
            <div class="img">
                @if(null !== $message->user->userProfile->icon)
                    <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @else
                    <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>評価が完了しました</p>
                    <div class="proposeBuy">
                        <p class="buy none"><input type="submit" value="お相手の評価をお待ちください" disabled></p>
                    </div>
                </div>
            </div>
        </li>

        <!-- 出品者側　相手を評価ボタン -->
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
                    <p>評価が完了しました</p>
                    <div class="proposeBuy">
                        <p class="buy"><a href="{{route('chatroom.product.evaluation',$product_chatroom->id)}}" class="red">お相手を評価する</a></p>
                    </div>
                </div>
            </div>
            <p class="time">既読 2021年7月26日9:10</p>
        </li>
        @endif

    @elseif($message->reference_type === 'App\Models\ProductEvaluation' && $product_chatroom->status === 6)

    <li>
        <div class="img">
            @if(null !== $message->user->userProfile->icon)
                    <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @else
                    <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
            <div class="info">
                <p class="name">{{$message->user->name}}</p>
                <p>評価が完了しました</p>
            </div>
        </div>
    </li>

    <!-- 通常メッセージ -->
    @elseif($message->reference_type === null)
    <li>
        <div class="img">
            @if(null !== $message->user->userProfile->icon)
                <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
            @else
                <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
            @endif
            <div class="info">
                <p class="name">{{$message->user->name}}</p>

                <p class="chatroom-text break-word">{!! $message->text !!}</p>
                @if($message->file_name !== null)
                    <p class="chatroom-text break-word"><a href="{{ asset('/storage/'.$message->file_path) }}" download="{{ $message->file_name }}"  style="display: inline-flex; vertical-align: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                    </svg>{{ $message->file_name }}
                    </a></p>                  
                @endif

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