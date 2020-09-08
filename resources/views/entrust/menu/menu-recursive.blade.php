<?php
$levelTwos = \App\Menu::nextLevel($permission->id)->get();
?>
<li style="display: list-item;"
    class=""
    id="menuItem_{{$permission->id}}">
    <div class="row custom-row menuDiv">
        <div data-id="{{$permission->id}}" class="itemTitle">
            <div class="row col-12">
                <div class="col-md-4">
                <span title="Click to show/hide children" class="disclose ui-icon ui-icon-minusthick">
                </span>{{$permission->menu_name}}
                </div>
                <div class="col-md-4">
                    <input type="text" class="" name="permission[{{$permission->menu_name}}][display_name]"
                           value="{{$permission->display_name}}">
                </div>

                <div class="col-md-4">
                    <select id="" class="select2" name="permission[{{$permission->menu_name}}][icon]">
                        <option value="{{$permission->icon}}"
                                selected="selected">{{$permission->icon}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    {{--@each('admin.entrust.permission.project', $levelTwos, 'permission', 'admin.entrust.permission.projects-none')--}}
    @if($levelTwos->count()>0)
        <ol class="">
            @foreach($levelTwos as $permission)
                @include('entrust.menu.menu-recursive', $permission)
            @endforeach
        </ol>
    @endif
</li>






