@extends('layouts.app')

@section('title', __('pages.my_profile.title'))
@section('breadcrumbs', Breadcrumbs::render('profile.index'))

@section('content')
    <div class="bg-white p-4 rounded-xl shadow-xl flex flex-col">
        <form action="{{ route('profile.save') }}" id="profileForm" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-2">
                <h2 class="text-xl font-bold">@lang('pages.my_profile.content.form.title')</h2>
                <p class="text-base">@lang('pages.my_profile.content.form.description')</p>
            </div>

            <div class="flex flex-col gap-2">
                <h2 class="text-xl font-bold">@lang('pages.my_profile.content.form.personal_data')</h2>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col gap-2 justify-between md:gap-10 md:flex-row">
                        <div class="form-control w-full">
                            <label
                                class="text-sm font-semibold">@lang('pages.my_profile.content.form.firstName.label')</label>
                            <input
                                type="text"
                                name="firstName"
                                class="input input-bordered w-full input-primary font-medium @error('firstName') input-error @enderror @error('firstName') input-error @enderror"
                                placeholder="@lang('pages.my_profile.content.form.firstName.placeholder')"
                                value="{{ $user->firstName }}"
                            >
                            @error('firstName')
                                <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-control w-full">
                            <label
                                class="text-sm font-semibold">@lang('pages.my_profile.content.form.lastName.label')</label>
                            <input
                                type="text"
                                name="lastName"
                                class="input input-bordered w-full input-primary font-medium @error('lastName') input-error @enderror"
                                placeholder="@lang('pages.my_profile.content.form.lastName.placeholder')"
                                value="{{ $user->lastName }}"
                            >
                            @error('lastName')
                                <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="text-sm font-semibold">@lang('pages.my_profile.content.form.email.label')</label>
                        <input
                            type="text"
                            name="email"
                            class="input input-bordered w-full input-primary font-medium @error('email') input-error @enderror"
                            placeholder="@lang('pages.my_profile.content.form.email.placeholder')"
                            value="{{ $user->email }}"
                        >
                        @error('email')
                            <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="text-sm font-semibold">@lang('pages.my_profile.content.form.phone.label')</label>
                        <input type="text"
                                 name="phone"
                               class="input input-bordered input-primary font-medium @error('phone') input-error @enderror w-full"
                               placeholder="@lang('pages.my_profile.content.form.phone.placeholder')"
                               value="{{ $user->phone }}">
                        @error('phone')
                            <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2 justify-between md:gap-10 md:flex-row">
                        <div class="form-control w-full">
                            <label
                                class="text-sm font-semibold">@lang('pages.my_profile.content.form.password.label')</label>
                            <input
                                type="text"
                                name="password"
                                class="input input-bordered w-full input-primary font-medium @error('password') input-error @enderror"
                                placeholder="@lang('pages.my_profile.content.form.password.placeholder')"
                            >
                            @error('password')
                                <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-control w-full">
                            <label
                                class="text-sm font-semibold">@lang('pages.my_profile.content.form.password_confirmation.label')</label>
                            <input
                                type="text"
                                name="passwordConfirmation"
                                class="input input-bordered w-full input-primary font-medium @error('passwordConfirmation') input-error @enderror"
                                placeholder="@lang('pages.my_profile.content.form.password_confirmation.placeholder')"
                            >
                            @error('passwordConfirmation')
                                <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <h2 class="text-xl font-bold">@lang('pages.my_profile.content.form.address.label')</h2>
                <div class="flex flex-col gap-2">
                    <div class="form-control">
                        <label class="text-sm font-semibold">@lang('pages.my_profile.content.form.country.label')</label>
                        <select name="country" id="country" class="input select-primary font-medium w-full @error('country') input-error @enderror">
                                <option value="" @if(empty($user->country)) selected @endif>@lang('pages.my_profile.content.form.country.placeholder')</option>

                            @foreach($countries as $country)
                                <option value="{{ $country->id }}"
                                        @if($user->country === $country->id) selected @endif>{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="text-sm font-semibold">@lang('pages.my_profile.content.form.city.label')</label>
                        <input type="text"
                               name="city"
                               placeholder="@lang('pages.my_profile.content.form.city.placeholder')"
                               class="input input-bordered w-full input-primary font-medium @error('city') input-error @enderror" value="{{ $user->city }}">
                        @error('city')
                            <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="text-sm font-semibold">@lang('pages.my_profile.content.form.zipCode.label')</label>
                        <input type="text"
                               name="zipCode"
                               placeholder="@lang('pages.my_profile.content.form.zipCode.placeholder')"
                               class="input input-bordered w-full input-primary font-medium @error('zipCode') input-error @enderror" value="{{ $user->zipCode }}">
                        @error('zipCode')
                            <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="text-sm font-semibold">@lang('pages.my_profile.content.form.address.label')</label>
                        <input type="text"
                               name="address"
                               placeholder="@lang('pages.my_profile.content.form.address.placeholder')"
                               class="input input-bordered w-full input-primary font-medium @error('address') input-error @enderror" value="{{ $user->address }}">
                        @error('address')
                            <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <h2 class="text-xl font-bold">@lang('pages.my_profile.content.form.avatar.label')</h2>
                <div class="flex flex-col gap-2 justify-between md:gap-10 md:flex-row">
                    <div class="form-control w-full">
                        <label class="text-sm font-semibold">@lang('pages.my_profile.content.form.avatar.label')</label>
                        <input type="file" id="avatarUpload" accept="image/png, image/jpeg, image/jpg"
                               name="avatar" class="file-input file-input-bordered file-input-primary w-full @error('avatar') input-error @enderror" />
                        @error('avatar')
                            <div class="text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-control w-full">
                        <label class="text-sm font-semibold">@lang('pages.my_profile.content.form.avatar_preview')</label>
                        <img id="avatarPreview" data-src="{{ asset('images/users/' . $user->avatar) }}" class="aspect-square max-w-[300px] w-full m-auto object-contain lazy-image" alt="@lang('pages.my_profile.content.form.avatar_preview')">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-3 pt-3 border-t border-t-primary">
                <button type="reset" class="btn btn-error">@lang('pages.my_profile.content.form.reset')</button>
                <button type="submit" class="btn btn-primary">@lang('pages.my_profile.content.form.submit')</button>
            </div>
        </form>
    </div>

    <script>
        const avatarUpload = document.getElementById('avatarUpload');
        const avatarPreview = document.getElementById('avatarPreview');
        const profileForm = document.getElementById('profileForm');

        profileForm.addEventListener('reset', () => {
            avatarPreview.src = '{{ asset('images/users/' . $user->avatar) }}';
        });

        avatarUpload.addEventListener('change', () => {
            const file = avatarUpload.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                avatarPreview.src = reader.result;
            });

            reader.readAsDataURL(file);
        });
    </script>
@endsection
