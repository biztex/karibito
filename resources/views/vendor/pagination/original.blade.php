{{-- Pagination Elemnts --}}
    {{-- Array Of Links --}}
    {{-- 定数よりもページ数が多い時 --}}
    @if ($paginator->lastPage() > config('const.PAGINATE.LINK_NUM'))


        {{-- 現在ページが表示するリンクの中心位置よりも左の時 --}}
            @if ($paginator->currentPage() <= floor(config('const.PAGINATE.LINK_NUM') / 2))
                <?php $start_page = 1; //最初のページ ?> 
                <?php $end_page = config('const.PAGINATE.LINK_NUM'); ?>


        {{-- 現在ページが表示するリンクの中心位置よりも右の時 --}}
            @elseif ($paginator->currentPage() > $paginator->lastPage() - floor(config('const.PAGINATE.LINK_NUM') / 2))
                <?php $start_page = $paginator->lastPage() - (config('const.PAGINATE.LINK_NUM') - 1); ?>
                <?php $end_page = $paginator->lastPage(); ?>

        {{-- 現在ページが表示するリンクの中心位置の時 --}}
            @else
                <?php $start_page = $paginator->currentPage() - (floor((config('const.PAGINATE.LINK_NUM') % 2 == 0 ? config('const.PAGINATE.LINK_NUM') - 1 : config('const.PAGINATE.LINK_NUM'))  / 2)); ?>
                <?php $end_page = $paginator->currentPage() + floor(config('const.PAGINATE.LINK_NUM') / 2); ?>
            @endif


    {{-- 定数よりもページ数が少ない時 --}}
        @else
            <?php $start_page = 1; ?>
            <?php $end_page = $paginator->lastPage(); ?>
        @endif

        
    {{-- 処理部分 --}}
    @if ($paginator->hasPages())
        <div class="wp-pagenavi">
            {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                        <!--  -->
                    @else
                        <a class="nextpostslink" href="{{ $paginator->previousPageUrl() }}" rel="prev">前へ</a>
                @endif


            @for ($i = $start_page; $i <= $end_page; $i++)
                @if ($i == $paginator->currentPage())
                        <span class="current">{{ $i }}</span>
                    @else
                        <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                @endif
            @endfor
        
            {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a class="nextpostslink" href="{{ $paginator->nextPageUrl() }}" rel="next">次へ</a>
                @endif
        </div>
    @endif