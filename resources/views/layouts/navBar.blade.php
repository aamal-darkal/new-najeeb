<div class="navbar navbar-toggleable-sm flex-row align-items-center">
    <!-- Open side - Naviation on mobile -->
    <a data-toggle="modal" data-target="#aside" class="hidden-lg-up">
        <i class="material-icons">&#xe5d2;</i>
    </a>

    <!-- navbar right -->
    <ul class="nav navbar-nav ml-auto flex-row">
        <li class="nav-item dropdown pos-stc-xs">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class=" btn btn-outline b-danger border-0 text-danger"> <i
                        class="material-icons">power_settings_new </i></button>
            </form>
        </li>
        <li class="nav-item dropdown">

        </li>
        <li class="nav-item hidden-md-up">

        </li>
    </ul>
    <!-- / navbar right -->
</div>
