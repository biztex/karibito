<x-app>
    <body>
        <div id="wrapper" class="st2 bg02">
            @include('components.header')
            <x-parts.ban-msg/>

            {{$slot}}
            
            <x-footer/>
        </div><!-- /#wrapper -->
    </body>
</x-app>
