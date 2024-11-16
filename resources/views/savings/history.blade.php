@extends('layouts.app')
@section('title', 'Riwayat Tabungan Anggota')
@section('content')
    <div
        class="max-w-full md:max-w-none rounded-[30px] md:rounded-none px-4 md:px-[22px] min-w-0 min-h-screen bg-slate-100 flex-1 md:pt-20 pb-10 mt-5 md:mt-1 relative dark:bg-darkmode-700 before:content-[''] before:w-full before:h-px before:block">
        <h2 class="intro-y mt-10 text-lg font-medium">Riwayat Tabungan</h2>
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
                <div class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto md:ml-0">
                    <div class="relative w-56 text-slate-500">
                        <input data-tw-merge="" type="text" placeholder="Search..."
                            class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 !box w-56 pr-10">
                        <i data-tw-merge="" data-lucide="search"
                            class="stroke-1.5 absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4"></i>
                    </div>
                </div>
            </div>

            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table data-tw-merge="" class="w-full text-left -mt-2 border-separate border-spacing-y-[10px]">
                    <thead data-tw-merge="" class="">
                        <tr data-tw-merge="" class="">
                            <th data-tw-merge=""
                                class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0">
                                NOMINAL
                            </th>
                            <th data-tw-merge=""
                                class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0">
                                TANGGAL
                            </th>
                            <th data-tw-merge=""
                                class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0">
                                TIPE
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $hs)
                            <tr data-tw-merge="" class="intro-x">
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                    Rp {{ number_format($hs['amount'], 0, ',', '.') }}
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                    {{ \Carbon\Carbon::parse($hs['created_at'])->format('Y/m/d H:i:s') }}
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                    {{ $hs['type'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
