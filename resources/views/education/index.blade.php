<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Education') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <x-link-primary-button :url="route('education.create')" class="bg-green-600 font-thin">{{ __('Add New Education') }}</x-link-primary-button>
                </div>
                @if (session()->has('success'))
                    <x-success-alert>
                        {{ session('success') }}
                    </x-success-alert>
                @endif
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full h-[500px]">
                    <h4 class="pb-3 font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Education Data') }}
                    </h4>
                    <table class="border-collapse border-slate-500 w-full">
                        <thead class="bg-gray-900 text-white">
                            <tr>
                                <th class="px-6 py-2 border font-light border-slate-600">Degree</th>
                                <th class="px-6 py-2 border font-light border-slate-600">Field of Study</th>
                                <th class="px-6 py-2 border font-light border-slate-600">Education</th>
                                <th class="px-6 py-2 border font-light border-slate-600">Graduation Year</th>
                                <th class="px-6 py-2 border font-light border-slate-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-slate-200">
                            @if ($educations->count() > 0)
                                @foreach ($educations as $data)
                                    <tr class="text-gray-900">
                                        <td class="px-6 py-2 border border-slate-700">{{ $data->degree }}</td>
                                        <td class="px-6 py-2 border border-slate-700">{{ $data->field_of_study }}</td>
                                        <td class="px-6 py-2 border border-slate-700">{{ $data->education_name }}</td>
                                        <td class="px-6 py-2 border border-slate-700">{{ $data->graduation_year }}</td>
                                        <td class="px-6 py-2 border border-slate-700">
                                            <x-link-small-button :url="url('/education/' . $data->id . '/edit')" class=" w-[75px] h-[30px] mb-2">
                                                {{ __('Edit') }}
                                            </x-link-small-button>
                                            <form action="/education/{{ $data->id }}/delete" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <x-delete-button :message="$data->degree" class=" w-[75px] h-[30px] bg-red-600 ">
                                                    Delete
                                                </x-delete-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h4 class="pb-3 font-semibold text-base text-red-500 leading-tight">
                                    {{ __('You dont have a Education yet.') }}
                                </h4>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
