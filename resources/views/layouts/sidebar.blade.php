<div class="sidebar">
    <nav id="sidebarmenu" class="sidebar-nav">
        <ul class="nav">
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('form-index') }}">दर्ता किताब</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('chalani-index') }}">चलानी किताब</a>
            </li> --}}
            <?php
            $helper_returns = \App\Helpers\MenuHelper::allMenu();
            $allpermissions = $helper_returns->get();
            $permissions = $allpermissions->where('parent_id', 0);
            ?>
            @foreach($permissions as $permission)

                <li class="nav-item @if(count($permission->childPs) > 0 and substr($permission->menu_name, 0, 1) == "#") nav-dropdown @endif">
                    <a class="nav-link @if(count($permission->childPs) > 0 and substr($permission->menu_name, 0, 1) == "#") nav-dropdown-toggle @endif"
                       href="@if(count($permission->childPs) > 0 or substr($permission->menu_name, 0, 1) == "#") {{$permission->menu_name}}
                       @else
                       {{route($permission->menu_name)}}
                       @endif">
                        <i class="{{$permission->icon}}"></i>
                        &nbsp;
                        @if(count($permission->childPs) > 0 and substr($permission->menu_name, 0, 1) == "#")
                            {{$permission->display_name}}
                        @else
                            {{$permission->display_name}}
                        @endif
                    </a>
                    @if(count($permission->childPs)>0 and substr($permission->menu_name, 0, 1) == "#")
                        <?php
                        if ($permission->id > 0) {
                            $childs = $allpermissions->where('parent_id', $permission->id)
                                ->sortBy('order');
                        }
                        ?>
                        <ul class="nav-dropdown-items">
                            @foreach ($childs as $child)
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{route($child->menu_name)}}">{{ $child->display_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>

            @endforeach
            <li class="nav-item">
                <a class="nav-link" href="{{route('user-password.edit', auth()->id())}}">
                  <i class="fas fa-redo-alt" style="margin-right: 12px;"></i>Change Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
