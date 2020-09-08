@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="custom-color">
                        <i class="fa fa-align-justify"></i>
                        Permission
                        <div class="card-header-actions">
                            <a class="btn btn-success btn-sm" href="{{route('permission.create')}}">
                                Reload Routes
                                <i class="nav-icon icon-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>URI</th>
                            <th>Parent ID</th>
                            <th>Order</th>
                            <th>Icon</th>
                            <th id="action-th">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($permissions->count() > 0)
                                @foreach($permissions as $permission )
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $permission->name ?? 'no data present' }}</td>
                                        <td>{{ $permission->uri ?? 'no data present' }}</td>
                                        <td>{{ $permission->parents->name ?? '-' }}</td>
                                        <td>{{ $permission->order ?? 'no data present' }}</td>
                                        <td>{{ $permission->icon ?? 'no data present' }}</td>
                                        <td class="td-actions">
                                            <a type="button" rel="tooltip" title="Edit"
                                               href="{{ route('permission.edit',$permission->id) }}"
                                               class="btn btn-success btn-simple btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" rel="tooltip" title="Delete"
                                                    class="btn btn-danger btn-simple btn-sm deleteRecord"
                                                    data-toggle="modal" data-target="#deleteModal"
                                                    data-id="{{ $permission->id }}"
                                                    data-token="{{ csrf_token() }}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No Data Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection