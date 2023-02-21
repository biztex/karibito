<div class="mypageSec01">
    <div class="mypageCover">
        <div class="cover_background">
            @if(!empty(Auth::user()->userProfile->cover))
                <img src="{{asset('/storage/'.Auth::user()->userProfile->cover) }}">
            @else
                <img src="/img/mypage/img_rainbow.png" style="object-fit: cover;">
            @endif
        </div>
        <form method="POST" action="{{ route('cover.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')
                <input type="file" name="cover" class="cover1" style="display:none;">
                <label for="file" class="update_cover"><img class="add_cover" src="/img/mypage/icon_cover.svg" alt="カバー写真を追加"></label>
                <p class="mypageCoverText">推奨サイズ width 1560px height 460px</p>
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
            <div class="mypageP01 word-break">{{Auth::user()->name}} <span class="mypageP03">MYコード：{{ Auth::user()->userProfile->my_code }}</span> <a href="#fancybox_person" class="fancybox fancybox_profile"><img src="/img/mypage/btn_person.svg" alt="プロフィールを編集"></a></div>
            <p class="mypageP02">最終ログイン：{{Auth::user()->latest_login_datetime}}</p>
            <p class="mypageP03">({{App\Models\UserProfile::GENDER[Auth::user()->userProfile->gender]}} / {{Auth::user()->userProfile->age}} / {{Auth::user()->userProfile->prefecture->name}}) <!-- <span>所持ポイント：0000pt</span> --></p>
            <p class="mypageP04 check">
                @if(Auth::user()->userProfile->is_identify == 1)
                    <a>本人確認済み</a>
                    <a>NDA可</a>
                @endif
            </p>
            <div class="countBox">
                <p class="countItem">販売実績数：{{ $total_sales_count }}</p>
                <p class="countItem">キャンセル完了数：{{ $cancel_count }}</p>
            </div>
            <div class="mypageP06 starBox">
                <div class="starBoxIcon">
                    <x-parts.evaluation-star :star='Auth::user()->avg_star'/>
                    @if(Auth::user()->avg_star === null)
                        <p style="font-size: 1.5rem;line-height: 1;color: #158ACC;">(<a href="{{ route('evaluation') }}">0.0</a>)</p>
                    @else
                        <p style="font-size: 1.5rem;line-height: 1;color: #158ACC;">(<a href="{{ route('evaluation') }}">{{ number_format(Auth::user()->avg_star,1) }}</a>)</p>
                    @endif
                </div>
                <p class="mypageP05 starBoxText"><a href="{{ route('evaluation') }}" class="more">過去の評価を詳しく見る</a></p>
            </div>
        </dd>
    </dl>
    <div class="mypageIntro">
        <p class="mypageHd01">自己紹介</p>
        <p class="mypageIntroTxt text-black">{!! nl2br(e(Auth::user()->userProfile->introduction)) !!}</p>
    </div>
    <div class="mypageProud">
        @if(Auth::user()->specialty->isNotEmpty())
            <p class="mypageHd01">得意分野</p>
            <ul class="mypageProudUl">
                @foreach(Auth::user()->specialty as $specialty)
                    <li>{{ $specialty->content }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>