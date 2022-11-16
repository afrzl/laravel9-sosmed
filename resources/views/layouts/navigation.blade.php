<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="navbar bg-base-100">
        <div class="navbar-start">

        </div>
        @if (isset($header))
            <div class="navbar-center">
                <a class="btn btn-ghost normal-case text-xl" href="{{ route('dashboard') }}">{{ $header }}</a>
            </div>
        @endif
        <div class="navbar-end">
            @auth
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle">
                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if ($notifications->count() > 0)
                                <span class="badge badge-xs badge-primary indicator-item"></span>
                            @endif
                        </div>
                    </label>
                    @if ($notifications->count() > 0)
                        <ul tabindex="0"
                            class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                            @foreach ($notifications as $notification)
                                <li><a
                                        href="{{ route('post.comment.read', [$notification->data['post_id'], $notification]) }}">
                                        {{ $notification->data['user_name'] }} commented on your post
                                        {{ $notification->created_at->diffForHumans() }}
                                        {{-- {{ $notification->notifiable->name }} --}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endauth
            <div class="dropdown dropdown-end mx-3">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-8 rounded-full">
                        <img
                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" />
                    </div>
                </label>
                <ul tabindex="0"
                    class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                    @auth
                        <li>
                            <a class="justify-between">
                                {{ auth()->user()->name }}
                                <span class="badge">Profile</span>
                            </a>
                        </li>
                        {{-- <li><a>Settings</a></li> --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <li>
                                <a onclick="event.preventDefault(); this.closest('form').submit();">Logout
                                </a>
                            </li>
                        </form>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
