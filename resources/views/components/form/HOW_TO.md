#components.formについて

定形のフォームの部品(inputとかselectとか)があります。  
Bladeで@include()してください。

###【使い方】

テキストボックスの例
> @include('components.form.text', ['name' => 'area_name', 'required' => true])

セレクトボックスの例
> @include('components.form.select_k_v', ['name' => 'plan', 'data' => ['0'=>'無料', '1'=>'有料'])

k_vとはdataが連想配列の場合有効で、キーがoptionのvalue、値が表示文字列になります。  
k_vがないもの(components.form.select)はoptionのvalueと表示文字列がともに配列の値が入ります。

collectionではモデルから取得したコレクションをdataに渡せます。  
セレクトボックスの例
> @include('components.form.select_collection', ['name' => 'prefecture_id', 'data' => $prefectures, 'id' => 'id', 'str' => 'name', value='value'])

$idと$strにはテーブルのカラム名を指定してください。  
($idがoptionのvalue、$strが表示文字列になります)
$valueに数値(ex: 1, 2, 5, 10 など)を指定すると、$value番目のアイテムを選択します。
$valueを指定しない場合は1つ目のアイテムを選択します。

edit_は編集ページ用です。


##Live Templateのインポート(PHPStormのみ)

Blade.xml(またはsettings.zip)を設定するとincludeを自動生成できます。  
例

①@include()と入力  
②()内で「form_error」と入力してTabキーを押すとコードが自動生成される。  
@include('components.form.error', ['name' => ''])

####設定方法

①MacOSなら下記のフォルダにBlade.xmlを置く  
/Users/{ユーザー名}/Library/Application Support/JetBrains/PhpStorm2020.2(バージョンによって変わる)/templates  
②PHPStormを起動(または再起動)させる

※通常のLive Templateのインポートも可能だが、ユーザーがカスタマイズした設定がすべて上書きされてしまうためこのようなインポート方法とした。  
(xmlファイルをいじれば既存ファイルへのマージも可能)

初期設定のままなら公式ドキュメント通りのインポートでもOK！  
(File > Manage IDE Settings > Import Settingsからsetting.zipをインポートする)

####インポートして変になったら

キャッシュクリアする

File > Invalidate Caches/Restart


####Live Templateの編集・追加

ライブテンプレートの設定  
PHPStorm > Preferences > Editor > Live Templatesから設定  

####Live Templateのエクスポート

File > Manage IDE Settings > Export Settingsでzipファイルを生成  
(Live Templates (schemes)のみにチェック)