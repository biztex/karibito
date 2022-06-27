# Tools の使い方 🛠

## Larastan

https://github.com/nunomaduro/larastan

### インストール

ローカル環境での導入手順を記述します。
（後ほどドキュメントも用意するつもりです）

Larastan をインストール

```
composer require --dev nunomaduro/larastan=1.0
```

### 実行

```
./vendor/bin/phpstan analyze --memory-limit=2G
```

### レベルの基準

https://phpstan.org/user-guide/rule-levels

## PHP-CS-Fixer

https://github.com/FriendsOfPHP/PHP-CS-Fixer

### インストール

ローカル環境での導入手順を記述します。
（後ほどドキュメントも用意するつもりです）

他のライブラリとの競合を避けるために `tools` ディレクトリを作成します。（既に作成済みならこの手順はスキップ）

```
mkdir tools
mkdir tools/php-cs-fixer
```

PHP-CS-Fixer をインストール

```
composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer=3.8
```

### 整形箇所をチェック

こちらでは整形箇所をハイライトするだけで実際には自動整形は走りません。

```
./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix -v --diff --dry-run
```

### 実行

こちらでは実際に自動整形を適用します。

```
./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix -v --diff
```

### 自動整形ルール

https://mlocati.github.io/php-cs-fixer-configurator/#version:3.8|configurator
