<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" name="name" type="text"
                          class="mt-1 block w-full"
                          :value="old('name', $user->name)"
                          required autofocus autocomplete="name" maxlength="255"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" name="email" type="email"
                          class="mt-1 block w-full"
                          :value="old('email', $user->email)"
                          required autocomplete="username" maxlength="255"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
        </div>

        <div>
            <x-input-label for="birthday" value="Verjaardag"/>
            <x-text-input id="birthday" name="birthday" type="date"
                          class="mt-1 block w-full"
                          :value="old('birthday', $user->birthday)"
                          max="{{ date('Y-m-d') }}"/>
            <x-input-error class="mt-2" :messages="$errors->get('birthday')"/>
        </div>

        <div>
            <x-input-label for="about_me" value="Over mij"/>
            <textarea id="about_me" name="about_me"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                {{ old('about_me', $user->about_me) }}
            </textarea>
            <x-input-error class="mt-2" :messages="$errors->get('about_me')"/>
        </div>

        <div>
            <x-input-label for="profile_picture" value="Profielfoto"/>

            @if($user->profilePictureUrl())
                <div class="mt-3 mb-4 flex items-center gap-4">
                    <img src="{{ $user->profilePictureUrl() }}"
                         class="w-24 h-24 rounded-full object-cover ring-2 ring-indigo-100 shrink-0"
                         alt="Huidige profielfoto">
                    <p class="text-sm text-gray-500">Huidige profielfoto. Kies een nieuw bestand om te vervangen.</p>
                </div>
            @endif

            <input id="profile_picture" name="profile_picture" type="file" accept="image/jpeg,image/png,image/webp"
                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"/>

            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
