<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(userCheckAccess('albums-create') || userCheckAccess('albums-index'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Альбомы
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(userCheckAccess('albums-create'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.album.create') }}" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Создать</p>
                                    </a>
                                </li>
                            @endif
                            @if(userCheckAccess('albums-index'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.album.index') }}" class="nav-link">
                                        <i class="fa fa-list nav-icon" aria-hidden="true"></i>
                                        <p>Перейти к списку</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(userCheckAccess('tracks-create') || userCheckAccess('tracks-index'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Трэки
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(userCheckAccess('tracks-create'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.track.create') }}" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Загрузить</p>
                                    </a>
                                </li>
                            @endif
                            @if(userCheckAccess('tracks-index'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.track.index') }}" class="nav-link">
                                        <i class="fa fa-list nav-icon" aria-hidden="true"></i>
                                        <p>Перейти к списку</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(userCheckAccess('ganres-create') || userCheckAccess('ganres-index'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Жанры
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(userCheckAccess('ganres-create'))
                                <li class="nav-item">
                                        <a href="{{ route('admin.track.create') }}" class="nav-link">
                                            <i class="fa fa-plus nav-icon"></i>
                                            <p>Загрузить</p>
                                        </a>
                                    </li>
                                @endif
                                @if(userCheckAccess('tracks-index'))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.track.index') }}" class="nav-link">
                                            <i class="fa fa-list nav-icon" aria-hidden="true"></i>
                                            <p>Перейти к списку</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Жанры
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.genre.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Создать</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.genre.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Перейти к списку</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Артисты
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.artist.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Создать</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.artist.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Перейти к списку</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
  </nav>
    </div>
</div>
<!-- /.sidebar -->
</aside>
