<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post Detail
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-6 sm:px-6 lg:px-8 lg:mx-auto">
            <div class="card w-full bg-base-100 shadow-xl my-3">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->user->name }} - <span
                            class="text-gray-400">{{ $post->created_at->diffForHumans() }}</span></h2>
                    <p>{{ $post->body }}</p>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success shadow-lg mb-3">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <h1 class="text-2xl my-3">Comment</h1>
            @foreach ($comments as $comment)
                <div id="{{ $comment->id }}" class="card w-full bg-base-100 shadow-xl my-3">
                    <div class="card-body">
                        <h2 class="card-title">{{ $comment->user->name }} -
                            <span class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            @can('delete', $comment)
                                <form method="post"
                                    action="{{ route('post.comment.destroy', [$comment->post, $comment]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-error btn-xs">
                                </form>
                            @endcan
                        </h2>
                        <p>{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach

            <div class="card w-full bg-base-100 shadow-xl my-3">
                <div class="card-body">
                    @auth
                        <form action="{{ route('post.comment.store', $post) }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="body" placeholder="Leave a comment..."
                                    class="input input-bordered w-full @error('body') input-error @enderror"
                                    value="{{ old('body') }}" />
                                <input type="submit" value="Post" class="btn">
                                @error('body')
                                    <span class="text-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    @else
                        <div class="alert shadow-lg">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="stroke-info flex-shrink-0 w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-bold">Login or register to comment something..</h3>
                                </div>
                            </div>
                            <div class="flex-none">
                                <a href="{{ route('login') }}"><button class="btn btn-sm">Login</button></a>
                                <a href="{{ route('register') }}"><button
                                        class="btn btn-sm btn-ghost">Register</button></a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
