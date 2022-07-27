<x-app>
    <body>
        <div id="wrapper">
            <x-header :keyword="$keyword ?? ''" :service_flg="$service_flg ?? ''"/> {{-- 2個渡せない --}}
                {{$slot}}
            <x-footer/>
        </div>
    </body>
</x-app>