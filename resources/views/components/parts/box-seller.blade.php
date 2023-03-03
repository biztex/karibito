@if(isset($user))
<div class="box seller">
  <h3>スキル出品者</h3>
  @if(empty($user->userProfile->icon))
      <a href="{{ route('user.mypage', $user) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
  @else
      <a href="{{ route('user.mypage', $user) }}" class="head"><img src={{asset('/storage/'.$user->userProfile->icon) }} alt=""></a>
  @endif
  <p class="login">最終ログイン：{{ $user->latest_login_datetime }}</p>
  <p class="introd"><a href="{{ route('user.mypage', $user) }}" class="name">{{$user->name}}</a><br>({{App\Models\UserProfile::GENDER[$user->userProfile->gender]}} / {{$user->userProfile->age}}/ {{$user->userProfile->prefecture->name}})</p>

  <div class="countBox countBoxSide">
    <p class="countItem">販売実績数：{{ $totalSalesCount }}</p>
    <p class="countItem">キャンセル完了数：{{ $cancelCount }}</p>
  </div>

    @if($user->userProfile->is_identify == 1)
        <p class="mypageP04 check">
            <a>本人確認済み</a>
            @if($user->userProfile->is_nda == 1)
                <a>秘密保持契約（NDA) 可</a>
            @endif
        </p>
    @endif
  <x-parts.evaluation-star :star='$user->avg_star'/>
</div>
@endif