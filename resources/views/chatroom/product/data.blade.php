@foreach($messages as $message)
    @if($message->reference_type === null)
    <!-- 通常メッセージ -->
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
    @endif
@endforeach