<aside id="side" class="">
    <div class="box seller">
        <h3>スキル出品者</h3>
        @if(null !== $user->userProfile->icon)
            <a href="#" class="head"><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt="" style="width: 120px;height: 120px;object-fit: cover;"></a>
        @else
            <a href="#" class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 120px;height: 120px;object-fit: cover;"></a>
        @endif
        <!-- <p class="login">最終ログイン：8時間前</p> -->

        <p class="introd"><span>{{$user->name}}</span><br>({{\App\Models\UserProfile::GENDER[$user->userProfile->gender]}}/ {{ $user->userProfile->age }}/ {{$user->userProfile->prefecture->name}})</p>

        <x-parts.evaluation-star :star='$user->avg_star'/>

        <p class="check"><a>本人確認済み</a></p>
        <!-- <p class="check"><a href="#">機密保持契約(NDA) 可能</a></p> -->
        @if (\Auth::id() !== $user->id)
            <div class="blogDtOtherBtn">
            <a href="#" class="followA">フォローする</a>
            @if(empty($dmrooms))
                <a href="{{ route('dm.create',$user->id) }}">メッセージを送る</a>
            @else
                <a href="{{ route('dm.show',$dmrooms->id) }}">メッセージを送る</a>
            @endif
        @endif
        </div>
    </div>
</aside><!-- /#side -->