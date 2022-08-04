@if($star === null)
    <div class="evaluate"></div>
@elseif($star > 4)
    <div class="evaluate five"></div>
@elseif($star > 3)
    <div class="evaluate four"></div>
@elseif($star > 2)
    <div class="evaluate three"></div>
@elseif($star > 1)
    <div class="evaluate two"></div>
@else
    <div class="evaluate one"></div>
@endif