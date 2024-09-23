<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-customChat overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mt-5 flex items-center">
                        <div class="flex items-center gap-2 text-slate-200">
                            <p class="font-medium">Messages</p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="ml-auto h-5 w-5 text-slate-300">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                        </svg>
                    </div>

                    <div class="mt-5 flex flex-col gap-2">
                        @foreach ($users as $user)
                            <a href="{{ route('chat', $user->id) }}"
                                class="flex items-center gap-2 rounded-md px-2 py-2 transition-colors duration-300 hover:bg-light">
                                <div class="h-[42px] w-[42px] shrink-0 rounded-full">
                                    <div class="m-1 mr-2 w-10  relative flex justify-center items-center rounded-full bg-gray-500 text-xl text-white"
                                        style="margin-right: 10px">
                                        <img src="{{ asset('storage/' . $user->image) }}" class="rounded-full">
                                        @if ($user->isActive())
                                            <div class="absolute right-0 bottom-0 w-3 h-3 rounded-full bg-green-500">
                                            </div>
                                        @else
                                            <div class="absolute right-0 bottom-0 w-3 h-3 rounded-full bg-red-500">
                                            </div>
                                        @endif
                                    </div>
                                    {{-- <img src="{{ asset('storage/' . $user->image) }}"
                                        class="w-12 rounded-full object-cover" alt="" />
                                    <span class="text-white status {{ $user->isActive() ? 'online' : 'offline' }}">
                                        {{ $user->isActive() ? 'Online' : 'Offline' }}
                                    </span> --}}
                                </div>
                                <div class="overflow-hidden text-left">
                                    <h2 class="truncate text-sm font-medium text-slate-200">{{ $user->name }}</h2>
                                    <p class="truncate text-sm text-slate-400">Why you are not replying</p>
                                </div>
                                <div class="ml-auto flex flex-col items-end gap-1">
                                    <p class="text-xs text-slate-400">11:30</p>
                                    <p
                                        class="grid h-4 w-4 place-content-center rounded-full bg-green-600 text-xs text-slate-200">
                                        4
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Echo.private('chat-channel.{userId}')
            .listen('UserActivity', (event) => {
                // Update the user activity status
                const userStatus = document.querySelector(`.status[data-user-id="${event.user.id}"]`);
                if (userStatus) {
                    userStatus.classList.remove('offline');
                    userStatus.classList.add('online');
                    userStatus.textContent = 'Online';
                }
            });
    </script>
@endpush
