<!-- aside -->
<div id="aside" class="app-aside modal fade nav-expand" style="width:200px">
    <div class="left navside black dk" layout="column">
        <div class="navbar no-radius" style="background: #0cc2aa">
            <!-- brand -->
            <a class="navbar-brand" style="margin: auto">
                <div ui-include="{{ asset('images/najeb.png') }}"></div>

                <span class="hidden-folded inline"><img src="{{ asset('images/najeb.png') }}" alt="."></span>
            </a>
            <!-- /brand -->
        </div>
        {{-- <div flex-no-shrink>
            <div ui-include="'../views/blocks/aside.top.2.html'"></div>
        </div> --}}
        <div flex class="hide-scroll w-100">
            <nav class="scroll nav-stacked nav-active-primary w-100">

                <ul class="nav" ui-nav>
                    @if (Route::has('dashboard'))
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <span class="nav-icon">
                                    <i class="material-icons">&#xe3fc;
                                    </i>
                                </span>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                    @endif
                    @if (Route::has('students.index'))
                        <li>
                            <a>
                                <span class="nav-caret">
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <span class="nav-icon">
                                    <i class="fa fa-users"></i>
                                </span>
                                <span class="nav-text">Students</span>
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{ route('students.index') }}">
                                        <span class="nav-text">Current Students</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('students.create') }}">
                                        <span class="nav-text">Add student</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('students.index', ['state' => 'banned']) }}">
                                        <span class="nav-text">Banned students</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (Route::has('packages.index'))
                        <li>

                            <a href="{{ route('packages.index') }}">
                                <span class="nav-icon">
                                    <i class="fa fa-layer-group"></i>
                                </span>
                                <span class="nav-text">All Packages</span>
                            </a>
                        </li>
                    @endif

                    @if (Route::has('subscriptions.index'))
                        <li>
                            <a>
                                <span class="nav-caret">
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <span class="nav-icon">
                                    <i class="material-icons">&#xe854;
                                        <span ui-include="'../assets/images/i_1.svg'"></span>
                                    </i>
                                </span>
                                <span class="nav-text">Subscriptions</span>
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{ route('subscriptions.index') }}">
                                        <span class="nav-text">All subscriptions</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subscriptions.edit', 'pending') }}">
                                        <span class="nav-text">Pending <span class="pull-right label red">
                                                @php
                                                    $requestsCount = \App\Models\Payment::where('state', 'pending')->count();
                                                    echo $requestsCount;
                                                @endphp
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('subscriptions.edit', 'approved') }}">
                                        <span class="nav-text">Approved </span>
                                    </a>
                                </li> --}}
                                {{-- <li>
                                    <a href="{{ route('subscriptions.edit', 'rejected') }}">
                                        <span class="nav-text">Rejected</span>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                    @endif
                    @if (Route::has('notifications.index'))
                        <li>
                            <a>
                                <span class="nav-caret">
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <span class="nav-icon">
                                    <i class="material-icons">&#xe7f7;
                                        <span ui-include="'../assets/images/i_1.svg'"></span>
                                    </i>
                                </span>
                                <span class="nav-text">Notifications</span>
                            </a>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{ route('notifications.index') }}">
                                        <span class="nav-text">All Notification</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-sub">
                                <li>
                                    <a href="{{ route('notifications.create', ['all' => 'all']) }}">
                                        <span class="nav-text">Broadcast</span>
                                    </a>
                                </li>
                            </ul>

                        </li>
                    @endif
                    @if (Route::has('settings.index'))
                        <li>
                            <a href="{{ route('settings.index') }}">
                                <span class="nav-icon">
                                    <i class="fas fa-cog">
                                    </i>
                                </span>
                                <span class="nav-text">Configuration</span>
                            </a>
                        </li>
                    @endif
                    <li>                        
                        <a onclick="location.reload()">
                            <span class="nav-icon">
                                <i class="fas fa-eye-slash">
                                </i>
                            </span>
                            <span class="nav-text">Hide</span>
                        </a>
                    </li>
                   
                </ul>
            </nav>
        </div>
        <div flex-no-shrink>
            <div ui-include="'../views/blocks/aside.bottom.0.html'"></div>
        </div>
    </div>
</div>
