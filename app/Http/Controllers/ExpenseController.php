<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::where('user_id', Auth::id())
            ->orderBy('date', 'desc');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }

        $expenses = $query->paginate(12);

        $totalIncome = Expense::where('user_id', Auth::id())
                        ->where('type', 'income')
                        ->sum('amount');

        $totalExpense = Expense::where('user_id', Auth::id())
                        ->where('type', 'expense')
                        ->sum('amount');

        return view('expenses.index', compact('expenses','totalIncome','totalExpense'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:income,expense',
            'title' => 'required|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'date' => 'required|date',
            'note' => 'nullable|string',
            'receipt' => 'nullable|image|max:2048',
        ]);

        $data['user_id'] = Auth::id();

        if ($request->hasFile('receipt')) {
            $data['receipt'] = $request->file('receipt')->store('receipts', 'public');
        }

        Expense::create($data);

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->receipt) {
            Storage::disk('public')->delete($expense->receipt);
        }

        $expense->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
