<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->

<div>
    <form method="post" action="{{ route($route) }}" accept-charset="UTF-8">
        @csrf
        <input type="search" name="needle" placeholder="Keresés"><button class="btn" type="submit"><i class="fa fa-search"></i></button>
    </form>
</div>
