<div class="item">
	<!-- <p class="level"></p> topのカテゴリー別のみ仕様 -->
    <a href="{{ route('user.blog.show', [$blog->user, $blog]) }}" class="img imgBox">
        @if(isset($blog->blogImage[0]))
            <img src="{{ asset($blog->blogImage[0]->url) }}" alt="" style="object-fit: contain;">
        @else
            <img src="/img/mypage/img_notice01.png" alt="">
        @endif
    </a>
    <div class="infoTop">
        <div>
            <div class="breadcrumb">
                <a href="{{ route('blog.category.index', $blog->product->mProductChildCategory->mProductCategory->id) }}">
                    {{ $blog->product->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;
                <a href="{{ route('blog.category.index.show', $blog->product->mProductChildCategory->id)}}">
                    {{ $blog->product->mProductChildCategory->name }}</a>
            </div>
            <div class="draw">
                <p class="price word-break" style="width:100%"><font>{{ $blog->title }}</font>
            </div>
        </div>
        <div class="aboutUser">
            <div class="user" style="margin-bottom:6px;">
                @if(empty($blog->user->userProfile->icon))
                    <a href="{{ route('user.blog.show', [$blog->user, $blog]) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                @else
                    <a href="{{ route('user.blog.show', [$blog->user, $blog]) }}" class="ico"><img src="{{asset('/storage/'.$blog->user->userProfile->icon) }}" alt=""></a>
                @endif
                <div class="introd">
                    <p class="name word-break">{{ $blog->user->name }}</p>
                    <p>({{ App\Models\UserProfile::GENDER[$blog->user->userProfile->gender] }}/ {{ $blog->user->userProfile->age }}/ {{ $blog->user->userProfile->prefecture->name }})</p>
                </div>
            </div>

            <x-parts.evaluation-star :star='$blog->user->avg_star'/>

        </div>
    </div>
</div>