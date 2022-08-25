<div class="mypageSec01">
    <div class="mypageCover">
        @if(!empty(Auth::user()->userProfile->cover))
            <img src="{{asset('/storage/'.Auth::user()->userProfile->cover) }}" style="width: 100%;height: 100%;object-fit: cover;">
        @else
            <img src="/img/mypage/img_rainbow.png" style="width: 100%;height: 100%;object-fit: cover;">
        @endif

        <form method="POST" action="{{ route('cover.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')
                <input type="file" name="cover" class="cover1" style="display:none;">
                <label for="file" class="update_cover"><img class="add_cover" src="/img/mypage/icon_cover.svg" alt="カバー写真を追加"></label>
                <input type="submit" name="submit_cover" style="display:none;">
        </form>

    </div>
    <dl class="mypageDl01">
        @if(empty(Auth::user()->userProfile->icon))
            <dt><img src="/img/mypage/no_image.jpg" alt=""></dt>
        @else
            <dt><img src="{{asset('/storage/'.Auth::user()->userProfile->icon) }}" alt=""></dt>
        @endif
        <dd>
            <div class="mypageP01 word-break">{{Auth::user()->userProfile->user->name}} <a href="#fancybox_person" class="fancybox fancybox_profile"><img src="/img/mypage/btn_person.svg" alt="プロフィールを編集"></a></div>
            <p class="mypageP02">最終ログイン：{{Auth::user()->latest_login_datetime}}</p>
            <p class="mypageP03">({{App\Models\UserProfile::GENDER[Auth::user()->userProfile->gender]}} / {{Auth::user()->userProfile->age}} / {{Auth::user()->userProfile->prefecture->name}}) <!-- <span>所持ポイント：0000pt</span> --></p>
            <p class="mypageP04 check">
                @if(Auth::user()->userProfile->is_identify == 1)
                    <a>本人確認済み</a>
                @endif
                {{-- <a href="#">機密保持契約(NDA) 可能</a></p> --}}
            <p class="mypageP05"><a href="{{ route('evaluation') }}" class="more">過去の評価を詳しく見る</a></p>
            <div class="mypageP06">
                <x-parts.evaluation-star :star='Auth::user()->avg_star'/><p style="font-size: 1.5rem;line-height: 1;color: #158ACC;">(<a href="{{ route('evaluation') }}">{{ number_format(Auth::user()->avg_star,1) }}</a>)</p>
            </div>
        </dd>
    </dl>
    <div class="mypageIntro">
        <p class="mypageHd01">自己紹介</p>
        <p class="mypageIntroTxt text-black">{!! nl2br(e(Auth::user()->userProfile->introduction)) !!}</p>
    </div>
    <div class="mypageProud">
        @if($specialties->isNotEmpty())
        <p class="mypageHd01">得意分野</p>
        @endif
        <ul class="mypageProudUl">
            @foreach($specialties as $specialty)
            <li>{{ $specialty->content }}</li>
            @endforeach
        </ul>
    </div>
</div>