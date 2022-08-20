<div class="item">
    {{-- <p class="level"></p> --}}
    <div class="info">
        <div class="breadcrumb">
            <a href="{{ route('job_request.category.index',$value->mProductChildCategory->mProductCategory->id) }}">
                {{ $value->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;
            <a href="{{ route('job_request.category.index.show',$value->mProductChildCategory->id)}}">
                {{ $value->mProductChildCategory->name }}</a>
        </div>
        <a href="{{ route('job_request.show',$value->id)}}">
            <div class="draw">
                <p class="price" style="width:100%;">{{ $value->title }}</font></p>
            </div>
            <div class="aboutInfo">
                <dl>
                    <dt><span>予算</span></dt>
                    <dd style="width:100%;">{{ number_format($value->price) }}円〜</dd>
                </dl>
                <dl>
                    <dt><span>提案数</span></dt>
                    <dd>0</dd>
                </dl>
                <dl>
                    <dt><span>募集期限</span></dt>
                    <dd style="padding-left:5px;">{{ rtrim($value->diff_time, '後') }}</dd>
                </dl>
            </div>
        </a>
        
        <div class="aboutUser">
            <div class="user">
                @if(empty($value->user->userProfile->icon))
                    <a href="{{ route('user.mypage', $value->user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                @else
                    <a href="{{ route('user.mypage', $value->user_id) }}" class="ico"><img src="{{asset('/storage/'.$value->user->userProfile->icon) }}" alt=""></a>
                @endif
                <div class="introd">
                    <p class="name">{{ $value->user->name }}</p>
                    <p>({{ App\Models\UserProfile::GENDER[$value->user->userProfile->gender] }} /{{ $value->user->userProfile->age }}/ {{ $value->user->userProfile->prefecture->name }})</p>
                </div>
            </div>

            <x-parts.evaluation-star :star='$value->user->avg_star'/>

        </div>
    </div>
</div>