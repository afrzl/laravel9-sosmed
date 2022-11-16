<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timeline') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-6 sm:px-6 lg:px-8 lg:mx-auto">
            @if (session('success'))
                <div class="alert alert-success shadow-lg mb-3">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @auth
                        <form action="{{ route('post.store') }}" method="post">
                            @csrf
                            <textarea class="textarea textarea-bordered w-full rounded @error('body') textarea-error @enderror" name="body"
                                rows="3" placeholder="Post something...">{{ old('body') }}</textarea>
                            <input type="submit" value="Post" class="btn mt-2">
                            @error('body')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
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
                                    <h3 class="font-bold">Login or register to post something..</h3>
                                </div>
                            </div>
                            <div class="flex-none">
                                <a href="{{ route('login') }}"><button class="btn btn-sm">Login</button></a>
                                <a href="{{ route('register') }}"><button class="btn btn-sm btn-ghost">Register</button></a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            @foreach ($posts as $post)
                <div class="card w-full bg-base-100 shadow-xl my-3">
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->user->name }} - <span
                                class="text-gray-400">{{ $post->created_at->diffForHumans() }}</span></h2>
                        <p>{{ $post->body }}</p>
                    </div>
                    <div class="card-actions justify-end">
                        <a class="link mx-3 my-3" href="{{ route('post.show', $post) }}">Comment
                            ({{ $post->comments_count }})
                        </a>
                    </div>
                </div>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
