@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center my-5 py-5">
            <div class="col-md-8 mb-5">
                <div class="card">
                    <div class="card-body mb-5">
                        <h1 class="card-title justify-content-center mb-5">処理エラーが発生しました。
                        </h1>
                        <h4 class="card-text mb-5">
                            大変申し訳ありません。処理エラーが発生したため、ご希望の操作が行えません。数時間後に再度、お試しください。<br>

                        </h4>
                        <small>＊処理エラーが起こった場合、自動的に管理会社に通知されます。管理会社にて即時原因追求と対応を行います。エラー解消に３０分から数時間かかる場合がございます。お手数おかけします。</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection