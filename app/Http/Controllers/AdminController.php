<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Ingredient;
use App\Models\Measurement;
use App\Models\Menu;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index()
    {
        Gate::authorize('admin-page');

        $dailyIncomes = Transaction::whereDate('created_at', Carbon::today())->sum('transaction_total');
        $dailySales = Transaction::whereDate('created_at', Carbon::today())->count();
        $totalIncomes = Transaction::sum('transaction_total');
        $totalSales = Transaction::count();
        // dd($totalSales);

        return view('admin.index3', [
            'dailyIncomes' => $dailyIncomes,
            'dailySales' => $dailySales,
            'totalIncomes' => $totalIncomes,
            'totalSales' => $totalSales
        ]);
    }

    public function employeePage()
    {
        Gate::authorize('admin-page');

        $employees = Employee::paginate(10);

        return view('admin.employee', [
            'employees' => $employees,
        ]);
    }

    public function ingredientPage()
    {
        Gate::authorize('admin-page');

        $ingredients = Ingredient::with(['measurement'])->paginate(10);
        $measurements = Measurement::all();

        return view('admin.ingredient', [
            'ingredients' => $ingredients,
            'measurements' => $measurements,
        ]);
    }

    public function restockPage()
    {
        Gate::authorize('admin-page');

        $ingredients = Ingredient::with(['measurement'])->paginate(10);

        return view('admin.restock', [
            'ingredients' => $ingredients,
        ]);
    }

    public function menuPage()
    {
        Gate::authorize('admin-page');

        $menus = Menu::with(['ingredients'])->paginate(10);

        return view('admin.menu', [
            'menus' => $menus,
        ]);
    }

    public function editMenu(Menu $menu)
    {
        Gate::authorize('admin-page');

        $ingredients = Ingredient::whereNotIn('id', function ($query) use ($menu) {
            $query->select('ingredient_id')
                ->from('ingredient_menu')
                ->where('menu_id', '=', $menu->id)
                ->get();
        })->get();

        return view('admin.edit-menu', [
            'menu' => $menu,
            'ingredients' => $ingredients,
        ]);
    }

    public function kasirPage()
    {
        Gate::authorize('admin-page');

        $menus = Menu::all();

        return view('admin.kasir', [
            'menus' => $menus,
        ]);
    }

    public function transactionPage()
    {
        Gate::authorize('admin-page');

        $transactions = Transaction::paginate(10);

        return view('admin.transaksi', [
            'transactions' => $transactions,
        ]);
    }

    public function detailTransaksi(Transaction $transaction)
    {
        Gate::authorize('admin-page');

        return view('admin.detail-transaksi', [
            'transaction' => $transaction,
        ]);
    }
}