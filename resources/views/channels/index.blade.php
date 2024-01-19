<x-app-layout>


    @include('channels/navigation' , ['channel' => $channel])


    <div class="flex flex-col items-center justify-center h-full w-full">
        <div class="flex flex-col items-center justify-center">
            <i class="fas fa-sms text-gray-200 mr-4 fa-10x fa-fw"></i>
            <h1 class="text-4xl font-medium mt-8">SMS</h1>
            <p class="text-gray-600 mt-2">All your SMS in one place</p>
        </div>
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-8">
            Get Started
        </a>
    </div>


</x-app-layout>
