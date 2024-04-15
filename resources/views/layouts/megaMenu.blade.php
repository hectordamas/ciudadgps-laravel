<li class="dropdown dropdown-mega-menu">
    <a class="dropdown-toggle nav-link" href="{{ url('categorias') }}" data-toggle="dropdown">Nuestras Categorías</a>
    <div class="dropdown-menu" style="margin-top:-15px;">
        <ul class="mega-menu d-lg-flex">
            @php
                $catHeader = App\Models\Category::all();
                $sections = [0, 12, 24, 36];
            @endphp
            @for ($i = 0; $i < count($sections); $i++)
                @php
                    $section = $sections[$i];
                @endphp
                <li class="mega-menu-col col-lg-3">
                    <ul>
                        @foreach($catHeader->skip($section)->take(12) as $cat)
                            <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="{{ url('/comercios/slug-categorias/' . $cat->slug) }}">{{$cat->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endfor
        </ul>
    </div>
</li>