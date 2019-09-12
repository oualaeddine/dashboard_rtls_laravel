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
            <li>
                <a class="nav-link nav-link text-danger" href="{{route('events.alerts')}}">
                    <i class="fas fa-bell"></i>
                    <span>Alertes</span>
                </a>
            </li>
           {{-- <li>
                <a class="nav-link" href="{{route('events.seances')}}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Séances</span>
                </a>
            </li>--}}
            <li>
                <a class="nav-link text-info" href="{{route('events.seances')}}">
                    <i class="fas fa-stethoscope"></i>
                    <span>Séances de soins</span>
                </a>
            </li>

            <li class="menu-header">ADMINSTRATION</li>
            <li>
                <a class="nav-link" href="{{route('profile')}}">
                    <i class="fas fa-user"></i>
                    <span>Profil</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{route('admins')}}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span> Géstion des admins</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="{{route('rooms')}}">
                    <i class="fas fa-hotel"></i>
                    <span> Géstion des pièces</span>
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
