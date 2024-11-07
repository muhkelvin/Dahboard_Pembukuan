<?php

namespace Database\Seeders;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expense::create(['description' => 'Office Supplies', 'amount' => 49.99, 'expense_date' => Carbon::parse('2024-10-01')]);
        Expense::create(['description' => 'Electricity Bill', 'amount' => 120.00, 'expense_date' => Carbon::parse('2024-10-02')]);
        Expense::create(['description' => 'Internet Subscription', 'amount' => 59.99, 'expense_date' => Carbon::parse('2024-10-03')]);
        Expense::create(['description' => 'Office Rent', 'amount' => 500.00, 'expense_date' => Carbon::parse('2024-10-04')]);
        Expense::create(['description' => 'Employee Salary', 'amount' => 1500.00, 'expense_date' => Carbon::parse('2024-10-05')]);
        Expense::create(['description' => 'Marketing Expenses', 'amount' => 200.00, 'expense_date' => Carbon::parse('2024-10-06')]);
        Expense::create(['description' => 'Transportation Cost', 'amount' => 75.00, 'expense_date' => Carbon::parse('2024-10-07')]);
        Expense::create(['description' => 'Office Snacks', 'amount' => 30.00, 'expense_date' => Carbon::parse('2024-10-08')]);
        Expense::create(['description' => 'Software Subscription', 'amount' => 99.99, 'expense_date' => Carbon::parse('2024-10-09')]);
        Expense::create(['description' => 'Maintenance', 'amount' => 250.00, 'expense_date' => Carbon::parse('2024-10-10')]);
        // Tambahkan pengeluaran lain sesuai kebutuhan
    }
}
