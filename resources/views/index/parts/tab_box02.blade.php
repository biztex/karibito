<div class="tabBox" id="tab_box02">
    <div class="clearfix">
        <div id="main">
            
            <!-- 初めての方へ -->
            @include('index.parts.tab_box.begin-guide')

            <!-- おすすめのカテゴリー -->
            @include('index.parts.tab_box.recommend-category')

            <!-- おすすめのお仕事 -->
            @include('index.parts.tab_box.job-request-recommend')

            <!-- カテゴリ別ランキング -->
            @include('index.parts.tab_box.job-request-category')
            

            <!-- カリビトからのお知らせ -->
            @include('index.parts.tab_box.news')

        </div>
        
        <!-- aside -->
        @include('index.parts.tab_box.side')

    </div>
</div>