
@push('styles')
<style>
                /* Set scrollbar width */
        #list::-webkit-scrollbar {
        width: 10px;
        }

        /* Change thumb color */
        #list::-webkit-scrollbar-thumb {
        background-color: rgb(143, 143, 143);
        border-radius: 10px;
        }

        /* Apply hover effect */
        #list::-webkit-scrollbar-thumb:hover {
        background-color: red;
        }
</style>
@endpush


<div class="h-full" wire:poll.5000ms="checkUpdate">

    <div id="list" class="flex-grow overflow-y-scroll flex flex-col-reverse h-[calc(100vh-130px)]">

        @php
            //reverse the array to show the latest message at the bottom
            $chats = $chats->reverse();
        @endphp
        @foreach ($chats as $chat)

        @php

            //get current channel
            $channel = $chat->conversation->channel->name;
            $user = \App\Models\User::Where('name', $channel)->first();

        @endphp


                @if ($chat->user_id !== $user->id)
      	
                    <div class="col-start-1 col-end-8 p-3 rounded-lg">
                        <div class="flex flex-row items-center">
                            <div
                                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-900 flex-shrink-0">
                                {{ auth()->user()->name[0] }}
                            </div>
                            <div class="relative ml-3 text-sm bg-gray-700 py-2 px-4 shadow rounded-xl">
                                <div class="text-white">{!! Illuminate\Support\Str::markdown($chat->content) !!}</div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-start-6 col-end-13 p-3 rounded-lg">
                        <div class="flex items-center justify-start flex-row-reverse">
                            <div
                                class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-900 flex-shrink-0">
                                {{ $chat->user->name[0] }}
                            </div>
                            <div class="relative mr-3 text-sm bg-indigo-800 py-2 px-4 shadow rounded-xl">
                                <div class="text-white">{!! Illuminate\Support\Str::markdown($chat->content) !!}</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
    </div>

</div>



@push('scripts')
<script>

        document.addEventListener('livewire:load', function () {
            Livewire.on('newMessage', function () {


                   //scroll to bottom (Reversed)
                    var list = document.getElementById('list');
                    list.scrollTop = list.scrollHeight;


            });
        });

</script>
@endpush
