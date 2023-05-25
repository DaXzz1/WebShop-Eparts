<a class="flex" href="{{route('cart.index')}}">
    <span class="text-white">Cart ({{session()->has('cart') ? count(session()->get('cart')) : 0}})</span>
</a>
