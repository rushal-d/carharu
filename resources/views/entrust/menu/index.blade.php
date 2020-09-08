@extends('layouts.app')
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
        .test {
            min-height: 70vh;
            overflow-y: scroll;
            max-height: 70vh;
        }

        .selectize-input {
            min-height: 25px !important;
        }

        .selectize-control.select.single {
            margin: -5px 0px -7px 0px;
        }

        .custom-row .col-md-4 {
            padding: 0px 6px !important;
            height: 25px;
        }

        a, a:visited {

            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        pre, code {
            font-size: 12px;
        }

        pre {
            width: 100%;
            overflow: auto;
        }

        small {
            font-size: 90%;
        }

        small code {
            font-size: 11px;
        }

        .placeholder {
            outline: 1px dashed #4183C4;
        }

        .mjs-nestedSortable-error {
            background: #fbe3e4;
            border-color: transparent;
        }

        #tree {
            width: 550px;
            margin: 0;
        }

        ol {
            max-width: 800px;
            padding-left: 25px;
        }

        ol.sortable, ol.sortable ol {
            list-style-type: none;
        }

        .sortable li div {

            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            cursor: move;
            border-color: #D4D4D4 #D4D4D4 #BCBCBC;
            margin: 0;
            padding: 3px;
            width: 100%;
        }

        li.mjs-nestedSortable-collapsed.mjs-nestedSortable-hovering div {
            border-color: #999;
        }

        .disclose, .expandEditor {
            cursor: pointer;
            width: 20px;
            display: none;
        }

        .sortable li.mjs-nestedSortable-collapsed > ol {
            display: none;
        }

        .sortable li.mjs-nestedSortable-branch > div > .disclose {
            display: inline-block;
        }

        .sortable span.ui-icon {
            display: inline-block;
            margin: 0;
            padding: 0;
        }

        .menuDiv {
            border: 1px solid #d4d4d4;
            background: #EBEBEB;
        }

        .menuEdit {
            background: #FFF;
        }

        .itemTitle {
            vertical-align: middle;
            cursor: pointer;
        }

        .deleteMenu {
            float: right;
            cursor: pointer;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 0;
        }

        h2 {
            font-size: 1.2em;
            font-weight: 400;
            font-style: italic;
            margin-top: .2em;
            margin-bottom: 1.5em;
        }

        h3 {
            font-size: 1em;
            margin: 1em 0 .3em;
        }

        p, ol, ul, pre, form {
            margin-top: 0;
            margin-bottom: 1em;
        }

        dl {
            margin: 0;
        }

        dd {
            margin: 0;
            padding: 0 0 0 1.5em;
        }

        code {
            background: #e5e5e5;
        }

        input {
            vertical-align: text-bottom;
        }

        .notice {
            color: #c33;
        }

        form input {
            margin-top: 0px;
        }

    </style>
    <style>
        span.help-block.form-error {
            display: block;
            position: initial;
        }
    </style>

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="form-title text-center">New Menu</div>
                    <div class="card-content">
                        <button class="btn btn-sm btn-success" type="button" data-toggle="modal"
                                data-target="#newHeading">Add Menu Heading
                        </button>
                        <div id="newHeading" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">New Menu Heading</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="form-control" id="menu_heading" value="#">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal"
                                                id="add_menu_heading">Add
                                        </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3 test" style="border: 1px solid black">
                <input type="text" id="search_item">
                <button class="button button-search">Search</button>

                <div class="scroll">
                    @foreach($permissions as $permission)
                        {{$permission->name}}
                        <input type="hidden" class="menu_name" value="{{$permission->name}}">
                        <input type="checkbox" class="route" value="{{$permission->id}}"
                               style="position: absolute;right: 30px;"
                               @if(in_array($permission->id,$menu_ids))
                               checked
                                @endif
                        ><br>
                        <div style="border-bottom: 1px solid blue"></div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-9">
                <section id="demo">
                    <form action="{{route('display-name-store')}}" method="post"
                          id="display_name_store">
                        @csrf
                        <ol class="sortable">
                            @each('entrust.menu.menu-recursive', $menus, 'permission')
                        </ol>
                    </form>
                    <p class="text-center"><input id="toArray" name="toArray" type="button" value=
                        "Build Menu" class="btn btn-warning"></p>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script>
        var delay = (function () {
            var timer = 0;
            return function (callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();
        $('#search_item').keyup(function () {
            delay(function () {
                search();
            }, 1000)
        })
        $('.button-search').click(function () {
            search()
        });
        $('#menu_heading').keyup(function () {

            if (this.value.indexOf('#') !== 0) {
                this.value = '#' + this.value;
            }
        });
        $('#add_menu_heading').click(function () {
            new_menu_heading = $('#menu_heading').val();
            $.ajax({
                url: '{{route('permission.add')}}',
                type: 'post',
                data: {
                    '_token': '{{csrf_token()}}',
                    'name': new_menu_heading,
                    'isAjax': 1,
                },
                success: function (data) {
                    // console.log(data);
                    addToSortable(data['id'], new_menu_heading);
                    replace_div = new_menu_heading;
                    replace_div += '<input type="hidden" class="menu_name" value="' + new_menu_heading + '">';
                    replace_div += '<input type="checkbox" class="route" value="' + data['id'] + '"' +
                        '                                               style="position: absolute;right: 30px;"'
                    replace_div += "checked=checked";
                    replace_div += '><br>';
                    replace_div += '<div style="border-bottom: 1px solid blue"></div>';
                    $('.scroll').append(replace_div);

                }
            });
        });

        function search() {
            search_item = $('#search_item').val();
            $.ajax({
                url: '{{route('menu-search')}}',
                type: 'get',
                data: {
                    'search': search_item
                },
                success: function (data) {

                    var replace_div = "<div class=\"scroll\">";
                    $.each(data['permission'], function (index, value) {
                        replace_div += value['name'];
                        replace_div += '<input type="hidden" class="menu_name" value="' + value['name'] + '">';
                        replace_div += '<input type="checkbox" class="route" value="' + value['id'] + '"' +
                            '                                               style="position: absolute;right: 30px;"'
                        if (data['menu'].includes(value['id'])) {
                            replace_div += "checked=checked";
                        }
                        replace_div += '><br>';
                        replace_div += '   <div style="border-bottom: 1px solid blue"></div>';
                    });
                    replace_div += '</div>';
                    $('.scroll').remove();
                    $('.test').append(replace_div);
                }
            });


        }

        $(document).on('change', '.route', function () {

            var menu_name = $(this).prev().val();
            var id = $(this).val();
            if ($(this).is(":checked")) {

                addToSortable(id, menu_name)
            } else {
                $.ajax({
                    url: '{{route('menu-delete')}}',
                    type: 'post',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'id': id
                    },
                    success: function (data) {
                        if (data == "success") {
                            new_parent = $('#menuItem_' + id).parent();
                            console.log(new_parent);
                            inner_element = $('#menuItem_' + id).find('ol li');
                            length = inner_element.length;
                            for (i = 0; i < length; i++) {
                                new_parent.append(inner_element[i]);
                            }
                            $('#menuItem_' + id).remove();
                        }
                    }
                });
            }
        });

        function addToSortable(id, menu_name) {

            $.ajax({
                url: '{{route('menu-store')}}',
                type: 'post',
                data: {
                    '_token': '{{csrf_token()}}',
                    'id': id,
                    'order': 0,
                    'menu_name': menu_name
                },
                success: function (data) {
                    if (data == "success") {
                        listItem = '<li style="display: list-item;" class="mjs-nestedSortable-leaf" id="menuItem_' + id + '">\n' +
                            '    <div class="row custom-row menuDiv">\n' +
                            '        <div data-id="' + id + '" class="itemTitle">\n' +
                            '          <div class="row">\n' +
                            '            <div class="col-md-4">\n' +
                            '                <span title="Click to show/hide children" class="disclose ui-icon ui-icon-minusthick">\n' +
                            '                    <span></span>\n' +
                            '                </span>' + menu_name +
                            '            </div>\n' +
                            '            <div class="col-md-4"> <input type="text" class="" name="' + menu_name + '" value=""></div>\n' +
                            '            <div class="col-md-4">\n' +
                            '                <select class="select" name="' + menu_name + '-zzz" data-select2-id="1" tabindex="-1" aria-hidden="true">\n' +
                            '                    <option value="" selected="selected" data-select2-id="3"></option>\n' +
                            '                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2--container"><span class="select2-selection__rendered" id="select2--container" role="textbox" aria-readonly="true" title=""></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>\n' +
                            '            </div>\n' +
                            '        </div>\n' +
                            '    </div>\n' +
                            ' </div>\n' +
                            '    \n' +
                            '    </li>';
                        $('.sortable').append(listItem);
                    }
                }
            });
        }
    </script>
    <script>


        $(document).ready(function () {
            $.get('{{asset('assets/font-awesome/icons.json')}}', function (data) {
                var icons = [];
                $.each(data, function (index, icon) {
                    //get type of icon
                    var style = icon.styles[0];
                    var prefix = 'fa' + style.substring(0, 1);
                    var iconName = 'fa-' + index;
                    var label = icon.label;
                    var iconFullName = prefix + ' ' + iconName;
                    var icon_label = '<i class="' + iconFullName + '"></i> ' + label
                    icons.push({id: iconFullName, text: label, data: id = iconFullName});
                });
                $('.select2').select2({
                    data: icons,
                    allowHtml: true
                });

                function iformat(icon) {
                    var originalOption = icon;
                    console.log(originalOption);
                    return $('<span><i class="fa ' + $(originalOption).attr('id') + '"></i> ' + icon.text + '</span>');
                }

                $('.select2').select2({
                    width: "100%",
                    templateSelection: iformat,
                    templateResult: iformat,
                    allowHtml: true
                });


            });
        });
        $().ready(function () {
            var ns = $('ol.sortable').nestedSortable({
                forcePlaceholderSize: true,
                handle: 'div',
                helper: 'clone',
                items: 'li',
                opacity: .6,
                placeholder: 'placeholder',
                revert: 250,
                tabSize: 25,
                tolerance: 'pointer',
                toleranceElement: '> div',
                maxLevels: 4,
                isTree: true,
                expandOnHover: 700,
                startCollapsed: false
            });

            $('.expandEditor').attr('title', 'Click to show/hide item editor');
            $('.disclose').attr('title', 'Click to show/hide children');
            $('.deleteMenu').attr('title', 'Click to delete item.');

            $('.disclose').on('click', function () {
                $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
                $(this).toggleClass('ui-icon-plusthick').toggleClass('ui-icon-minusthick');
            });

            $('.expandEditor, .itemTitle').click(function () {
                var id = $(this).attr('data-id');
                $('#menuEdit' + id).toggle();
                $(this).toggleClass('ui-icon-triangle-1-n').toggleClass('ui-icon-triangle-1-s');
            });

            $('.deleteMenu').click(function () {
                var id = $(this).attr('data-id');
                $('#menuItem_' + id).remove();
            });

            $('#serialize').click(function () {
                serialized = $('ol.sortable').nestedSortable('serialize');
                $('#serializeOutput').text(serialized + '\n\n');
            })

            $('#toHierarchy').click(function (e) {
                hiered = $('ol.sortable').nestedSortable('toHierarchy', {startDepthCount: 0});
                hiered = dump(hiered);

                (typeof ($('#toHierarchyOutput')[0].textContent) != 'undefined') ?
                    $('#toHierarchyOutput')[0].textContent = hiered : $('#toHierarchyOutput')[0].innerText = hiered;
            });

            $('#toArray').click(function (e) {

                arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
                var json = JSON.stringify(arraied);
                var token = $('input[name=_token]').val();
                $.ajax({
                    url: "{{URL::to('/backend/menu/buildMenu')}}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        '_token': token,
                        "menu": arraied,
                    },
                    success: function (msg) {
                        $('#display_name_store').submit();
                    }
                });
            });
        });


    </script>

@endsection
