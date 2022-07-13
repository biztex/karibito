<x-support-layout>
    <article>
        <div id="contents">
            <div class="mypageWrap supportWrap detailStyle">
                <div class="inner inner03">
                    <div class="supportTop">
                        <div class="search">
                            <input type="text" placeholder="Search"><input type="submit" class="btn" value="">
                        </div>
{{--                        <ul class="anchors">--}}
{{--                            <li class="biggerlink">--}}
{{--                                <p class="tit">FAQ</p>--}}
{{--                                <a href="#support01" class="scroll ico_support01"></a>--}}
{{--                                <p>よくあるご質問</p>--}}
{{--                            </li>--}}
{{--                            <li class="biggerlink">--}}
{{--                                <p class="tit">初めての方へ</p>--}}
{{--                                <a href="#support02" class="scroll ico_support02"></a>--}}
{{--                                <p>初心者ガイド</p>--}}
{{--                            </li>--}}
{{--                            <li class="biggerlink">--}}
{{--                                <p class="tit">お問い合わせ</p>--}}
{{--                                <a href="{{ route('contact') }}" class="ico_support03"></a>--}}
{{--                                <p>直接お問い合わせる</p>--}}
{{--                            </li>--}}
{{--                            <li class="biggerlink">--}}
{{--                                <p class="tit">運営会社</p>--}}
{{--                                <a href="{{ route('company') }}" class="ico_support04"></a>--}}
{{--                                <p>カリビトについて</p>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                    </div>

                    <div class="mypageSec02">
                        <h2 class="mypageHd02">カリビトからのお知らせ</h2>
                        <div class="box">
                            <ul class="mypageUl02">
                                @if(empty($news_list[0]))
                                    <div class="pl10">カリビトからのお知らせがありません。</div>
                                @else
                                    @foreach($news_list as $news)
                                    <li>
                                        <a href="{{route('news.show', $news->id)}}">
                                            <dl>
                                                <dt><img src="img/mypage/img_notice01.png" alt=""></dt>
                                                <dd>
                                                    <p class="txt">{{$news->title}}</p>
                                                    <p class="time">{{$news->created_at->diffForHumans()}}</p>
                                                </dd>
                                            </dl>
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                            {{ $news_list->links() }}
                        </div>
                    </div>

{{--                    <div class="optional" id="support01">--}}
{{--                        <p class="hdM">最新の質問</p>--}}
{{--                        <ul class="toggleWrapPC">--}}
{{--                            <li>--}}
{{--                                <p class="quest"><span>仕事にエントリーするには？</span><a href="{{ route('support_detail') }}" class="more">回答を見る</a></p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest"><span>領収書の発行方法は？</span><a href="{{ route('support_detail') }}" class="more">回答を見る</a></p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest"><span>本契約後の金額変更方法は？</span><a href="{{ route('support_detail') }}" class="more">回答を見る</a></p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest"><span>報酬の受け取り方は？</span><a href="{{ route('support_detail') }}" class="more">回答を見る</a></p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest"><span>決済方法は？</span><a href="{{ route('support_detail') }}" class="more">回答を見る</a></p>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="optional" id="support02">--}}
{{--                        <h2 class="mypageHd02"><span><img class="ico" src="img/support/ico_shield.svg">初めての方へ</span></h2>--}}
{{--                        <ul class="toggleWrapPC">--}}
{{--                            <li>--}}
{{--                                <p class="quest"><span>カリビトとは？</span><a href="{{ route('support_detail') }}" class="more">回答を見る</a></p>--}}
{{--                                <p class="answer toggleBox">カリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとは</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest"><span>新規会員登録（無料）するには？</span><a href="{{ route('support_detail') }}" class="more">回答を見る</a></p>--}}
{{--                                <p class="answer toggleBox">新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest"><span>プロフィール編集をするには？</span><a href="{{ route('support_detail') }}" class="more">回答を見る</a></p>--}}
{{--                                <p class="answer toggleBox">プロフィール編集をするにはプロフィール編集をするにはプロフィール編集をするにはプロフィール編集をするには</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest"><span>取引の流れは？</span><a href="{{ route('support_detail') }}" class="more">回答を見る</a></p>--}}
{{--                                <p class="answer toggleBox">取引の流れは取引の流れは取引の流れは取引の流れは取引の流れは取引の流れは</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest"><span>利用料はかかる？</span><a href="{{ route('support_detail') }}" class="more">回答を見る</a></p>--}}
{{--                                <p class="answer toggleBox">利用料はかかる利用料はかかる利用料はかかる利用料はかかる利用料はかかる利用料はかかる利用料はかかる</p>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="beginGuide">--}}
{{--                        <ul>--}}
{{--                            <li><a href="{{ route('guide') }}"><img src="img/support/img_guide01.svg" alt=""></a></li>--}}
{{--                            <li><a href="#"><img src="img/support/img_guide03.svg" alt=""></a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div><!-- /#contents -->
    </article>
</x-support-layout>
