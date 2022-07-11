<x-support-layout>
    <article>
        <div id="contents" class="bg-white">
            <div class="supportWrap supportDetail detailStyle">
                <div class="inner inner04">
                    <div class="supportTop">
                        <div class="search">
                            <input type="text" placeholder="Search"><input type="submit" class="btn" value="">
                        </div>
                    </div>
                    <div class="title">
                        <h2 class="hdM">{{$news->title}}</h2>
                        <span class="">{{date('Y/m/d', strtotime($news->created_at))}}</span>
{{--                        TODO 必要であればデザイン修正--}}
                        <p class="sub pre-wrap">{{$news->content}}</p>
{{--                        <p class="hd01">禁止行為の一例</p>--}}
{{--                        <div class="example">--}}
{{--                            <p class="hd02">ダミーテキスト・ダミーテキスト・ダミーテキスト</p>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <p>ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                                    <p>ダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <p>ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                                    <p>ダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="example">--}}
{{--                            <p class="hd02">ダミーテキスト・ダミーテキスト・ダミーテキスト</p>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <p>ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                                    <p>ダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                    <div class="optional">
                        <p class="hdM">最新の質問</p>
                        <ul class="toggleWrapPC">
                            <li>
                                <p class="quest toggleBtn"><span>仕事にエントリーするには？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">仕事にエントリーするには仕事にエントリーするには仕事にエントリーするには仕事にエントリーするには仕事にエントリーするには仕事にエントリーするには</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>領収書の発行方法は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">領収書の発行方法は領収書の発行方法は領収書の発行方法は領収書の発行方法は領収書の発行方法は領収書の発行方法は領収書の発行方法は</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>本契約後の金額変更方法は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">本契約後の金額変更方法は本契約後の金額変更方法は本契約後の金額変更方法は本契約後の金額変更方法は本契約後の金額変更方法は</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>報酬の受け取り方は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">報酬の受け取り方は報酬の受け取り方は報酬の受け取り方は報酬の受け取り方は報酬の受け取り方は報酬の受け取り方は報酬の受け取り方は</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>決済方法は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">決済方法は決済方法は決済方法は決済方法は決済方法は決済方法は決済方法は決済方法は決済方法は決済方法は</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div><!-- /#contents -->
    </article>
</x-support-layout>
