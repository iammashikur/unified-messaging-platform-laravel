<x-app-layout>
    @include('settings-menu')


    <div class="p-4 sm:px-8 h-full bg-gray-900 w-full">
        <div class="w-[600px]">


            {{-- nice looking header title--}}

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-white">Profile</h2>

            </div>



            <div class="bg-gray-800 shadow-md rounded-lg p-6">

                {{-- Edit Form --}}
                <form action="" method="POST">

                    {{-- profile photo with preview--}}
                    <div class="mb-4">
                        <label for="photo" class="block text-gray-300 font-medium mb-2">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-input w-full">
                        <img src="" alt="profile photo" class="mt-2 rounded-full h-20 w-20 object-cover">
                    </div>

                    {{-- Name --}}
                    <div class="mb-4">
                        <label for="name" class="block text-gray-300 font-medium mb-2">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="form-input w-full bg-gray-700 text-white">
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-gray-300 font-medium mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="form-input w-full bg-gray-700 text-white">
                    </div>

                    {{-- Phone --}}
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-300 font-medium mb-2">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" class="form-input w-full bg-gray-700 text-white">
                    </div>

                    {{-- Submit Button --}}
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</x-app-layout>
