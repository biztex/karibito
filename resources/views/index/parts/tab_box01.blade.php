<div class="tabBox is_active" id="tab_box01">
    <div class="clearfix">
        <div id="main">

            <!-- 初めての方へ -->
            @include('index.parts.tab_box.begin-guide')

            <!-- おすすめのカテゴリー -->
            @include('index.parts.tab_box.product-recommend-category')

            <!-- おすすめのお仕事 -->
            @include('index.parts.tab_box.product-recommend')

            <!-- カテゴリ別ランキング -->
            @include('index.parts.tab_box.product-category')


            <!-- カリビトからのお知らせ -->
            @include('index.parts.tab_box.news')

        </div>

        <!-- aside -->
        @include('index.parts.tab_box.side')

    </div>
</div>