<x-layout>
    <x-parts.post-button/>
    <article>
        <body id="portfolio">
            <div id="breadcrumb">
                <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('portfolio.index') }}">ポートフォリオ</a>　>　<span>{{ $portfolio->title }}</span>
                </div>
            </div><!-- /.breadcrumb -->
            <x-parts.flash-msg/>
            <article>
                <div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
                <div class="hide">
                    <div id="fancybox_register" class="fancyboxWrap">
                        <p class="fancyboxHd">身分証明証の登録</p>
                        <div class="fancyboxCont">
                            <div class="fancyRegisterItem">
                                <p class="txt">「身分証明書を登録する」とは、<br>信頼性を高めるため、本人であることを証明する書類を提出する手続きです。<br>身分証明書が承認されると、プロフィールに身分証明書提出済マークが表示されます。</p>
                            </div>
                            <div class="fancyRegisterItem">
                                <p class="notice">注意事項</p>
                                <p class="txt">カリビトアプリのプロフィールで、住所・氏名・生年月日はしっかり記載していますか?<br>身分証明書との一致が確認できないと本人確認はできないのでご注意ください!<br>登録いただいた３営業日以内にご返信します。</p>
                            </div>
                            <div class="fancyRegisterItem">
                                <p class="txt">提出可能な本人確認書類は、下記となっております。</p>
                                <p class="txt">【個人の場合】<br>運転免許証・健康保険証 / 被保険者証・旅券 / <br>パスポート・住民票・住民基本台帳カード・外国人証明書</p>
                                <p class="txt">【法人の場合】<br>履歴事項全部証明書　(※3 ヵ月以内のものに限ります)</p>
                            </div>
                            <div class="fancyRegisterItem">
                                <p class="txt">【カリビトアプリ登録情報】<br>都道府県:〇〇〇〇〇〇<br>住所:〇〇〇〇〇〇<br>氏名:〇〇〇〇〇〇<br>生年月日:〇〇〇〇〇〇</p>
                            </div>
                            <div class="fancyRegisterItem">
                                <p class="txt">安心安全のため、本人確認承認後はご住所 / 本名/ 生年月日のご変更ができなくなっておりますので、本人確認承認後にご住所 / 本名 / 生年月日をご変更されたい場合は、カリビト事務局へ、お問い合わせください</p>
                            </div>
                        </div>
                        <p class="fancyRegisterEdit"><a href="#fancybox_person" class="fancybox">プロフィール編集はこちら</a></p>
                        <p class="fancyRegisterUpload"><a href="#">身分証明書をアップロード</a></p>
                        <p class="fancyRegisterSubmit"><a href="#">提出する</a></p>
                    </div>
                    <div id="fancybox_person" class="fancyboxWrap">
                        <form>
                            <p class="fancyboxHd">プロフィールを編集</p>
                            <div class="fancyboxCont">
                                <div class="mypageCover">
                                    <a href="#"><img src="img/mypage/icon_camera01.svg" alt=""></a>
                                </div>
                                <div class="fancyPersonPic">
                                    <p class="img"><img src="img/mypage/pic_head.png" alt=""></p>
                                    <a href="#"><img src="img/mypage/icon_camera02.svg" alt=""></a>
                                </div>
                                <div class="fancyPersonTable">
                                    <dl class="">
                                        <dt>ニックネーム</dt>
                                        <dd><input type="text" name=""></dd>
                                    </dl>
                                    <dl class="">
                                        <dt>メールアドレス</dt>
                                        <dd><input type="text" name=""></dd>
                                    </dl>
                                    <dl class=" inlineFlex">
                                        <dt>姓<span>(本名は非公開です)</span></dt>
                                        <dd><input type="text" name=""></dd>
                                    </dl>
                                    <dl class=" inlineFlex">
                                        <dt>名<span>(本名は非公開です)</span></dt>
                                        <dd><input type="text" name=""></dd>
                                    </dl>
                                    <dl>
                                        <dt>性別</dt>
                                        <dd>
                                            <select>
                                                <option selected="" disabled="">選択してください</option>
                                                <option>男</option>
                                                <option>女</option>
                                            </select>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>生年月日<span>(年代のみ公開されます)</span></dt>
                                        <dd>
                                            <select class="year">
                                                <option selected="" disabled="">年</option>
                                                <option>2021</option>
                                                <option>2022</option>
                                            </select>
                                            <select class="month">
                                                <option selected="" disabled="">月</option>
                                                <option>12</option>
                                                <option>01</option>
                                            </select>
                                            <select class="day">
                                                <option selected="" disabled="">日</option>
                                                <option>18</option>
                                                <option>19</option>
                                            </select>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>住所<span>(都道府県のみ表示されます)</span></dt>
                                        <dd>
                                            <p class="addrNumber"><input class="short" type="text" name=""></p>
                                            <div class="addrSelect">
                                                <select class="short">
                                                    <option selected="" disabled="">選択してください</option>
                                                    <option>xx県</option>
                                                    <option>xx県</option>
                                                </select>
                                            </div>
                                            <p><input type="text" name="" placeholder="市区町村"></p>
                                        </dd>
                                    </dl>
                                    <div class="specialtyBox">
                                        <div class="specialtyItem">
                                            <div class="clone">
                                                <dl>
                                                    <dt>得意分野</dt>
                                                    <dd>
                                                        <select class="short">
                                                            <option selected="" disabled="">選択してください</option>
                                                            <option>家の掃除</option>
                                                            <option>料理代行</option>
                                                            <option>パソコン修理</option>
                                                            <option>高齢者のお世話</option>
                                                            <option>写真撮影代行</option>
                                                            <option>ロゴデザイン</option>
                                                        </select>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>得意分野詳細</dt>
                                                    <dd>
                                                        <input type="text" name="">
                                                    </dd>
                                                </dl>
                                            </div>
                                            <p class="specialtyBtn"><span><img src="img/mypage/icon_add.svg" alt="">得意分野を追加</span></p>
                                        </div>
                                    </div>
                                    <dl>
                                        <dt>自己紹介</dt>
                                        <dd><textarea></textarea></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="fancyPersonBtn">
                                <a href="#" class="fancyPersonCancel">キャンセル</a>
                                <a href="#" class="fancyPersonSign">登録する</a>
                            </div>
                        </form>
                    </div>
                    <div id="fancybox_resume" class="fancyboxWrap">
                        <form>
                            <p class="fancyboxHd">履歴書の作成</p>
                            <div class="fancyboxCont">
                                <div class="fancyPersonTable">
                                    <dl class=" inlineFlex">
                                        <dt>姓</dt>
                                        <dd><input type="text" name=""></dd>
                                    </dl>
                                    <dl class=" inlineFlex">
                                        <dt>名</dt>
                                        <dd><input type="text" name=""></dd>
                                    </dl>
                                    <dl class=" inlineFlex">
                                        <dt>セイ</dt>
                                        <dd><input type="text" name=""></dd>
                                    </dl>
                                    <dl class=" inlineFlex">
                                        <dt>メイ</dt>
                                        <dd><input type="text" name=""></dd>
                                    </dl>
                                    <dl>
                                        <dt>生年月日</dt>
                                        <dd>
                                            <select class="year">
                                                <option selected="" disabled="">年</option>
                                                <option>2021</option>
                                                <option>2022</option>
                                            </select>
                                            <select class="month">
                                                <option selected="" disabled="">月</option>
                                                <option>12</option>
                                                <option>01</option>
                                            </select>
                                            <select class="day">
                                                <option selected="" disabled="">日</option>
                                                <option>18</option>
                                                <option>19</option>
                                            </select>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>住所</dt>
                                        <dd>
                                            <p class="addrNumber"><input class="short" type="text" name=""></p>
                                            <div class="addrSelect">
                                                <select class="short">
                                                    <option selected="" disabled="">選択してください</option>
                                                    <option>xx県</option>
                                                    <option>xx県</option>
                                                </select>
                                            </div>
                                            <p><input type="text" name="" placeholder="市区町村"></p>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>電話番号</dt>
                                        <dd><input type="text" name="" placeholder=""></dd>
                                    </dl>
                                    <dl>
                                        <dt>メールアドレス</dt>
                                        <dd><input type="text" name="" placeholder=""></dd>
                                    </dl>
                                    <div class="specialtyBox">
                                        <div class="specialtyItem">
                                            <div class="clone">
                                                <dl>
                                                    <dt>学歴・経歴</dt>
                                                    <dd>
                                                        <p class="addrSelect"><input type="text" name="" placeholder=""></p>
                                                        <select class="short">
                                                            <option selected="" disabled="">年</option>
                                                            <option>2021</option>
                                                            <option>2022</option>
                                                        </select>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <p class="specialtyBtn"><span><img src="img/mypage/icon_add.svg" alt="">学歴・経歴を追加</span></p>
                                        </div>
                                        <div class="specialtyItem">
                                            <div class="clone">
                                                <dl>
                                                    <dt>免許・資格</dt>
                                                    <dd>
                                                        <p class="addrSelect"><input type="text" name="" placeholder=""></p>
                                                        <select class="short">
                                                            <option selected="" disabled="">年</option>
                                                            <option>2021</option>
                                                            <option>2022</option>
                                                        </select>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <p class="specialtyBtn"><span><img src="img/mypage/icon_add.svg" alt="">免許・資格</span></p>
                                        </div>
                                    </div>
                                    <dl>
                                        <dt>志望動機</dt>
                                        <dd><textarea></textarea></dd>
                                    </dl>
                                    <dl>
                                        <dt>趣味・特技・PRポイント</dt>
                                        <dd><textarea></textarea></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="fancyPersonBtn">
                                <a href="#" class="fancyPersonCancel">キャンセル</a>
                                <a href="#" class="fancyPersonSign">登録する</a>
                            </div>
                        </form>
                    </div>
                </div>
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
                                    <form action="{{ route('portfolio.update', $portfolio) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
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
                                                <p class="mypageEditHd">登録中の画像</p>
                                                <img src="{{ asset('/storage/'.$portfolio->path)}}" alt="" style="width: 25%;">
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
                                                                    <option value="{{$child_category->id}}"
                                                                        @if(( old('category_id', $request->category_id ?? "") == $child_category->id ) || ($portfolio->category_id == $child_category->id)) selected @endif>{{ $child_category->name }}</option>
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
                                                    <input type="text" name="title" placeholder="タイトルを入力してください" value="{{ old('title',$request->title ?? "") }}{{ $portfolio->title }}"required>
                                                </div>
                                            </div>
                                            <div class="mypageEditList">
                                                <p class="mypageEditHd">詳細</p>
                                                @error('detail')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                                <div class="mypageEditInput">
                                                    <textarea name="detail" placeholder="詳細を入力してください" required>{{ old('detail',$request->detail ?? "") }}{{ $portfolio->detail }}</textarea>
                                                </div>
                                            </div>
                                            <div class="mypageEditList">
                                                <p class="mypageEditHd">作成日</p>
                                                @error('year')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                                @error('month')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                                <div class="mypageEditDate">
                                                    <div class="mypageEditInput flexLine01">
                                                        <select name="year" required>
                                                            <option value="1970" selected>1970年</option>
                                                            @for($year = 1971; $year <= now()->year; $year++)
                                                                <option value="{{ $year }}" @if(( old('year',$request->year ?? "") == $year) || ($portfolio->year == $year)) selected @endif>{{ $year }}年</option>
                                                            @endfor
                                                        </select>
                                                        <select name="month" required>
                                                            <option value="1" selected>1月</option>
                                                            @for($month = 2; $month<= 12; $month++)
                                                                <option value="{{ $month }}"@if(( old('month', $request->month ?? "") == $month) || ($portfolio->month == $month)) selected @endif>{{ $month }}月</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fancyPersonBtn">
                                                <a href="{{ route('portfolio.index') }}" class="fancyPersonCancel">キャンセル</a>
                                                <button class="fancyPersonSign">変更する</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- /#main -->
                        <x-side-menu/>
                    </div>
                </div><!-- /#contents -->
            </article>
            <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="js/jquery.biggerlink.min.js"></script>
            <script type="text/javascript" src="js/slick.js"></script>
            <script type="text/javascript" src="js/jquery-ui.min.js"></script>
            <script type="text/javascript" src="js/jquery.ui.datepicker-ja.min.js"></script>
            <script type="text/javascript" src="js/jquery.fancybox.js"></script>
            <script type="text/javascript" src="js/common.js"></script>
            <script type="text/javascript">
            $(function(){

            });
            </script>
        </body>
        <x-hide-modal/>
    </article>
</x-layout>
