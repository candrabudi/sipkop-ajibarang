@extends('layouts.app')
@section('content')
    <div
        class="max-w-full md:max-w-none rounded-[30px] md:rounded-none px-4 md:px-[22px] min-w-0 min-h-screen bg-slate-100 flex-1 md:pt-20 pb-10 mt-5 md:mt-1 relative dark:bg-darkmode-700 before:content-[''] before:w-full before:h-px before:block">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 2xl:col-span-12">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 mt-8">
                        <div class="intro-y flex h-10 items-center">
                            <h2 class="mr-5 truncate text-lg font-medium">General Report</h2>
                        </div>
                        <div class="mt-5 grid grid-cols-12 gap-6">
                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                                <div
                                    class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                                    <div class="box p-5">
                                        <div class="mt-6 text-3xl font-medium leading-8">{{ $totalMember }}</div>
                                        <div class="mt-1 text-base text-slate-500">Total Member</div>
                                    </div>
                                </div>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                                <div
                                    class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                                    <div class="box p-5">
                                        <div class="mt-6 text-3xl font-medium leading-8">{{ $totalDeposit }}</div>
                                        <div class="mt-1 text-base text-slate-500">Total Deposit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                                <div
                                    class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                                    <div class="box p-5">
                                        <div class="mt-6 text-3xl font-medium leading-8">{{ $totalWithdraw }}</div>
                                        <div class="mt-1 text-base text-slate-500">
                                            Total Withdraw
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                                <div
                                    class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                                    <div class="box p-5">
                                        <div class="mt-6 text-3xl font-medium leading-8">{{ $totalSaving }}</div>
                                        <div class="mt-1 text-base text-slate-500">
                                            Total Tabungan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-span-12 2xl:col-span-12">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 mt-8">
                        <div class="intro-y flex h-10 items-center">
                            <h2 class="mr-5 truncate text-lg font-medium">Statistic Report</h2>
                        </div>
                        <div class="mt-5 grid grid-cols-12 gap-6">
                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                                <div class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                                    <div class="box p-5 min-h-[500px] h-full">
                                        <canvas id="loanStatusChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- Box 2 -->
                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                                <div class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                                    <div class="box p-5 min-h-[500px] h-full">
                                        <canvas id="loanTypeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- Box 3 -->
                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                                <div class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                                    <div class="box p-5 min-h-[500px] h-full">
                                        <div class="mt-6 text-3xl font-medium leading-8">2.149</div>
                                        <div class="mt-1 text-base text-slate-500">
                                            <canvas id="avgInterestRateChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Box 4 -->
                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                                <div class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                                    <div class="box p-5 min-h-[500px] h-full">
                                        <div class="mt-6 text-3xl font-medium leading-8">2.149</div>
                                        <div class="mt-1 text-base text-slate-500">
                                            <canvas id="installmentStatusChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('loanStatusChart').getContext('2d');
        var loanStatusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Approved', 'Rejected'],
                datasets: [{
                    label: 'Total Loans by Status',
                    data: @json($loanStatusData->values()),
                    backgroundColor: ['#FFCE56', '#36A2EB', '#FF6384']
                }]
            }
        });
    </script>
    <script>
        var ctx2 = document.getElementById('loanTypeChart').getContext('2d');
        var loanTypeChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json(array_keys($loanTypeData->toArray())),
                datasets: [{
                    label: 'Total Loans by Loan Type',
                    data: @json($loanTypeData->values()),
                    backgroundColor: '#36A2EB'
                }]
            }
        });
    </script>
    <script>
        var ctx3 = document.getElementById('avgInterestRateChart').getContext('2d');
        var avgInterestRateChart = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: @json(array_keys($avgInterestRateData->toArray())),
                datasets: [{
                    label: 'Average Interest Rate',
                    data: @json($avgInterestRateData->values()),
                    backgroundColor: '#FF6384',
                    borderColor: '#FF6384',
                    fill: false
                }]
            }
        });
    </script>
    <script>
        var ctx4 = document.getElementById('installmentStatusChart').getContext('2d');
        var installmentStatusChart = new Chart(ctx4, {
            type: 'pie',
            data: {
                labels: ['Unpaid', 'Paid'],
                datasets: [{
                    label: 'Installment Payment Status',
                    data: @json($installmentStatusData->values()),
                    backgroundColor: ['#FF6384', '#36A2EB']
                }]
            }
        });
    </script>
@endsection
