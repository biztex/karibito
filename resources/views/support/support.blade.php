<x-support-layout>
	<article>
		<div id="contents">
			<div class="mypageWrap supportWrap detailStyle">
				<div class="inner inner03">
					<div class="supportTop">
						<ul class="anchors">
							<li class="biggerlink">
								<p class="tit">FAQ</p>
								<a href="#support01" class="scroll ico_support01"></a>
								<p>よくあるご質問</p>
							</li>
							<li class="biggerlink">
								<p class="tit">カリビト攻略法</p>
								<a href="{{ route('guide') }}" class="ico_support02" rel="noopener noreferrer"></a>
								<p>初めての方へ</p>
							</li>
							<li class="biggerlink">
								<p class="tit">お問い合わせ</p>
								<a href="{{ route('contact') }}" class="ico_support03"></a>
								<p>直接問い合わせる</p>
							</li>
                            <li class="biggerlink">
                                <p class="tit">運営会社</p>
                                <a href="{{ route('company') }}" class="ico_support04" rel="noopener noreferrer"></a>
                                <p>カリビトについて</p>
                            </li>
							<li class="biggerlink">
								<p class="tit">カリビトガイド</p>
								<a href="{{ route('karibitoguide') }}" class="ico_support05" rel="noopener noreferrer"></a>
								<p>カリビトのご利用方法 </p>
							</li>
						</ul>
					</div>
					<div class="optional" id="support01">
						<h2 class="mypageHd02"><span><img class="ico" src="img/support/ico_quest_circle.svg">よくあるご質問（FAQ）</span></h2>
                        <p class="hdM">会員登録・情報変更</p>
                        <ul class="toggleWrapPC">
                            <li>
                                <p class="quest toggleBtn"><span>会員登録（無料）をするには？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">画面の【新規登録】をタッチしていただくと、登録画面に移動します。カリビトを利用するには会員登録が必要です。会員登録は無料です。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>プロフィールを編集するには？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">ログイン後、【マイページ】＞【プロフィールを編集】から編集できます。プロフィールが充実していると、購入率も上がります。あなたの人柄や経歴が伝わるプロフィールを作成しましょう。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>本人確認は必要ですか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">非対面のサービスに関しては本人確認をしなくても出品可能ですが、お取引の信頼性向上のために本人確認をしていただくことを推奨しております。対面のサービスや秘密保持契約（NDA)に関しては、本人確認が必須となります。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>本人確認が承認されません。</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">プロフィールの登録情報と、提出された本人確認資料の氏名、住所、生年月日が一致しているかご確認ください。情報が一致しない場合、申請をお受けできません。情報がはっきり確認できない、画像が加工されている、裏面に必要な記載があるのに裏面の画像が添付されていない、などの場合も申請は承認されませんのでご注意ください。申請から確認・承認までは、3～5営業日ほどお時間をいただきます。ご了承くださいませ。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>秘密保持契約（NDA)とは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">秘密保持契約（NDA)とは、チャット等非公開のやりとりで知り得た秘密情報を、目的以外の用途で使用したり、第三者に漏えいしないことを定めた契約書です。プロフィールに【秘密保持契約（NDA)締結可】マークを表示している方同士のチャット画面には【NDAを送付する】ボタンが表示され、フォーマットを活用して秘密保持契約（NDA)の締結ができます。安心安全なお取引のためにぜひご活用ください。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>【秘密保持契約（NDA)締結可】マークとは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    プロフィールに表示することで「必要に応じて秘密保持契約を結びます」という意思を伝えるためのマークです。このマークを表示している方同士のチャット画面には「NDAを送付する」ボタンが表示され、フォーマットを活用して秘密保持契約（NDA)を締結していただけます。このマークを表示することで双方の信頼感が高まり、依頼の増加や受注率のアップ、スムーズな交渉が期待できます。<br>
                                    ＊【秘密保持契約（NDA)締結可】マークの表示には本人確認が必須です。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>ログインができません。</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">恐れ入りますが、再度ログイン情報の入力をお願いします。<a href="{{route('login')}}" class="supportLink" target="_blank">ログインはこちらから</a><br><br>
                                    ＊メールアドレス・パスワードはすべて半角でご入力ください。<br><br>
                                    パスワードをお忘れや変更の場合は、再発行の手続きをお願いします。<br><br>
                                    <a href="{{route('password.request')}}" class="supportLink" target="_blank">パスワードの変更・再発行はこちらから</a>
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>パソコンのアドレスを会員登録していますが、お知らせ通知を携帯で受け取ることは出来ますか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">マイページ＞会員情報＞サブメールアドレスをご登録いただくと、お知らせ通知をサブメールアドレスからも受け取ることができます。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>未成年者も利用可能ですか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    未成年者もご利用いただけますが、会員登録・ご利用にあたっては、保護者など法定代理人の同意が必要となります。もし、未成年者が保護者の同意を得ずに当社サービスをご利用したことを確認した場合は、サービス利用停止、アカウントの取消しなどの措置を取らせていただく場合がございます。<br>
                                    また、15歳以下の方は会員登録ができませんので、ご了承くださいませ。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>退会するには？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    以下ページより退会できます。<br><br>
                                    <a href="{{route('withdraw')}}" class="supportLink" target="_blank">退会する</a><br>
                                    退会にあたっては、下記条件を必ずご確認ください。退会後は元のアカウントに戻すことはできませんのでご注意ください。<br><br>
                                    （退会条件）<br>
                                    ・購入者：購入したサービスの評価がすべて完了している。<br>
                                    ・出品者：購入されたサービスの納品が全て完了している。<br>
                                    <span style="visibility: hidden;">・出品者：</span>振込申請がすべて完了している。

                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>退会後、再登録するには？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">新たに【新規登録】画面からご登録をお願いします。退会したメールアドレスの使用は可能ですが、退会前の情報はリセットされます。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>お友達を紹介するには？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    <span style="display: flex">
                                        <span>１.</span><span>トップページまたはマイページの【お友達紹介】をタッチしてください。</span>
                                    </span><br>
                                    <span style="display: flex">
                                        <span>２.</span><span>表示された【招待コード】【招待コードURL】をコピーして、お友達に送ってください。</span>
                                    </span><br>
                                    <span style="display: flex">
                                        <span>３.</span><span>お友達が【招待コード】【招待コードURL】を使用して会員登録を行うと、認証完了後に紹介する方＆された方の両方に300円分のポイントが付与されます。</span>
                                    </span>
                                </p>
                            </li>
                        </ul>
                        <p class="hdM">出品サービスの利用</p>
                        <ul class="toggleWrapPC">
                            <li>
                                <p class="quest toggleBtn"><span>取引の流れは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    １.あなたの得意をサービスとして出品します。<br><br>
                                    ２.購入者の方から購入したい旨のチャットが届いたら、必要事項を確認し【サービスの提供】通知を送信します。<br><br>
                                    ３.サービスが購入されたら、サービスの提供を行います。<br><br>
                                    ４.提供したサービスが事前に確認した要件を満たしているかを購入者の方と確認したあと【納品完了】通知を送信します。<br><br>
                                    ５.【納品完了】通知に承認してもらい、【評価】を入力してもらいます。<br>
                                    その後、出品者の方も購入者の方の評価を入力した時点で取引完了となります。<br><br>
                                    ＊どちらかの評価が未入力の場合、取引完了とならず、 売上金も計上されませんのでご注意ください。<br><br>
                                    ６.銀行口座を登録し、振り込み申請をしたのち、売上金が支払われます。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>利用料金はかかりますか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">会員登録料、出品手数料などはかかりません。無料でご利用いただけます。出品したサービスの取引完了時に、販売手数料15％を差し引いて、報酬としてお支払いします。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>サービスを提供するには？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">トップ画面の【出品する・リクエストする】＞【サービスを出品する】から出品登録画面に移ります。必要事項を入力しましょう。サービスの魅力が伝わるよう、サービスの内容やアピールポイントは分かりやすく記載しましょう。また、納品にかかる時間やサービスを請負える範囲なども明確に記載することで、購入後のトラブル防止になります。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>本人確認必須のサービスとは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">出品するサービスのお仕事体系を「対面」または「どちらでも」を選択する場合は、原則として本人確認が必須となります。お互いのトラブル防止のため、本人確認をおこなってからの出品をお願いします。未登録のまま「対面」または「どちらでも」のサービスを出品されている場合、運営にて修正依頼や出品の取消し・利用制限などの措置を取る場合があります。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>サービス提供時に気を付けることは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    トラブルを防止し、安心安全なお取引を行うために出品時のマナーに気を付けましょう。<br>
                                    <a href="{{route('guide').'#etiquette02'}}" class="supportLink" target="_blank">出品時のマナーはこちら</a><br>
                                    また、契約前に作業を行うことは、トラブル防止のため禁止させていただきます。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>メッセージのやり取り方法は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    契約前の「納期・価格・イメージ」などをご相談される場合や、契約後の個人情報に関わるやりとりは、すべてカリビトチャットをご利用ください。こちらのやりとりは「購入者」と「出品者」の方のみが閲覧できる非公開のページです。安心・安全なお取引のため、メールやLINEなどカリビトチャット以外でのやりとりは禁止しておりますので、ご了承いただきますようお願い申し上げます。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>ポートフォリオ機能とは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    あなたの過去の画像や動画の作品を登録することで、購入者の方が閲覧できる機能です。実績や作品のイメージを伝えるのにとても有効な機能ですので、積極的に登録しましょう。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>カリビトブログとは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    カリビト内でブログを投稿できる機能です。出品サービスの紹介や実績紹介など、販促やブランディングにご活用いただけます。積極的に投稿しましょう。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>出品後、サービス内容を変更することは可能ですか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    出品後も、サービスページに記載された情報（サービス価格等）は上書き修正可能です。ただし、すでに契約が成立しているお取引に関しては、上書き修正前の内容で行っていただくようになります。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>【納品完了】通知とは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    事前に取り決めた要件をすべて満たしたサービスを提供する時に送る通知です。必ず購入者の方に確認をしてから通知しましょう。購入者の方が【納品完了】通知に承認後、双方が評価を入力した時点で取引完了となります。購入者の方から【リトライ】が届いた場合は、チャットにて修正点を確認し、再度【納品完了】を通知してください。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>【納品完了】通知に返信が来ません。</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    チャットにて再度【納品完了】通知を確認いただくようお伝えください。【承認】と【リトライ】のどちらも選択されないまま72時間が経過した場合は、自動的に【承認】となります。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>【納品完了】通知が承認されたのに評価が入力されません。</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    チャットにて再度【評価入力】をお願いしてください。【納品完了】通知が承認されてから未評価のまま<span>72時間</span>が経過した場合は、自動的に【普通】が入力されますので、購入者の方の評価入力を行ってください。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>リクエスト依頼に応募したい場合は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    リクエストページの【交渉に進む】からチャットに進み、依頼に応募したい旨をお伝えください。【サービスの提供】を通知し、依頼者の方が購入されると契約成立となります。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>売上金を受け取るには？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    取引完了後に売上金が計上されますので、マイページより振込申請を行ってください。振込申請期間は120日間です。期日内に申請をお願いします。振込先銀行口座は【マイページ ＞ 会員情報】よりご登録いただけます。万が一、振込申請期間を過ぎてしまった場合は、<a href="{{ route('contact') }}" class="supportLink" target="_blank">お問い合わせフォーム</a>から運営までご連絡をお願いします。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>土日祝日の売上金振込は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    売上金の振込日が土日祝の場合は、翌営業日中の着金となります。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>出品者情報と振込口座の名義が異なる場合は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    お客様の安心・安全なお取引きのため、原則としてご登録いただいた本人情報と異なる振込先口座のご登録はご遠慮いただいております。本人情報と振込先口座名義が一致しない場合、振込申請が却下されることがございますのでご承知おきくださいませ。<br>
                                    家族名義の口座など異なる口座をご利用されたい場合は、<a href="{{ route('contact') }}" class="supportLink" target="_blank">お問い合わせフォーム</a>から運営までご連絡をお願いします。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>売上金が振り込まれるタイミングは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    振込申請を１～10日に行った場合は当月20日中、11～20日に行った場合は当月末中、21～月末までに行った場合は翌月10日中に、ご登録の口座に振り込まれます。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>銀行振込手数料は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    振込手数料¥200はユーザーの皆様にご負担いただいております。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>トラブル防止のために気を付けることはありますか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    事前に購入者の方と「サービスの内容」「納期」「報酬」についてしっかりとすり合わせを行うことが重要です。サービス内容に関しては「要望を受ける範囲」だけでなく「受けれない範囲」も取り決めておくことで、後々のトラブル防止になります。<br><br>
                                    サービス内容によっては、簡易的でもあらかじめチャット内で取引契約書を交わしておくことも双方にとって有益です。<br><br>
                                    必要に応じて、チャット内の「秘密保持契約書」や「見積書」もご活用ください。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>出品中のサービスを休止するには？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    マイページ＞出品サービス＞出品サービスを編集する＞詳細＞編集で、サービス編集画面に移動します。【公開設定】を「非公開」にすると、第三者の方はサービスが閲覧できなくなります。ただし、その時点で契約が成立しているお取引を休止することはできません。
                                </p>
                            </li>
                        </ul>
                        <p class="hdM">購入サービスの利用</p>
                        <ul class="toggleWrapPC">
                            <li>
                                <p class="quest toggleBtn"><span>取引の流れは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    １.キーワード検索やカテゴリ一覧、ランキングを活用してお探しのサービスを探します。<br><br>
                                    <span style="display: flex">
                                        <span>２.</span><span>チャットで出品者の方に購入の意思を伝えて【サービスの提供】通知を送ってもらいます。届いた通知から購入・決済手続きに進みましょう。</span>
                                    </span><br>
                                    ３.チャットにて依頼の詳細を伝えます。<br><br>
                                    ４.出品者の方から【納品完了】通知が届いたら、【承認】後【評価入力】をします。<br><br>
                                    ５.出品者の方があなたの【評価入力】をした時点で取引完了です。<br><br>
                                    ＊カリビトは双方の【評価入力】をもって取引完了となります。評価を入力し忘れることのないようご注意ください。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>利用料金はかかりますか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">会員登録やサービスの検索・購入、またサービスのリクエストに関して利用料金はかかりません。無料でお使いいただけます。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>お気に入り機能とは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">気になるサービスを【お気に入り】に登録することで、後から一覧で見返すことのできる機能です。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>探しているサービスがない場合は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">リクエスト機能を使って、お困りごとやお願いしたいことを解決してくれる人を募集できます。リクエストは、トップ画面の【出品する・リクエストする】＞【サービスをリクエストする】から登録できます。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>サービスを購入するにはどうしたらいいですか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">サービス詳細画面の【交渉画面に進む】をタッチし、チャットで購入の意思をお伝えください。事前確認がまとまりましたら【サービスの提供】通知を送ってもらい、決済を行います。送信するメッセージ内容は、チャット内に定型文がございますのでご活用ください。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>購入に至らなかったやりとりは削除できますか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">購入に至らなかったやりとりは【ゴミ箱】に入れると【進行中の取引】に表示されなくなります。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>サービス購入時に気を付けることは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    トラブルを防止し、安心安全なお取引を行うために購入時のマナーに気を付けましょう。<br>
                                    <a href="{{route('guide').'#etiquette01'}}" class="supportLink" target="_blank">購入時のマナーはこちら</a>
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>メッセージのやり取り方法は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">契約前の「納期・価格・イメージ」などをご相談される場合や、契約後の個人情報に関わるやりとりは、すべてカリビトチャットをご利用ください。こちらのやりとりは「購入者」と「出品者」の方のみが閲覧できる非公開のページです。安心・安全なお取引のため、メールやLINEなどカリビトチャット以外でのやりとりは禁止しておりますので、ご了承いただきますようお願い申し上げます。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>カリビトチャット中に出品者から連絡が来なくなったのですが。</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    再度メッセージを送信し、状況の確認をお願いします。出品者の方からの返信が<span>72時間</span>以上ない場合は、必ず理由を明記の上【キャンセル申請】を送ってください。<br>
                                    　【キャンセル申請】通知後<span>72時間</span>以内に出品者の方から返信がなければ、自動的に【キャンセル申請】は承認されます。詳しいキャンセルのやり方については、<a href="{{route('karibitoguide')}}" class="supportLink" target="_blank">カリビトガイド＞キャンセル申請を送る時のプロセス</a>をご確認ください。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>【納品完了】通知が届いたら？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    【納品完了】通知とは、出品者の方が事前に取り決めた内容をすべて満たしたサービスを提供する際に送る通知です。サービスに問題がなければ【承認】を選択し【評価入力】に進んでください。修正箇所があれば【リトライ】を選択し、修正箇所を伝えてください。<br>
                                    <span style="display: flex">
                                        <span>＊</span><span>【納品完了】通知が届いてから72時間以内に【承認】と【リトライ】のどちらも選択しなかった場合、自動的に【承認】となりますのでご注意ください。</span>
                                    </span><br>
                                    ＊【リトライ】が選択できるのは1回限りとなります。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>評価入力は必須ですか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    評価入力は必須です。取引は双方の評価入力をもって完了となります。購入者の方が評価入力を行わないと出品者の方は評価入力に進めませんので、必ずご入力ください。<br>
                                    ＊【納品完了】通知に承認後、<span>72時間</span>以内に【評価入力】が行われない場合、自動的に【普通】が入力されます。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>お支払方法は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    クレジットカードでのお支払いとなります。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>割引クーポンの利用方法は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    決済画面で【クーポンを利用する】にチェックを入れ、利用可能なクーポンを選択してください。決済完了後にクーポンを使用することはできませんので、「お支払い確認」画面でクーポンが適用されているか必ずご確認ください。<br><br>
                                    ＊１度の決済で利用できるクーポンは１枚のみです。<br>
                                    ＊クーポンとポイントの併用はできません。<br>
                                    ＊お持ちのクーポンの条件詳細や有効期限は、「マイページ ＞ クーポン」からご確認いただけます。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>ポイントでの支払い方法は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    決済画面の【ポイント利用】の【利用する】にチェックを入れ、利用ポイント額を入力してください。ポイント利用額の上限は、購入金額の10％となります。決済完了後にポイントを使用することはできませんので、「お支払い確認」画面でポイントが適用されているか必ずご確認ください。<br><br>
                                    ＊ポイントとクーポンの併用はできません。<br>
                                    <span style="display: flex">
                                        <span>＊</span><span>お持ちのポイントの詳細は、「マイページ ＞ ポイント取得・利用履歴」からご確認いただけます。</span>
                                    </span>
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>ポイントの有効期限は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    有効期限は設けておりません。今後、仕様が変更になった場合は、随時ご案内を通知いたします。
                                </p>
                            </li>
                        </ul>
                        <p class="hdM">キャンセル・返金</p>
                        <ul class="toggleWrapPC">
                            <li>
                                <p class="quest toggleBtn"><span>契約成立前（決済前）のキャンセルは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">交渉中であっても、契約成立前は基本的にいつでもキャンセルしていただけます。双方が気持ちよくキャンセルできるよう、理由を明記した丁寧なメッセージを送りましょう。契約に至らなかったやりとりは【ゴミ箱】に入れると【進行中のやりとり】に表示されなくなります。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>契約成立後（決済後）のキャンセルは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    契約成立後にやむを得ない事情でキャンセルされる場合は、必ず理由を明記の上【キャンセル申請】を送ってください。相手の方が【承認する】を選択し、双方の評価入力が完了した時点でキャンセル成立となります。キャンセル成立後、手続きが完了しましたら、サービス手数料を含む代金が購入者の方に返金されます。<br><br>
                                    キャンセルは、原則として双方の合意が必要です。キャンセル理由に同意できない場合は【再交渉する】を選択し、再度すり合わせを行ってください。<br><br>
                                    通知された【キャンセル申請】に返答がないまま<span>72時間</span>が経過した場合は、自動的に【承認する】が選択されます。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>キャンセル時の評価入力は必須ですか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">キャンセルは双方の評価入力が完了した時点で成立となりますので、必ず行ってください。評価はキャンセルされた側、キャンセルした側の順で行います。双方とも、評価入力の通知が届いてから未評価のまま<span>72時間</span>が経過した場合は、自動的に「普通」が選択されます。</p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>キャンセル手数料は？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    原則としてキャンセル手数料はかかりません。契約成立後にキャンセルになった場合は、手続き完了後、購入者の方にサービス手数料を含めた代金を決済方法に応じて返金いたします。<br><br>
                                    なお、口座等の個人情報を直接やり取りすることや、直接の金銭のやり取りは禁止行為にあたります。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>キャンセルしたサービスに利用したポイントはどうなりますか？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">購入時に利用したポイントは、キャンセル手続き完了後に自動的に返還されます。</p>
                            </li>
                        </ul>
                        <p class="hdM">ルール・禁止行為</p>
                        <ul class="toggleWrapPC">
                            <li>
                                <p class="quest toggleBtn"><span>禁止行為とは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    購入者と出品者の双方がカリビトを安心・安全にご利用いただくために、以下の行為を禁止しております。<br><br>
                                    ・複数のアカウントを登録・使用する行為<br><br>
                                    ・カリビトを通さず直接の取引を促す行為、それに応じる行為<br><br>
                                    ・カリビトで定められた方法以外での決済を促す行為、それに応じる行為<br><br>
                                    ・カリビトを利用中に外部サービスに誘導する行為、それに応じる行為<br><br>
                                    ・契約成立後、キャンセルが成立していない状態で、一方的に契約を破棄する行為<br><br>
                                    ・カリビトの取引で取得した第三者の個人情報や契約内容を、取引の履行以外の目的で利用したり、第三者に提供する行為<br><br>
                                    ・誹謗中傷やわいせつな投稿等、他人に不快感を与えたり、他人に不利益・損害を与える行為<br><br>
                                    ・公序良俗に反する行為<br><br>
                                    ・その他、運営が重大な規約違反と判断する行為<br><br>
                                    運営にて規約違反と判断する行為を確認した場合は、出品やお取引の取り消し、場合によってはアカウントの停止、強制退会などの措置を取らせていただきます。<br>
                                    また、このような行為を見かけられたり、持ち掛けられた場合は、すぐに「お問合せ」より運営までご連絡いただけますようお願い申し上げます。<br><br>
                                    上記詳細は利用規約よりご確認ください。
                                </p>
                            </li>
                            <li>
                                <p class="quest toggleBtn"><span>出品禁止サービスとは？</span><span class="more">回答を見る</span></p>
                                <p class="answer toggleBox">
                                    カリビトでは、安心・安全にサービスをご利用いただくために、原則として以下のサービスは出品できません。<br><br>
                                    ・本人確認を行っていない対面のサービス<br><br>
                                    ・資格の所持を記載しない状態での資格を要するサービス<br><br>
                                    ・カリビト外での取引を促しているサービス<br><br>
                                    ・公序良俗に反するサービス<br><br>
                                    ・知的財産権、著作権等を侵害するサービス<br><br>
                                    ・金融商品取引法に違反する恐れのあるサービス<br><br>
                                    ・その他法律、法令、条例に違反する、または違反する恐れのあるサービス<br><br>
                                    ・返金保証を行うと判断されるサービス<br><br>
                                    ・無期限でのサポートやサービスの提供を行うと判断されるサービス<br><br>
                                    ・第三者の出品を代行して行うサービス<br><br>
                                    ・利用者に誤解を生じさせる虚偽の記載がされたサービス<br><br>
                                    ・その他、カリビトの利用規約に違反するサービスや運営が不適当と判断するサービス<br><br>
                                    運営にて不適切と判断したサービスは、予告または通知を行うことなく掲載を削除することがございます。<br><br>
                                    また、このようなサービスを見かけられた場合は、すぐに「お問合せ」より運営までご連絡いただけますようお願い申し上げます。<br><br>
                                    上記詳細は利用規約よりご確認ください。
                                </p>
                            </li>
                        </ul>
{{--						<p class="hdM">お問い合わせの多い質問</p>--}}
{{--                        <ul class="toggleWrapPC">--}}
{{--                            <li>--}}
{{--                                <p class="quest toggleBtn"><span>仕事にエントリーするには？</span><span class="more">回答を見る</span></p>--}}
{{--                                <p class="answer toggleBox">ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest toggleBtn"><span>領収書の発行方法は？</span><span class="more">回答を見る</span></p>--}}
{{--                                <p class="answer toggleBox">ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest toggleBtn"><span>本契約後の金額変更方法は？</span><span class="more">回答を見る</span></p>--}}
{{--                                <p class="answer toggleBox">ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest toggleBtn"><span>報酬の受け取り方は？</span><span class="more">回答を見る</span></p>--}}
{{--                                <p class="answer toggleBox">ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest toggleBtn"><span>決済方法は？</span><span class="more">回答を見る</span></p>--}}
{{--                                <p class="answer toggleBox">ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--						<p class="hdM">最新の質問</p>--}}
{{--                        <ul class="toggleWrapPC">--}}
{{--                            <li>--}}
{{--                                <p class="quest toggleBtn"><span>仕事にエントリーするには？</span><span class="more">回答を見る</span></p>--}}
{{--                                <p class="answer toggleBox">ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest toggleBtn"><span>領収書の発行方法は？</span><span class="more">回答を見る</span></p>--}}
{{--                                <p class="answer toggleBox">ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest toggleBtn"><span>本契約後の金額変更方法は？</span><span class="more">回答を見る</span></p>--}}
{{--                                <p class="answer toggleBox">ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest toggleBtn"><span>報酬の受け取り方は？</span><span class="more">回答を見る</span></p>--}}
{{--                                <p class="answer toggleBox">ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="quest toggleBtn"><span>決済方法は？</span><span class="more">回答を見る</span></p>--}}
{{--                                <p class="answer toggleBox">ダミーテキストダミーテキストダミーテキストダミーテキスト</p>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
					</div>
{{--					<div class="optional" id="support02">--}}
{{--						<h2 class="mypageHd02"><span><img class="ico" src="img/support/ico_shield.svg">初めての方へ</span></h2>--}}
{{--						<ul class="toggleWrapPC">--}}
{{--							<li>--}}
{{--								<p class="quest toggleBtn"><span>カリビトとは？</span><span class="more">回答を見る</span></p>--}}
{{--								<p class="answer toggleBox">カリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとはカリビトとは</p>--}}
{{--							</li>--}}
{{--							<li>--}}
{{--								<p class="quest toggleBtn"><span>新規会員登録（無料）するには？</span><span class="more">回答を見る</span></p>--}}
{{--								<p class="answer toggleBox">新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには新規会員登録（無料）するには</p>--}}
{{--							</li>--}}
{{--							<li>--}}
{{--								<p class="quest toggleBtn"><span>プロフィール編集をするには？</span><span class="more">回答を見る</span></p>--}}
{{--								<p class="answer toggleBox">プロフィール編集をするにはプロフィール編集をするにはプロフィール編集をするにはプロフィール編集をするには</p>--}}
{{--							</li>--}}
{{--							<li>--}}
{{--								<p class="quest toggleBtn"><span>取引の流れは？</span><span class="more">回答を見る</span></p>--}}
{{--								<p class="answer toggleBox">取引の流れは取引の流れは取引の流れは取引の流れは取引の流れは取引の流れは</p>--}}
{{--							</li>--}}
{{--							<li>--}}
{{--								<p class="quest toggleBtn"><span>利用料はかかる？</span><span class="more">回答を見る</span></p>--}}
{{--								<p class="answer toggleBox">利用料はかかる利用料はかかる利用料はかかる利用料はかかる利用料はかかる利用料はかかる利用料はかかる</p>--}}
{{--							</li>--}}
{{--						</ul>--}}
{{--					</div>--}}
					<div class="beginGuide">
						<ul>
							<li><a href="{{ route('guide') }}"><img src="img/support/img_guide01.svg" alt=""></a></li>
							<li><a href="#"><img src="img/support/img_guide03.svg" alt=""></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
	</article>
</x-support-layout>
