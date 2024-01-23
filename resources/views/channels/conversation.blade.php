<x-app-layout>




    @include('channels/navigation', ['conversations' => $conversations, 'channel' => $channel])

    <!-- Chat content -->
    <div class="flex-1 flex flex-col bg-gray-900 overflow-hidden">
        <!-- Top bar -->
        <div class="border-b border-gray-800 flex px-6 py-2 items-center flex-none shadow-xl">
            <div class="flex flex-col">
                <h3 class="text-white mb-1 font-bold text-xl text-gray-100">
                    <span class="text-gray-400">#</span> {{ $conversation->name }}
                </h3>
            </div>
        </div>
        <!-- Chat messages -->

        <livewire:chats :conversation="$conversation" :key="$conversation->id" />



        <div class="pb-6 px-4 flex-none">

            <form class="flex flex-row items-center h-16 rounded-xl bg-gray-800 w-full px-4"
                action="{{ route('chat.send', $conversation->id) }}" method="POST">

                @csrf
                <div>
                    <button class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="flex-grow ml-4">
                    <div class="relative w-full">
                        <input type="text" name="content" placeholder="Say something..."
                            class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10 bg-gray-800 text-white" />
                        <button
                            class="absolute flex items-center justify-center h-full w-12 right-0 top-0 text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="ml-4">
                    <button type="submit"
                        class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-2 flex-shrink-0">
                        <span>Send</span>
                        <span class="ml-2">
                            <svg class="w-4 h-4 transform rotate-45 -mt-px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>



        </div>
    </div>


@push('scripts')

<script>

    //clear the input field on submit
    document.addEventListener('livewire:load', function () {
        Livewire.on('newMessage', function () {
            document.querySelector('input[name="content"]').value = '';

            //focus on the input field
            document.querySelector('input[name="content"]').focus();
        });
    });




</script>

@endpush



</x-app-layout>
