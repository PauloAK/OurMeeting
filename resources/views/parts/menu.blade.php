<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">OurMeeting</div>
    <div class="list-group list-group-flush">
        <a href="{{ route('home') }}" class="list-group-item list-group-item-action {{ Route::is('home') ? 'active-menu' : '' }}"><i class="fas fa-fw fa-home"></i> Início</a>
        <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action  {{ Route::is('users.*') ? 'active-menu' : '' }}"><i class="fas fa-fw fa-users"></i> Usuários</a>
        <a href="{{ route('departments.index') }}" class="list-group-item list-group-item-action  {{ Route::is('departments.*') ? 'active-menu' : '' }}"><i class="fas fa-fw fa-street-view"></i> Setores</a>
        <a href="{{ route('rooms.index') }}" class="list-group-item list-group-item-action  {{ Route::is('rooms.*') ? 'active-menu' : '' }}"><i class="fas fa-fw fa-map-marker-alt"></i> Salas</a>
        <a href="{{ route('meetings.index') }}" class="list-group-item list-group-item-action  {{ Route::is('meetings.*') ? 'active-menu' : '' }}"><i class="fas fa-fw fa-comments"></i> Reuniões</a>
    </div>
</div>