<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rating') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full h-[600px]">
                    <h4 class="pb-3 font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Rating Data') }}
                    </h4>
                    @if (session()->has('success'))
                        <x-success-alert>
                            {{ session('success') }}
                        </x-success-alert>
                    @endif
                    <table class="border-collapse border-slate-500 mt-3 w-full">
                        <thead class="bg-gray-900 text-white">
                            <tr>
                                <th class="px-6 py-2 border font-light border-slate-600">No</th>
                                <th class="px-6 py-2 border font-light border-slate-600">Content</th>
                                <th class="px-6 py-2 border font-light border-slate-600">Star</th>
                                <th class="px-6 py-2 border font-light border-slate-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-slate-200">
                            @if ($datas->count() > 0)
                                @foreach ($datas as $data)
                                    <tr class="text-gray-900">
                                        <td class="px-6 py-2 border border-slate-700">{{ $data->user_id }}</td>
                                        <td class="px-6 py-2 border border-slate-700">{{ $data->content }}</td>
                                        <td class="px-6 py-2 border border-slate-700">{{ $data->star }}</td>
                                        <td class="px-6 py-2 border border-slate-700">
                                            @if (Auth::user()->id == $data->user_id)
                                                <x-link-small-button :url="url('/rating/' . $data->id . '/edit')">
                                                    {{ __('Edit') }}
                                                </x-link-small-button>
                                                <form action="/rating/{{ $data->id }}/delete" method="post"
                                                    class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <x-delete-button :message="$data->user_id">
                                                        Delete
                                                    </x-delete-button>
                                                </form>
                                            @else
                                                <span class="pb-3 font-semibold text-base text-red-500 leading-tight">
                                                    {{ __('No Access.') }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h4 class="pb-3 font-semibold text-base text-red-500 leading-tight">
                                    {{ __('No Ratings Yet.') }}
                                </h4>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
