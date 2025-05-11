@extends('client')
@section('styles')
<style>
<style>
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --light-color: #ecf0f1;
    --dark-color: #2c3e50;
    --success-color: #2ecc71;
}

.section-title {
    font-size: 22px;
    margin-bottom: 20px;
    color: var(--primary-color);
    display: flex;
    align-items: center;
}

.section-title i {
    margin-right: 10px;
}

.btn {
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 14px;
}

.btn-primary {
    background-color: var(--secondary-color);
    color: white;
}

.btn-primary:hover {
    background-color: #2980b9;
}

.transaction-table {
    width: 100%;
    border-collapse: collapse;
}

.transaction-table th, .transaction-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.transaction-table th {
    background-color: var(--light-color);
    font-weight: 600;
}

.transaction-table tr:hover {
    background-color: #f9f9f9;
}

.transaction-amount.credit {
    color: var(--success-color);
}

.transaction-amount.debit {
    color: var(--accent-color);
}

.transaction-status {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.status-completed {
    background-color: #d4edda;
    color: #155724;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
}


.tab-content.active {
    display: block;
}
</style>
</style>
@endsection
@section('content')
<div id="transactions" class="tab-content">
    <h2 class="section-title"><i class="fas fa-exchange-alt"></i> Transaction History</h2>

    <div class="filters" style="margin-bottom: 20px; display: flex; gap: 15px;">
        <select class="btn" style="padding: 8px 15px;">
            <option>All Accounts</option>
            <option>Primary Account</option>
            <option>Savings Account</option>
            <option>Investment Account</option>
        </select>
        <select class="btn" style="padding: 8px 15px;">
            <option>Last 30 Days</option>
            <option>Last 60 Days</option>
            <option>Last 90 Days</option>
            <option>This Year</option>
            <option>All Time</option>
        </select>
        <select class="btn" style="padding: 8px 15px;">
            <option>All Transactions</option>
            <option>Credits Only</option>
            <option>Debits Only</option>
        </select>
        <button class="btn btn-primary"><i class="fas fa-filter"></i> Apply</button>
    </div>

    <table class="transaction-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Compte</th>
                <th>Montant</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jun 15, 2023</td>
                <td>Grocery Store</td>
                <td>Primary</td>
                <td class="transaction-amount debit">-$125.50</td>
                <td><span class="transaction-status status-completed">Completed</span></td>
            </tr>
            <tr>
                <td>Jun 14, 2023</td>
                <td>Salary Deposit</td>
                <td>Primary</td>
                <td class="transaction-amount credit">+$3,500.00</td>
                <td><span class="transaction-status status-completed">Completed</span></td>
            </tr>
            <tr>
                <td>Jun 12, 2023</td>
                <td>Online Shopping</td>
                <td>Primary</td>
                <td class="transaction-amount debit">-$89.99</td>
                <td><span class="transaction-status status-completed">Completed</span></td>
            </tr>
            <tr>
                <td>Jun 10, 2023</td>
                <td>Utility Bill Payment</td>
                <td>Primary</td>
                <td class="transaction-amount debit">-$220.75</td>
                <td><span class="transaction-status status-pending">Pending</span></td>
            </tr>
            <tr>
                <td>Jun 8, 2023</td>
                <td>Transfer to Friend</td>
                <td>Primary</td>
                <td class="transaction-amount debit">-$200.00</td>
                <td><span class="transaction-status status-completed">Completed</span></td>
            </tr>
            <tr>
                <td>Jun 5, 2023</td>
                <td>Dividend Payment</td>
                <td>Investment</td>
                <td class="transaction-amount credit">+$150.25</td>
                <td><span class="transaction-status status-completed">Completed</span></td>
            </tr>
            <tr>
                <td>Jun 3, 2023</td>
                <td>Monthly Savings</td>
                <td>Savings</td>
                <td class="transaction-amount credit">+$500.00</td>
                <td><span class="transaction-status status-completed">Completed</span></td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 20px; text-align: center;">
        <button class="btn" style="margin-right: 10px;"><i class="fas fa-chevron-left"></i> Previous</button>
        <button class="btn btn-primary">Next <i class="fas fa-chevron-right"></i></button>
    </div>
</div>
@endsection
