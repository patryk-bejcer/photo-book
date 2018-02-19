@if (belongs_to_auth($user->id) || Auth::user()->hasRole('Administrator'))
    <a href="{{url('/users/' . $user->id . '/images/upload')}}" class="btn btn-primary">Dodaj zdjęcia</a>
    <a href="{{url('/users/' . $user->id . '/albums/create')}}" class="btn btn-secondary">Dodaj album</a>
@endif

<h2 class="mt-3 mb-4"><i class="fas fa-user"></i> {{ $user->name }}</h2>