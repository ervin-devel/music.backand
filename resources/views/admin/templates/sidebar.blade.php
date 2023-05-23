<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(userCheckAccess('albums-create') || userCheckAccess('albums-index'))
                    <li class="nav-item {{ isActiveNavLink(['admin.album.create', 'admin.album.index', 'admin.album.edit'], 'menu-open') }}">
                        <a href="#" class="nav-link">
                            <i class="fas fa-compact-disc nav-icon"></i>
                            <p>
                                Альбомы
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(userCheckAccess('albums-create'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.album.create') }}" class="nav-link {{ isActiveNavLink('admin.album.create', 'active') }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Добавить</p>
                                    </a>
                                </li>
                            @endif
                            @if(userCheckAccess('albums-index'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.album.index') }}" class="nav-link {{ isActiveNavLink('admin.album.index', 'active') }}">
                                        <i class="fa fa-list nav-icon" aria-hidden="true"></i>
                                        <p>Перейти к списку</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(userCheckAccess('tracks-create') || userCheckAccess('tracks-index'))
                    <li class="nav-item {{ isActiveNavLink(['admin.track.create', 'admin.track.index', 'admin.track.edit'], 'menu-open') }}">
                        <a href="#" class="nav-link">
                            <i class="fa-solid fa-music nav-icon"></i>
                            <p>
                                Трэки
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(userCheckAccess('tracks-create'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.track.create') }}" class="nav-link {{ isActiveNavLink('admin.track.create', 'active') }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Загрузить</p>
                                    </a>
                                </li>
                            @endif
                            @if(userCheckAccess('tracks-index'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.track.index') }}" class="nav-link {{ isActiveNavLink('admin.track.index', 'active') }}">
                                        <i class="fa fa-list nav-icon" aria-hidden="true"></i>
                                        <p>Перейти к списку</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(userCheckAccess('genres-create') || userCheckAccess('genres-index'))
                    <li class="nav-item {{ isActiveNavLink(['admin.genre.create', 'admin.genre.index', 'admin.genre.edit'], 'menu-open') }}">
                        <a href="#" class="nav-link">
                            <i class="fa-solid fa-tags nav-icon"></i>
                            <p>
                                Жанры
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(userCheckAccess('genres-create'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.genre.create') }}" class="nav-link {{ isActiveNavLink('admin.genre.create', 'active') }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Добавить</p>
                                    </a>
                                </li>
                            @endif
                            @if(userCheckAccess('genres-index'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.genre.index') }}" class="nav-link {{ isActiveNavLink('admin.genre.index', 'active') }}">
                                        <i class="fa fa-list nav-icon" aria-hidden="true"></i>
                                        <p>Перейти к списку</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(userCheckAccess('artists-create') || userCheckAccess('artists-index'))
                    <li class="nav-item {{ isActiveNavLink(['admin.artist.create', 'admin.artist.index', 'admin.artist.edit'], 'menu-open') }}">
                        <a href="#" class="nav-link">
                            <i class="fa-solid fa-users nav-icon"></i>
                            <p>
                                Артисты
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                @if(userCheckAccess('artists-create'))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.artist.create') }}" class="nav-link {{ isActiveNavLink('admin.artist.create', 'active') }}">
                                            <i class="fa fa-plus nav-icon"></i>
                                            <p>Добавить</p>
                                        </a>
                                    </li>
                                @endif
                                @if(userCheckAccess('artists-index'))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.artist.index') }}" class="nav-link {{ isActiveNavLink('admin.artist.index', 'active') }}">
                                            <i class="fa fa-list nav-icon" aria-hidden="true"></i>
                                            <p>Перейти к списку</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if(userCheckAccess('roles-create') || userCheckAccess('roles-index'))
                        <li class="nav-item {{ isActiveNavLink(['admin.role.create', 'admin.role.index', 'admin.role.edit'], 'menu-open') }}">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-tag nav-icon"></i>
                                <p>
                                    Роли
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if(userCheckAccess('artists-create'))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.role.create') }}" class="nav-link {{ isActiveNavLink('admin.role.create', 'active') }}">
                                            <i class="fa fa-plus nav-icon"></i>
                                            <p>Добавить</p>
                                        </a>
                                    </li>
                                @endif
                                @if(userCheckAccess('artists-index'))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.role.index') }}" class="nav-link {{ isActiveNavLink('admin.role.index', 'active') }}">
                                            <i class="fa fa-list nav-icon" aria-hidden="true"></i>
                                            <p>Перейти к списку</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
</aside>
