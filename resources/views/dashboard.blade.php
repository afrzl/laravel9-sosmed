<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timeline') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    <form action="{{ route('post.store') }}" method="post">
                        @csrf
                        <textarea class="textarea textarea-bordered w-full rounded @error('body') textarea-error @enderror" name="body"
                            rows="3" placeholder="Post something...">{{ old('body') }}</textarea>
                        <input type="submit" value="Post" class="btn mt-2">
                        @error('body')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </form>
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
                        <a class="link mx-3 my-3" href="{{ route('post.show', $post) }}">Comment (10)</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
