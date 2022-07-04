<x-app>
    <body>
        <div id="wrapper">
            <x-header/>
                {{$slot}}
            <x-footer/>
        </div>
    </body>
</x-app>