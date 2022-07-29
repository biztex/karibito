<div class="item">
    <!-- <p class="level"></p> topのみ -->
    <div class="info">
        <div class="breadcrumb"><a href="{{ route('job_request.category.index',$value->mProductChildCategory->mProductCategory->id) }}">{{ $value->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;<a href="{{ route('job_request.category.index.show',$value->mProductChildCategory->id)}}">{{ $value->mProductChildCategory->name }}</a></div>
        <a href="{{ route('job_request.show',$value->id)}}">
            <div class="draw">
                <p class="price">{{ $value->title }}</font></p>
            </div>
            <div class="aboutInfo">
                <dl>
                    <dt><span>予算</span></dt>
                    <dd>{{ number_format($value->price) }}円〜</dd>
                </dl>
                <dl>
                    <dt><span>提案数</span></dt>
                    <dd>0</dd>
                </dl>
                <dl>
                    <dt><span>募集期限</span></dt>
                    <dd>{{ $value->deadline_day }}日と{{ $value->deadline_hour }}時間</dd>
                </dl>
            </div>
        </a>
        <div class="aboutUser">
            <div class="user">
                @if(empty($value->user->userProfile->icon))
                <p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
                @else
                <p class="ico"><img src="{{asset('/storage/'.$value->user->userProfile->icon) }}" alt="" style="border-radius:50%;width:35px;height: 35px;object-fit: cover;"></p>
                @endif
                <div class="introd">
                    <p class="name">{{ $value->user->name }}</p>
                    <p>({{ App\Models\UserProfile::GENDER[$value->user->userProfile->gender] }} /{{ $value->user->userProfile->birthday }}/ {{ $value->user->userProfile->prefecture->name }})</p>
                </div>
            </div>
            <div class="evaluate three"><img src="/img/common/evaluate.svg" alt=""></div>
        </div>
    </div>
</div>