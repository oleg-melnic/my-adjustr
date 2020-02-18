@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Show User Management')])

@section('template_title')
    {!! trans('laravelusers::laravelusers.showing-user', ['name' => $user->name]) !!}
@endsection

@section('template_linked_css')
    @if(config('laravelusers.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.datatablesCssCDN') }}">
    @endif
    @if(config('laravelusers.fontAwesomeEnabled'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.fontAwesomeCdn') }}">
    @endif
    @include('laravelusers::partials.styles')
    @include('laravelusers::partials.bs-visibility-css')
@endsection

@section('content')
    <div class="container" style="padding-top: 30px;">
        @if(config('laravelusers.enablePackageBootstapAlerts'))
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    @include('laravelusers::partials.form-status')
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('laravelusers::laravelusers.showing-user-title', ['name' => $user->name]) !!}
                            <div class="float-right">
                                <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{!! trans('laravelusers::laravelusers.tooltips.back-users') !!}">
                                    @if(config('laravelusers.fontAwesomeEnabled'))
                                        <i class="fas fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @endif
                                    {!! trans('laravelusers::laravelusers.buttons.back-to-users') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="text-muted text-center">
                            {{ $user->name }}
                        </h4>
                        @if($user->email)
                            <p class="text-center" data-toggle="tooltip" data-placement="top" title="{!! trans('laravelusers::laravelusers.tooltips.email-user', ['user' => $user->email]) !!}">
                                {{ Html::mailto($user->email, $user->email) }}
                            </p>
                        @endif
                        <div class="row mb-4">
                            <div class="col-3 offset-3 col-sm-4 offset-sm-2 col-md-4 offset-md-2 col-lg-3 offset-lg-3">
                                <a href="/users/{{$user->id}}/edit" class="btn btn-block btn-md btn-warning">
                                    {!! trans('laravelusers::laravelusers.buttons.edit-user') !!}
                                </a>
                            </div>
                            <div class="col-3 col-sm-4 col-md-4 col-lg-3">
                                {!! Form::open(array('url' => 'users/' . $user->id, 'class' => 'form-inline')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button(trans('laravelusers::laravelusers.buttons.delete-user'), array('class' => 'btn btn-danger btn-md btn-block','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user?')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-4 col-sm-3">
                                        <strong>
                                            {!! trans('laravelusers::laravelusers.show-user.id') !!}
                                        </strong>
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        {{ $user->id }}
                                    </div>
                                </div>
                            </li>
                            @if ($user->name)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                {!! trans('laravelusers::laravelusers.show-user.name') !!}
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if ($user->email)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-12 col-sm-3">
                                            <strong>
                                                {!! trans('laravelusers::laravelusers.show-user.email') !!}
                                            </strong>
                                        </div>
                                        <div class="col-12 col-sm-9">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-4 col-sm-3">
                                        <strong>
                                            {{ trans('laravelusers::laravelusers.show-user.labelRole') }}
                                        </strong>
                                    </div>
                                    <div class="col-8 col-sm-9">
                                            @if ($user->type === 'homewowner')
                                                @php $labelClass = 'primary' @endphp
                                            @elseif ($user->type == 'admin')
                                                @php $labelClass = 'warning' @endphp
                                            @elseif ($user->type == 'professional')
                                                @php $labelClass = 'danger' @endphp
                                            @else
                                                @php $labelClass = 'default' @endphp
                                            @endif
                                            <span class="badge badge-{{$labelClass}}">{{ $user->type }}</span>
                                    </div>
                                </div>
                            </li>
                            @if ($user->created_at)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                {!! trans('laravelusers::laravelusers.show-user.created') !!}
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            {{ $user->created_at }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if ($user->updated_at)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                {!! trans('laravelusers::laravelusers.show-user.updated') !!}
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            {{ $user->updated_at }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('laravelusers::modals.modal-delete')
@endsection

@push('js')

    <script type="text/javascript">

        $('#confirmDelete').on('show.bs.modal', function (e) {
            var message = $(e.relatedTarget).attr('data-message');
            var title = $(e.relatedTarget).attr('data-title');
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-body p').text(message);
            $(this).find('.modal-title').text(title);
            $(this).find('.modal-footer #confirm').data('form', form);
        });
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
            $(this).data('form').submit();
        });

    </script>

    @if(config('laravelusers.tooltipsEnabled'))
        @include('laravelusers::scripts.tooltips')
    @endif
@endpush
