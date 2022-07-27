<x-app>
    <body>
        <div id="wrapper">
            <x-header :keyword="$keyword ?? ''" :serviceflg="$serviceflg ?? ''"/>{{--ケバブにすると次で変数が受け取れない、--}}
                {{$slot}}
            <x-footer/>
        </div>
    </body>
</x-app>