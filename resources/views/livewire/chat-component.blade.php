<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen">
        <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-400">
            <div class="relative flex items-center " style="padding: 5px 5px 5px 0!important">
                <div class="relative" style="max-width: 25% !important">
                    {{-- <span class="absolute text-green-500 right-0 bottom-0">
                        <svg width="20" height="20">
                            <circle cx="35" cy="35" r="35" fill="currentColor"></circle>
                        </svg>
                    </span> --}}
                    <img src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                        alt="" class="rounded-full">
                </div>
                <div class="flex flex-col leading-tight space-x-10">
                    <div class="text-2xl mt-1 flex items-center">
                        <span class="text-gray-700 ml-5 mr-3"
                            style="padding-left:10px !important">{{ $user->name }}</span>
                    </div>
                    {{-- <span class="text-lg text-gray-600">Junior Developer</span> --}}
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button type="button"
                    class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <button type="button"
                    class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </button>
                <button type="button"
                    class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    {{-- ----------------------------------------------------------------------------------------------------------------------------- --}}
    {{-- <div class="menu">
        <div class="back"><i class="fa fa-chevron-left"></i> <img src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                draggable="false" /></div>
        <div class="name">Alex</div>
        <div class="last">18:09</div>
    </div> --}}
    <ol class="chat">
        @foreach ($messages as $message)
            @if ($message['sender']['name'] != auth()->user()->name)
                <li class="other">
                    <div class="avatar"><img
                            src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                            draggable="false" /></div>
                    <div class="container">
                        <div class="arrow">
                            <div class="outer"></div>
                            <div class="inner"></div>
                        </div>
                        <div class="message-body">
                            <p><b>: {{ $message['sender']['name'] }}</b>{{ $message['message'] }}</p>
                        </div>
                    </div>
                </li>
            @else
                <li class="self">
                    <div class="avatar"><img
                            src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                            draggable="false" /></div>
                    <div class="container">
                        <div class="arrow">
                            <div class="outer"></div>
                            <div class="inner"></div>
                        </div>
                        <div class="message-body">
                            <p>{{ $message['message'] }} <b>: You</b></p>
                        </div>
                    </div>
                </li>
            @endif
        @endforeach
    </ol>
    <form wire:submit="sendMessage()">

        <input type="text" placeholder="Your name" wire:model="message">
        <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>

        </button>
    </form>
</div>
