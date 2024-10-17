@extends('layouts.app')
@section('title', 'Data Jadwal Pembayaran '.$loan->Member->name)
@section('content')
    <div
        class="max-w-full md:max-w-none rounded-[30px] md:rounded-none px-4 md:px-[22px] min-w-0 min-h-screen bg-slate-100 flex-1 md:pt-20 pb-10 mt-5 md:mt-1 relative dark:bg-darkmode-700 before:content-[''] before:w-full before:h-px before:block">
        <h2 class="intro-y mt-10 text-lg font-medium">Data Jadwal Pembayaran {{ $loan->Member->name }}</h2>
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table data-tw-merge="" class="w-full text-left -mt-2 border-separate border-spacing-y-[10px]">
                    <thead data-tw-merge="" class="">
                        <tr data-tw-merge="" class="">
                            <th data-tw-merge=""
                                class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0">
                                NAMA PEMINJAM
                            </th>
                            <th data-tw-merge=""
                                class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0">
                                NOMINAL PEMBAYARAN
                            </th>
                            <th data-tw-merge=""
                                class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0">
                                TANGGAL PEMBAYARAN
                            </th>
                            <th data-tw-merge=""
                                class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0">
                                STATUS
                            </th>
                            <th data-tw-merge=""
                                class="font-medium px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-center">
                                AKSI
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($installments as $installment)
                            <tr data-tw-merge="" class="intro-x">
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                    <a class="whitespace-nowrap font-medium" href="#">
                                        {{ $installment->no_installment }}
                                    </a>
                                    <div class="mt-0.5 whitespace-nowrap text-xs text-slate-500">
                                        Nama : {{ $loan->Member->name }}
                                    </div>
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                    Rp.{{ number_format($installment->installment_amount, 2) }}
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                    {{ \Carbon\Carbon::parse( $installment->installment_date)->format('Y-m-d') }}
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600">
                                    @if ($installment->is_paid)
                                        <span style="color: green;">Paid</span>
                                    @else
                                        <span style="color: red;">Unpaid</span>
                                    @endif
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box w-56 rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600 before:absolute before:inset-y-0 before:left-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 before:dark:bg-darkmode-400">
                                    <div class="flex items-center justify-center">
                                        @if (!$installment->is_paid)
                                            <form action="{{ route('loans.payInstallment', $installment->id) }}" method="POST">
                                                @csrf
                                                <button type="submit">Pay Now</button>
                                            </form>
                                        @else
                                            <button disabled>Paid</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
