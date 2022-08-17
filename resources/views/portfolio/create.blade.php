<x-layout>
    <x-parts.post-button/>
    <article>
        <body id="portfolio">

            <div id="breadcrumb">
                <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('portfolio.index') }}">ポートフォリオ</a>　>　<span>新規作成</span>
                </div>
            </div><!-- /.breadcrumb -->

            <x-parts.flash-msg/>

            <div id="contents" class="otherPage">
                <div class="inner02 clearfix">
                    <div id="main">
                        <div class="mypageWrap">
                            <div class="mypageSec05">
                                <p class="mypageHd02"><span>ポートフォリオ</span></p>
                            </div>
                        </div>
                        <div class="mypageWrap">
                            <div class="mypageSec05">
                                <form action="{{ route('portfolio.store') }}" method="post" idform enctype="multipart/form-data">
                                    @csrf
                                    <div class="mypageEditBox">
                                        <div class="mypageEditList">
                                            <p class="mypageEditHd">画像</p>
                                            @error('path')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            <div class="mypageEditInput">
                                                <input id='showSrc' type='text' />
                                                <input id="showButton" type='button' value=''  OnClick='javascript:$("#hiddenFile").click();'/>
                                                <input name="path" id='hiddenFile' type='file' accept="image/*" OnChange='ophiddenFile();' />
                                            </div>
                                        </div>
                                        <div class="mypageEditList">
                                            <p class="mypageEditHd">カテゴリ</p>
                                            @error('category_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            <div class="mypageEditInput">
                                                <select class="middle_ipt" name="category_id" required>
                                                    <option value="">選択してください</option>
                                                    @foreach (App\Models\MProductCategory::get() as $category)
                                                        <optgroup label="{{$category->name}}">
                                                            @foreach ($category->mProductChildCategory as $child_category)
                                                                <option value="{{$child_category->id}}" @if( old('category_id', $request->category_id ?? "") == $child_category->id ) selected @endif>{{ $child_category->name }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mypageEditList">
                                            <p class="mypageEditHd">タイトル</p>
                                            @error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            <div class="mypageEditInput">
                                                <input type="text" name="title" placeholder="タイトルを入力してください" value="{{ old('title',$request->title ?? "") }}" required>
                                            </div>
                                        </div>
                                        <div class="mypageEditList">
                                            <p class="mypageEditHd">詳細</p>
                                            @error('detail')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            <div class="mypageEditInput">
                                                <textarea name="detail" placeholder="詳細を入力してください" required>{{ old('detail',$request->detail ?? "") }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mypageEditList">
                                            <div class="formLinksArea">
                                                @if(old('youtube_link'))
                                                    @foreach(old('youtube_link') as $k => $v)
                                                        <div class="js-youtubeForm">
                                                            <p class="mypageEditHd js-link">動画(YouTubeのみ) {{$k + 1}}</p>
                                                            @error('youtube_link.'.$k)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                                            <div class="td">
                                                                <div class="mypageEditInput">
                                                                    <input type="text" name="youtube_link[]" placeholder="YouTubeのリンクを入力してください" value="{{$v}}">
                                                                </div>
                                                                <div>
                                                                    <a href="javascript:;" class="fs25 ml05 js-deleteYoutube">×</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="js-youtubeForm">
                                                        <p class="mypageEditHd js-link">動画(YouTubeのみ)</p>
                                                        @error('youtube_link.'.'0')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        <div class="td">
                                                            <div class="mypageEditInput">
                                                                <input type="text" name="youtube_link[]" placeholder="YouTubeのリンクを入力してください" value="{{ old('youtube_link',$request->youtube_link ?? "") }}">
                                                            </div>
                                                            <div>
                                                                <a href="javascript:;" class="fs25 ml05 js-deleteYoutube">×</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="specialtyBtn"><a href="javascript:;" onclick="addYoutube();"><img src="/img/mypage/icon_add.svg" alt="">動画を追加</a></p>
                                            <p class="small ml-2 mb-0">対応URL形式</p>
                                            <p class="small ml-2 mb-0">https://www.youtube.com/watch?v=xxxxxxxxxx</p>
                                            <p class="small ml-2 mb-0">https://youtube/xxxxxxxxxx</p>
                                        </div>
                                        <div class="mypageEditList">
                                            <p class="mypageEditHd">作成日</p>
                                            @error('year')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            @error('month')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            <div class="mypageEditDate">
                                                <div class="mypageEditInput flexLine01">
                                                    <select name="year" required>
                                                        <option value="{{ now()->year }}" selected>{{ now()->year }}年</option>
                                                        @for($year = 1970; $year <= now()->year - 1; $year++)
                                                            @if(now()->year == $year) @continue @endif
                                                            <option value="{{ $year }}" @if( old('year',$request->year ?? "") == $year) selected @endif>{{ $year }}年</option>
                                                        @endfor
                                                    </select>
                                                    <select name="month" required>
                                                        <option value="{{ now()->month }}" selected>{{ now()->month }}月</option>
                                                        @for($month =  1; $month<= 12; $month++)
                                                            @if(now()->month == $month) @continue @endif
                                                            <option value="{{ $month }}"@if( old('month', $request->month ?? "") == $month) selected @endif>{{ $month }}月</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fancyPersonBtn">
                                            <a href="{{ route('portfolio.index') }}" class="fancyPersonCancel">キャンセル</a>
                                            <button class="fancyPersonSign loading-disabled">登録する</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /#main -->
                    <x-side-menu/>
                </div>
            </div><!-- /#contents -->
        </body>
        <x-hide-modal/>
    </article>
</x-layout>
<script type="text/javascript">
    $(function(){
        delYoutube();
    })

    function addYoutube() {
        let str = '<div class="js-youtubeForm"><p class="mypageEditHd js-link">動画(YouTubeのみ)%NUM%</p><div class="td">@error('js-link.'.'%NUM%')<div class="alert alert-danger">{{ $message }}</div>@enderror<div class="mypageEditInput"> <input type="text" name="youtube_link[]" placeholder="YouTubeのリンクを入力してください"></div><div> <a href="javascript:;" class="fs25 ml05 js-deleteYoutube">×</a> </div></div></div>'
        let number_js_youtubeForm = $(".formLinksArea").children(".js-youtubeForm").length;

        if(number_js_youtubeForm < 10) {
            str = str.replace(/%\w+%/g, number_js_youtubeForm + 1);
            $('.formLinksArea').append(str);
        }
        delYoutube();
    }

    function delYoutube() {
        $('.js-deleteYoutube').click(function(){
            let number_js_youtubeForm = $(".formLinksArea").children(".js-youtubeForm").length;
            if (number_js_youtubeForm > 1 ) {
                $(this).parents('.js-youtubeForm').remove(); //divだけを消す
                $(".formLinksArea").children(".js-youtubeForm").each(function(index, element){
                    $(element).find(".js-link").text("動画(YouTubeのみ)" + (index + 1));
                })
            }
        });
    }
</script>
