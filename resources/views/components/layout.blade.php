<x-app>
    <body>
        <div id="wrapper">
            <x-header :keyword="$keyword ?? ''"/>
                {{$slot}}
            <x-footer/>
        </div>
    </body>
</x-app>