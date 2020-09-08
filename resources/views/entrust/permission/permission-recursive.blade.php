<?php
$levelTwos = \App\Permission::nextLevel($permission->id)->get();
?>
<li style="display: list-item;"
    class=""
    id="menuItem_{{$permission->id}}">
    <div class="row custom-row menuDiv">
        <div data-id="{{$permission->id}}" class="itemTitle col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <span title="Click to show/hide children" class="disclose ui-icon ui-icon-minusthick"></span>
                    <span>{{$permission->name}}</span>
                </div>
                <div class="col-md-4">
                    <input type="text" class="" name="permission[{{$permission->name}}][display_name]"
                           value="{{$permission->display_name}}">
                </div>
                {{--<div class="col-md-4">
                    <select id="" class="select" name="{{$permission->name}}-icon">
                        <option value="{{$permission->icon}}"
                                selected="selected">{{$permission->icon}}</option>
                    </select>
                </div>--}}
            </div>
        </div>
    </div>
    {{--@each('admin.entrust.permission.project', $levelTwos, 'permission', 'admin.entrust.permission.projects-none')--}}
    @if($levelTwos->count()>0)
        <ol class="">
            @foreach($levelTwos as $permission)
                @include('entrust.permission.permission-recursive', $permission)
            @endforeach
        </ol>
    @endif
</li>