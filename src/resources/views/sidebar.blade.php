<?php
    $menu_items = Starmoozie\DynamicPermission\app\Models\Menu::getTree();
?>

@if ($menu_items && $menu_items->count())
    @foreach ($menu_items as $menu_item)
        @if ($menu_item->children->count())
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-list"></i> {{ $menu_item->nama }}</a>
                <ul class="nav-dropdown-items">
                    @foreach ($menu_item->children as $child)
                        <li class="nav-item {{ ($child->url == Request::url()) ? 'active' : '' }}">
                            @if ($child->children->count())
                                @include('dynamic_view::sub_sidebar_content')
                            @else
                            	<a class="nav-link" href="{{ starmoozie_url($child->url) }}"><i class="nav-icon fa fa-user"></i>
                            		<span>{{ $child->nama }}</span>
                            	</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li class="navitem {{ ($menu_item->url == Request::url()) ? ' active' : '' }}">
                <a class='nav-link' href="{{ starmoozie_url($menu_item->url) }}">
                	<i class="nav-icon la la-list"></i> {{ $menu_item->nama }}
                </a>
            </li>
        @endif
    @endforeach
@endif