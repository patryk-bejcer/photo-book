@extends('layouts.admin')

@section('title', '| Users')

@section('content')

    <div class="col-lg-9 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Zarządzanie użytkownikami <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Role</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Uprawnienia</a></h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Email</th>
                    <th>Data rejestracji</th>
                    <th>Role użytkownika</th>
                    <th>Operacje</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($users as $user)
                    <tr>

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                        <td>{{   $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                        <td style="min-width:200px;">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edycja</a>
                            <a href="{{ url('admin/users/' . $user->id . '/images') }}" class="btn btn-success pull-left" style="margin-right: 3px;">Zdjęcia</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                            {!! Form::submit('Usuń', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-success">Dodaj nowego użytkownika</a>

    </div>

@endsection