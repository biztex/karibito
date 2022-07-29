<div class="recommendList style2">
    <h2 class="hdM">カテゴリ別ランキング</h2>
    @if (!isset($job_category_ranks))
        <h2>現在、カテゴリ別ランキングはありません。</h2>
    @else
        @foreach($job_category_ranks as $m_product_category)
            <div class="js-hide_job_request_categories @if ($loop->index >= 10) hide @endif"> {{-- div追加した（岩上）よくなかったら消します。 --}}
                <h3 class="cateTit"><span>{{ $m_product_category->name }}</span><a href="{{route('job_request.category.index', $m_product_category->id) }}" class="more">{{ $m_product_category->name }}から探す</a></h3>
                <div class="list sliderSP">
                {{ $count = 0 }}
                    @foreach($job_requests as $value)
                        @if($value->mProductChildCategory->mProductCategory->name === $m_product_category->name)
                            {{ $count++ }}
                            @if($count <= 10)
                                <x-parts.job-request-item :value='$value'/>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="otherBtn"><a href="javascript:;" class="js-jobRequestOtherBtn">その他カテゴリ別ランキングをみる</a></div>