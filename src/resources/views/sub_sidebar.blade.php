<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="{{ $child->url }}"><i class="nav-icon la la-th-list ml-2"></i> {{ $child->nama }}</a>
    @foreach ($child->children as $child)
        <ul class="nav-dropdown-items">
            <li class="nav-item {{ ($child->url == Request::url()) ? 'active' : '' }}">
                @if($child->children->count())
                    @includeIf('dynamic_view::sub_sidebar')
                @else
                    <a class="nav-link" href="{{ $child->url }}"><i class="nav-icon la la-circle-o ml-4"></i> <span>{{ $child->nama }}</span></a>
                @endif
            </li>
        </ul>
    @endforeach
</li>