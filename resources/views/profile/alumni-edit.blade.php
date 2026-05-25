<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Edit Alumni Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-8 sm:p-10">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">Profile Details</h3>

                    <form action="{{ route('alumni-profile.update') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Full Name -->
                        <div>
                            <x-input-label for="name" :value="__('Full Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Graduation Year -->
                            <div>
                                <x-input-label for="graduation_year" :value="__('Graduation Year')" />
                                <x-text-input id="graduation_year" name="graduation_year" type="number" class="mt-1 block w-full" :value="old('graduation_year', $user->alumniProfile->graduation_year ?? '')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('graduation_year')" />
                            </div>

                            <!-- Major -->
                            <div>
                                <x-input-label for="major" :value="__('Major')" />
                                <x-text-input id="major" name="major" type="text" class="mt-1 block w-full" :value="old('major', $user->alumniProfile->major ?? '')" placeholder="e.g. Computer Science" required />
                                <x-input-error class="mt-2" :messages="$errors->get('major')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Current Job Title -->
                            <div>
                                <x-input-label for="current_job_title" :value="__('Current Job Title')" />
                                <x-text-input id="current_job_title" name="current_job_title" type="text" class="mt-1 block w-full" :value="old('current_job_title', $user->alumniProfile->current_job_title ?? '')" placeholder="e.g. Senior Software Engineer" />
                                <x-input-error class="mt-2" :messages="$errors->get('current_job_title')" />
                            </div>

                            <!-- Current Company -->
                            <div>
                                <x-input-label for="current_company" :value="__('Current Company')" />
                                <x-text-input id="current_company" name="current_company" type="text" class="mt-1 block w-full" :value="old('current_company', $user->alumniProfile->current_company ?? '')" placeholder="e.g. Google" />
                                <x-input-error class="mt-2" :messages="$errors->get('current_company')" />
                            </div>
                        </div>

                        <!-- Skills -->
                        <div>
                            <x-input-label for="skills" :value="__('Skills (comma separated)')" />
                            <x-text-input id="skills" name="skills" type="text" class="mt-1 block w-full" :value="old('skills', $user->alumniProfile->skills ?? '')" placeholder="e.g. PHP, Laravel, React, SQL, Project Management" />
                            <x-input-error class="mt-2" :messages="$errors->get('skills')" />
                        </div>

                        <!-- Bio -->
                        <div>
                            <x-input-label for="bio" :value="__('Short Bio')" />
                            <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Tell other alumni about yourself...">{{ old('bio', $user->alumniProfile->bio ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                        </div>

                        <!-- LinkedIn URL -->
                        <div>
                            <x-input-label for="linkedin_url" :value="__('LinkedIn URL')" />
                            <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1 block w-full" :value="old('linkedin_url', $user->alumniProfile->linkedin_url ?? '')" placeholder="https://linkedin.com/in/username" />
                            <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
                        </div>

                        <!-- Is Mentor Checkbox -->
                        <div class="relative flex items-start p-4 rounded-xl bg-indigo-50/50 dark:bg-gray-700/30 border border-indigo-100/50 dark:border-gray-600">
                            <div class="flex items-center h-5">
                                <input id="is_mentor" name="is_mentor" type="checkbox" value="1" {{ old('is_mentor', $user->alumniProfile->is_mentor ?? false) ? 'checked' : '' }} class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300 rounded dark:bg-gray-900 dark:border-gray-700">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_mentor" class="font-bold text-gray-800 dark:text-gray-100">Offer Mentorship</label>
                                <p class="text-gray-500 dark:text-gray-400 text-xs">By checking this, you will appear in the Mentorship Hub and other alumni or students can request your guidance.</p>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end pt-4 border-t border-gray-100 dark:border-gray-700/50 space-x-3">
                            <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg font-semibold text-sm transition">Cancel</a>
                            <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold text-sm transition">Save Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
