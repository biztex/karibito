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
                                            <p class="mypageEditHd">動画(Youtubeのみ)</p>
                                            @error('youtube_link')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                            <div class="mypageEditInput">
                                                <input type="text" name="youtube_link" placeholder="動画のリンクを入力してください" value="{{ old('youtube_link',$request->youtube_link ?? "") }}">
                                            </div>
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