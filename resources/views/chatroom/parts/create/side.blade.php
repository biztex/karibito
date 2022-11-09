<aside id="side">
    <div class="sideItem">
        <p class="sideHd">掲載内容</p>
        <div class="sideUl01">
            <div class="publicate">
                @if($service_type === 'Product')
                    <div class="cont">
                        @if(isset($service->productImage[0]))
                            <p class="img"><img src="{{ asset('/storage/'.$service->productImage[0]->path)}}" alt=""></p>
                        @else
                            <p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
                        @endif
                        <p class="txt">{{ $service->title }}</p>
                    </div>
                    <div class="amount">
                        <p>希望報酬額</p>
                        <p class="num">¥{{ number_format($service->price) }}</p>
                    </div>
                @else <!-- JobRequest -->
                    <div class="cont">
                        <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
                        <p class="txt">{{ $service->title }}</p>
                    </div>
                    <div class="amount">
                        <p>予算額</p>
                        <p class="num">¥{{ number_format($service->price) }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</aside><!-- /#side -->