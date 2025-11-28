<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto text-white">

            {{-- PAGE HEADER --}}
            <h1 class="text-4xl font-bold mb-8">👤 My Profile</h1>

            <div class="space-y-10">

                {{-- PROFILE CARD --}}
                <div class="bg-gray-900 border border-gray-700 rounded-2xl p-8 shadow-xl">

                    <h2 class="text-2xl font-bold mb-1">Profile Information</h2>
                    <p class="text-gray-400 mb-6 text-sm">
                        Update your account’s information and email address.
                    </p>

                    @include('profile.partials.update-profile-information-form')

                </div>

                {{-- PASSWORD CARD --}}
                <div class="bg-gray-900 border border-gray-700 rounded-2xl p-8 shadow-xl">

                    <h2 class="text-2xl font-bold mb-1">Update Password</h2>
                    <p class="text-gray-400 mb-6 text-sm">
                        Ensure your account uses a secure password.
                    </p>

                    @include('profile.partials.update-password-form')

                </div>

                {{-- DELETE ACCOUNT --}}
                <div class="bg-gray-900 border border-gray-700 rounded-2xl p-8 shadow-xl">

                    <h2 class="text-2xl font-bold text-red-500 mb-1">Delete Account</h2>
                    <p class="text-gray-400 mb-6 text-sm">
                        Once your account is deleted, all data will be lost. Please download anything you want to keep.
                    </p>

                    @include('profile.partials.delete-user-form')

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
