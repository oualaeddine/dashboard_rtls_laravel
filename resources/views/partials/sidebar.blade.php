<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a class="nav-link" href="{{route('home')}}">
                RTLS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a class="nav-link" href="{{route('home')}}">
                RTLS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">DASHBOARD</li>
            <li>
                <a class="nav-link text-primary" href="{{route('home')}}">
                    <i class="fas fa-credit-card"></i>
                    <span>Positions en temps réel</span>
                </a>
            </li>

            <li class="menu-header">PERSONNES</li>
            <li>
                <a class="nav-link" href="{{route('pensioners')}}">
                    <i class="fas fa-blind"></i>
                    <span> Pensionnaires</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="{{route('employees')}}">
                    <i class="fas fa-user-tie"></i>
                    <span> Gestion des employés</span>
                </a>
            </li>

            <li class="menu-header">ÉVÉNEMENT</li>
            {{--<li class="nav-item dropdown">--}}
            {{--<a href="#" class="nav-link has-dropdown"><i class="fas fa-tags"></i><span>Gérer catégories</span></a>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li><a class="nav-link" href="{{route('categories.all')}}">Listr des catégories</a></li>--}}
            {{--<li><a class="nav-link" href="#">Ajouter catégories</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            <li>
                <a class="nav-link text-danger" href="{{route('events')}}">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Alertes</span>
                </a>
            </li>
            <li>
                <a class="nav-link text-info" href="{{route('specials')}}">
                    <i class="fas fa-stethoscope"></i>
                    <span>Seances de soins</span>
                </a>
            </li>

            <li class="menu-header">ADMINSTRATION</li>
            <li>
                <a class="nav-link" href="{{route('profile')}}">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{route('admins')}}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span> Géestion des admins</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="{{route('rooms')}}">
                    <i class="fas fa-hotel"></i>
                    <span> Géestion des pieces</span>
                </a>
            </li>
           {{-- <li>
                <a class="nav-link" href="{{route('config')}}">
                    <i class="fas fa-cog"></i>
                    <span> Config</span>
                </a>
            </li>--}}
        </ul>
    </aside>
</div>
