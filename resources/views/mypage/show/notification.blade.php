<div class="mypageSec02">
    <p class="mypageHd02">お知らせ@if(!empty($user_notifications[0]))<a href="{{ route('user_notification.index') }}" class="more">お知らせをもっと見る</a>@endif</p>
    <ul class="mypageUl02">
        @if(empty($user_notifications[0]))
            <div class="pl10">カリビトからのお知らせがありません。</div>
        @else
            @foreach($user_notifications as $user_notification)
                <li>
                    <a href="{{route('already_read.show', $user_notification->id)}}">
                        <dl>
                            <dt><img src="img/mypage/img_notice01.png" alt=""></dt>
                            <dd>
                                <p class="txt">{{$user_notification->title}}</p>
                                <p class="time">{{$user_notification->created_at->diffForHumans()}}</p>
                            </dd>
                        </dl>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>