<x-layout>
    <body id="setting-page">
    <x-parts.post-button/>
        <article>
            <div id="breadcrumb">
                <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('setting.index') }}">会員情報</a>　>　<span>電話番号変更</span>
                </div>
            </div><!-- /.breadcrumb -->
            <x-parts.flash-msg/>
            <div id="contents" class="otherPage">
                <div class="inner02 clearfix">
                    <div id="main">
                        <div class="configEditWrap">
                            <div class="configEditItem">
                                <h2 class="subPagesHd">電話番号の登録</h2>
                                <form method="POST" action="{{ route('setting.tel.update') }}">
                                    @csrf
                                    <div class="configEditBox">
                                        @if (Auth::user()->tel)
                                            <dl class="configEditDl01 text-left">
                                                <dt>現在の電話番号：</dt>
                                                <dt>
                                                    <div class="align-bottom">{{ Auth::user()->tel }}</div>
                                                </dt>
                                            </dl>
                                        @endif
                                        <dl class="configEditDl01">
                                            <dt>電話番号</dt>
                                            <dd>
                                                <div class="mypageEditInput">
                                                    @error('tel')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <input type="tel" name="tel" autocomplete="tel" value="{{ old('tel') }}" required>
                                                    <p class="noticeP">※電話番号はハイフンなしで入力してください。</p>
                                                </div>
                                            </dd>
                                        </dl>
                                        <div class="configEditButton">
                                            <input type="submit" value="登録する">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /#main -->
                    <x-side-menu/>
                </div><!--inner-->
            </div><!-- /#contents -->
        </article>
</x-layout>
