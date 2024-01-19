<x-app-layout>
    @include('settings-menu')


    <div class="w-[600px] p-6">


        {{-- nice looking header title--}}

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-white">Channels</h2>

        </div>



        @foreach ($channels as $channel)
            <form class="bg-gray-800 p-4 rounded-lg flex items-center justify-between mb-4 shadow-sm" action="{{ route('settings.channel.install', $channel->className) }}" method="POST">
                @csrf
                <div class="flex items-center">
                    <i class="{{ $channel->icon }} text-blue-500 mr-4 fa-3x fa-fw"></i>
                    <div>
                        <h5 class="text-lg font-medium text-white">{{ $channel->name }}</h5>
                        <p class="text-gray-400">{{ $channel->description }}</p>
                    </div>
                </div>
                <button  type="submit"
                class=" text-white font-bold py-2 px-4 rounded {{ $channel->status == 1 ? 'bg-red-500 hover:bg-red-700' : 'bg-blue-500 hover:bg-blue-700' }}">
                {{ $channel->status == 1 ? 'Uninstall' : 'Install' }}
                </button>
            </form>
        @endforeach



    </div>






</x-app-layout>
