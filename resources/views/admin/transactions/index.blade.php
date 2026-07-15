<x-app-layout>
    <x-slot name="header">Subscriptions</x-slot>

    <div class="card">
        <div style="padding: 20px 24px 0; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--card-border); padding-bottom: 16px;">
            <div>
                <h2 style="font-weight: 700; font-size: 15px;">All Transactions</h2>
                <p style="font-size: 12px; color: var(--text-soft); margin-top: 3px;">Manage & approve student subscriptions</p>
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--gold-soft); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; color: var(--gold-deep);">
                                    {{ strtoupper(substr($transaction->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 600; font-size: 14px;">{{ $transaction->user->name ?? '—' }}</div>
                                    <div style="font-size: 12px; color: var(--text-soft);">{{ $transaction->user->email ?? '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="font-weight: 700; font-size: 15px;">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span style="font-size: 13px; color: var(--text-mid);">{{ $transaction->created_at->format('d M Y') }}</span>
                        </td>
                        <td>
                            @if($transaction->is_paid)
                                <span class="badge badge-green">✓ Active</span>
                            @else
                                <span class="badge badge-amber">⏳ Pending</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.subscribe_transactions.show', $transaction) }}"
                               class="btn btn-ghost" style="padding: 8px 18px; font-size: 13px;">
                                View →
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 60px; color: var(--text-soft);">
                            <div style="font-size: 36px; margin-bottom: 10px;">💳</div>
                            <p>Belum ada transaksi.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
