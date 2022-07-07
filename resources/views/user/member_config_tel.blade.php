<x-layout>
    <x-parts.post-button/>{{--投稿ボタンの読み込み--}}
        <article>
            <x-parts.flash-msg/>
            <div id="contents" class="otherPage">
                <div class="inner02 clearfix">
                    <div id="main">
                        <div class="configEditWrap">
                            <div class="configEditItem">
                                <h2 class="subPagesHd">電話番号の登録</h2>
                                <form method="POST" action="{{ route('tel.regist') }}">
                                    @csrf
                                    <div class="configEditBox">
                                        <dl class="configEditDl01">
                                            <dt>電話番号</dt>
                                            <dd>
                                                <div class="mypageEditInput">
                                                    @error('tel')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <input type="tel" name="tel" autocomplete="tel" required>
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
    <x-hide-modal/>
</x-layout>
