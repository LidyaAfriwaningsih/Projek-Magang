@extends('layouts.main')

@push('script')
    <script>
        $(document).on('click', '.btn-edit', function() {
            const id = $(this).data('id');
            $('#editModal form').attr('action', '{{ route('user.index') }}/' + id);
            $('#editModal input:hidden#id').val(id);
            $('#editModal input#name').val($(this).data('name'));
            $('#editModal input#phone').val($(this).data('phone'));
            $('#editModal input#email').val($(this).data('email'));
            if ($(this).data('active') == 1) {
                $('#editModal input#is_active').prop('checked', true);
            } else {
                $('#editModal input#is_active').prop('checked', false);
            }
        });
    </script>
@endpush

@section('content')
    <x-breadcrumb :values="[__('menu.users')]">
        <button type="button" class="btn btn-primary btn-create" data-bs-toggle="modal" data-bs-target="#createModal">
            {{ __('menu.general.create') }}
        </button>
    </x-breadcrumb>

    <div class="card mb-5">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('model.user.name') }}</th>
                        <th>{{ __('model.user.email') }}</th>
                        <th>{{ __('model.user.phone') }}</th>
                        <th>{{ __('model.user.is_active') }}</th>
                        <th>{{ __('menu.general.action') }}</th>
                    </tr>
                </thead>
                @if ($data)
                    <tbody>
                        @foreach ($data as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td><span
                                        class="badge bg-label-primary me-1">{{ __('model.user.' . ($user->is_active ? 'active' : 'nonactive')) }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm btn-edit" data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                        data-phone="{{ $user->phone }}" data-active="{{ $user->is_active }}"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        {{ __('menu.general.edit') }}
                                    </button>
                                    <form action="{{ route('user.destroy', $user) }}" class="d-inline" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm btn-delete"
                                            type="button">{{ __('menu.general.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">
                                {{ __('menu.general.empty') }}
                            </td>
                        </tr>
                    </tbody>
                @endif
                <tfoot class="table-border-bottom-0">
                    <tr>
                        <th>{{ __('model.user.name') }}</th>
                        <th>{{ __('model.user.email') }}</th>
                        <th>{{ __('model.user.phone') }}</th>
                        <th>{{ __('model.user.is_active') }}</th>
                        <th>{{ __('menu.general.action') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {!! $data->appends(['search' => $search])->links() !!}

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="{{ route('user.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalTitle">{{ __('menu.general.create') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-input-form name="name" :label="__('model.user.name')" />
                    <x-input-form name="email" :label="__('model.user.email')" type="email" />
                    <x-input-form name="phone" :label="__('model.user.phone')" />
                    <x-input-form name="role" :label="__('model.user.role')" type="select" :options="['admin' => 'Admin', 'user' => 'User']" />
                    <x-input-form name="password" :label="__('model.user.password')" type="password" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('menu.general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">{{ __('menu.general.save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">{{ __('menu.general.edit') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <x-input-form name="name" :label="__('model.user.name')" />
                    <x-input-form name="email" :label="__('model.user.email')" type="email" />
                    <x-input-form name="phone" :label="__('model.user.phone')" />
                    <x-input-form name="password" :label="__('model.user.password')" type="password" />
                    <x-input-form name="password_confirmation" :label="__('model.user.password_confirmation')" type="password" />
                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active">
                        <label class="form-check-label" for="is_active"> {{ __('model.user.is_active') }} </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('menu.general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">{{ __('menu.general.update') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
