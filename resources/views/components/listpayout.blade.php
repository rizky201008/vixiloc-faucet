@php
    $no = 1;
@endphp
<center><h1>Last Payouts</h1></center>
<div class="table-responsive p-3">
    <table class="table table-info">
        <thead>
            <th>#</th>
            <th>Address</th>
            <th>Crypto</th>
            <th>Date & Time (UTC)</th>
        </thead>
        <tbody>
            @foreach ($payout as $payouts)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $payouts->address }}</td>
                    <td>{{ $payouts->crypto }}</td>
                    <td>{{ $payouts->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $payout->links() }}
</div>
