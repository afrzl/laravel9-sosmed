<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post Detail
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            @foreach ($post->comments as $comment)
                <div class="card w-full bg-base-100 shadow-xl my-3">
                    <div class="card-body">
                        <h2 class="card-title">{{ $comment->user->name }} - <span
                                class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</span></h2>
                        <p>{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach

            <div class="card w-full bg-base-100 shadow-xl my-3">
                <div class="card-body">
                    <form action="{{ route('post.comment.store', $post) }}" method="post">
                        @csrf
                        <textarea class="textarea textarea-bordered w-full rounded @error('body') textarea-error @enderror" name="body"
                            rows="3" placeholder="Leave a comment...">{{ old('body') }}</textarea>
                        <input type="submit" value="Post" class="btn mt-2">
                        @error('body')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
