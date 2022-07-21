# コーディング規約 📝

## 全体の基本規約

- 定数の配列定義時、定数は複数形にする
- ファサードはuseではなく\Authなど「\」をつけて使う
- データベースアクセス時はEloquentを使用（原則SQLは書かない）

## 命名規則
- クラス名  アッパーキャメル（UserProfile）
- 関数名    ローワーキャメル（createProfile）動詞を前にする
- 変数名    スネーク（$user_id）

## コントローラー
- ウェブに関してはWebディレクトリに入れるようにする(今後スマホアプリ化する可能性もあるため。アプリ時はApiディレクトリを作成する)。
- redirectの書き方
  1. routeを使ってnameを指定する
  1. return redirect()->route('user_profile.create');


## JavaScriptに関して

- JSはjQueryで記述
- 複数インスタンス構成（使用するbladeでnewする）（例えばheader.bladeにheader用インスタンスがあったりする）
- コンポーネント作成は/resources/js/components/コンポーネント名.vueで作成（resources/js/app.jsに登録してビルドnpm run dev）
- v-modelを使う場合は各フォームパーツにv-modelを追加してください（textarea.blade.php参考）

## ファットコントローラー回避のための策

- クリーンアーキテクチャやデザインパターンの導入はせず、一般的なMVC+Serviceで実装する
- controllerとmodelの間にserviceを作り、そこにビジネスロジックを実装
- serviceクラス作成規則はmodel名+Service.php（ディレクトリはapp\Services\）
- serviceクラスはモデルの数以上できることはない（最大モデルファイル数となる）
- 共通処理はtraitへの実装もあり（呼び出し元はserviceかmodelとなる）
- 汎用的な処理の置き場はLibraryフォルダにクラスを作る（helpers.phpへの実装もあり）

## Migrationについて

- 仕様が不明確なため、開発中盤まではテーブル変更時migrationファイル直上書きで更新（直書き換えじゃなくなるタイミングでアナウンスします）
- カラム追加時、カラムの追加位置は最後ではなく、->after()を使って適切な位置に追加する


## Modelについて

- fillableとguardedについて
  1. guardedに空の配列を定義(基本idは定義すること)
  1. $request->all()を使用した複数代入は使用禁止とし、FormRequestに定義したsubstitutableメソッド(onlyメソッドで複数代入する値を指定)を使用し複数代入する
- そのテーブルの仕様はModelクラスのファイルにコメントで記載（別途ドキュメント作成を省くため）
- アクセサは以下の規約通りのみ使用可能（カラムなのかアクセサなのか分かりづらいので、メソッドで実装すればよい）
  - カラムの情報を加工して表示したいときにdisp_プレフィックスをつけて実装（姓・名を結合するようなのはメソッドで）
- _atのdatetime型カラムはCarbonにキャストする（Modelの$datesプロパティに記載）
- 各定数は適切なモデルに記載
- リレーション定義のメソッド名は基本モデル名と一緒にする（ただし、hasManyの場合は複数形にする。それ以外にも必要な場合は崩しても良い）

## FormRequestについて

- バリデーションはFormRequestクラス使用
- FormRequestクラス名の命名規則は、コントローラークラス名ディレクトリ配下にメソッド名＋Requestで作成
  - 例）App\Http\Requests\HogeController\StoreRequest.php
- 「Modelについて」にも記載の通り、そのアクションで複数代入する値をsubstitutableメソッドにonlyで定義する
- バリデーションルールは「|」区切りで記述
- バリデーションのカスタムメッセージや項目名の日本語化はlang/ja/validation.phpに記述（カラム名が被る場合はFormRequestクラスのメソッドに記載）
- laravelで用意されているルールでカバーできないバリデーションルールはRuleクラスに記述
- バリデーションの実装はrequired,nullable,string,integer,date,image,max:などの必須・型・MAXサイズのチェックを行う（＋各項目ごとに必要なバリデーションを実装）
- text型カラムのmaxは基本3000文字とする
- 画像は基本jpg,png指定
```
// 入力例
return [
          'name' => 'required | max:128',
          'first_name' => 'required | max:128',
          'last_name' => 'required | max:128',
          'gender' => 'required',
          'prefecture' => 'required',
          'zip' => 'required | numeric | digits:7',
          'address' => 'required | max:128',
          'introduction' => 'max:2000',
          'icon' => 'max:1024',
          'cover' => 'max:1024'
      ];
```

## ルーティングについて
 - 認証に関するルートはauth.phpに記述

ルート記述方法はLaravel9で名前空間を使用する

```
use App\Http\Controllers\HomeController;
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::resource('hoges', HogeController::class);
```

同じ名前のコントローラーがある場合はエイリアス使用

```
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\User\PostController as UserPostController;

Route::get('admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
Route::get('user/posts', [UserPostController::class, 'index'])->name('user.posts.index');
```

単語ごとに.でつなぐ(user.create)

## 通知について

- 通知はlaravelのNotification機能を使用
- キューイングし非同期にする（送信に時間がかかるので）
- メール通知はNotificationクラスのtoMailメソッドにてmailableを返す
- notificationとmailableは同じクラス名
- 各チャンネルの送信判定はnotificationクラスのviaメソッドに記述

## Mailableクラスについて

- authのフォルダを作成する（userに送信するメールの場合app/Mail/User/クラス名となる）
- キューイングし非同期にする（送信に時間がかかるので）
- Notificationで使用する場合Notificationクラスと同じクラス名にする
- メール本文は/resources/views/mail/text/{user or client or admin or　なし}に作成
- メール本文ファイル命名規則：mailableクラス名をスネークケースに変換した名前

## イベントについて
- notificationやmailのみであればeventは使わず、それ以外のイベントも発生する場合はイベントにまとめる

## 認可とミドルウェアについて

- 認可やミドルウェアはルートファイルに記述（リソースルートを使用する場合はコントローラーの__constructに記載OK）
- ミドルウェア命名規則
  - 通過できる条件をクラス名にする（「終了済みでない」という条件なら「not.finished」のような感じ）
  - ミドルウェア名登録はミドルウェアクラス名をカンマ区切りにしたもの
- 「認可」処理はGateに記述

<!-- ## viewについて
 - ディレクトリーの命名規則 -->

### bladeテンプレートについて

- bladeファイル命名規則
  - 基本的にフォルダ名は複数形で統一（複数単語はスネークケース）
- bladeには分岐や繰り返し処理以外のロジックは書かない
- bladeの行数が多く見通しが悪い時はパーツに切り出してincludeやcomponentを使用
- パーツはcomponents/partsフォルダに全部入れる（フォルダ分けは規則を作るのがめんどくさそうなため）
- includeとcomponentの使い分けはslotを使用するかどうか
- 同じレイアウトを使用するときは、bladeコンポーネント化してください（例えば管理画面の一覧表示系など）
- モーダルはレイアウトで記述してあるmodal_areaにsectionで置く（bootstrapがbody直下に置けと言っている）
- 管理画面はデザインなし、bootstrapでコーディングします

### DB命名規則について

- マスタテーブルにはm_プレフィックスをつける（外部キーカラムも）(例m_prefectures)
- datetime型のカラム名のサフィックスには_at
- date型のカラム名のサフィックスには_on

