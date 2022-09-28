<x-layout>
    <x-parts.post-button/>
    <x-parts.flash-msg/>
    <article>
            <div id="breadcrumb">
                <div class="inner">

                    <a href="{{ route('home') }}">ホーム</a>　>　
                    @if($job_request->user_id === Auth::id())
                        <a href="{{ route('mypage') }}">マイページ</a>　>　
                        <a href="{{route('publication')}}">掲載内容一覧</a>　>　
                        <a href="{{(url()->current())}}">リクエストの詳細</a>
                    @else
                        <span>リクエストを探す</span>　>　
                        <a href="{{ route('job_request.category.index', $job_request->mProductChildCategory->mProductCategory->id)}}">@if(!is_null($job_request->category_id)){{$job_request->mProductChildCategory->mProductCategory->name}} @endif</a>　>　
                        <a href="{{ route('job_request.category.index.show', $job_request->category_id)}}">@if(!is_null($job_request->category_id)){{$job_request->mProductChildCategory->name}} @endif</a>　>　
                        <span>{{$job_request->title}}</span>
                    @endif
                </div>
            </div><!-- /.breadcrumb -->
            <div id="contents" class="detailStyle">
                    <div class="inner02">
                        <big>※ 契約時の内容が表示されています</big>
                        <div class="clearfix">

                            @include('purchased_job_request.parts.show.detail')

                            @include('purchased_job_request.parts.show.side')
    
                        </div>
    
                        {{-- @include('job_request.parts.show.share') --}}
    
                    </div><!--inner02-->
                </form>
            </div><!--contents-->
        </article>
    </x-layout>
    <script type="text/javascript">
        $(function(){
            $( "#datepicker" ).datepicker();
        });
    
        var _content = [];
        var moreload = {
            _default:5, // 初期化により5つのメッセージが表示されます
            _loading:3, // 一度にさらに3つのアイテムを表示する
            init:function(){
                var lis = $(".clientEvaluate .ftBox li");
                $(".clientEvaluate ul").html("");
                for(var n=0;n<moreload._default;n++){
                    lis.eq(n).appendTo(".clientEvaluate ul");
                }
                for(var i=moreload._default;i<lis.length;i++){
                    _content.push(lis.eq(i));
                }
                $(".clientEvaluate .ftBox").html("");
            },
            loadMore:function(){
                var mLis = $(".clientEvaluate li").length;
                for(var i =0;i<moreload._loading;i++){
                    var target = _content.shift();
                    if(!target){
                        $('.clientEvaluate .more').html("").addClass('load');
                        break;
                    }
                    $(".clientEvaluate ul").append(target);
                }
            }
        }
        moreload.init();
    
        // modal open sns share
        $(".specialtyBtn.share").on("click", function() {
            const $overlay = $(".overlayDetail");
            $overlay.css('display', 'block');
    
            $(".modal").removeClass('hidden');
    
            const windowHeight = $(window).height();
            const modalBoxHeight = $(".modal__box").innerHeight();
            const topPosition = ((windowHeight - modalBoxHeight) / 2) - 66;
            $(".modal__close").css('top', `${topPosition}px`);
        })
    
        const closeModal = function() {
            $(".modal").addClass('hidden');
            $(".overlayDetail").css('display', 'none');
        };
    
        $(".overlayDetail").on("click", function() {
            closeModal();
        })
    
        $(".modal__close").on('click', function() {
            closeModal();
        });
    
    </script>
    