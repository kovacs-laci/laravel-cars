<li class="row table-head">
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    <div class="col">#</div><div class="col">Megnevezés</div><div class="col center">Művelet</div>
    @if(auth()->check())
        <div>
            <a class="plus" href="{{ route($route) }}" title="Új"><i class="fa fa-plus"></i></a>
        </div>
    @endif
</li>
