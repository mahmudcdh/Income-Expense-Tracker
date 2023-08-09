<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Exception;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function expensePage(){
        return view('expense.ExpensePage');
    }

    public function expenseList(){
        $expenses = auth()->user()->expenses()->get();
        return response()->json($expenses, 200);
    }

    public function expenseAdd(Request $request){
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
        ]);
        try{
            auth()->user()->expenses()->create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Expenses created successfully'
            ], 200);
        }
        catch (Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something went wrong..!'
            ], 200);
        }
    }

    public function expenseUpdate(Request $request, Expense $expense){
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
        ]);

        try{
            $expense->update($validatedData);
            return response()->json([
                'status'=>'success',
                'message' => 'Expense updated successfully'
            ], 200);
        }
        catch (Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'Something went wrong..!'
            ], 200);
        }

    }

    public function expenseDelete(Expense $expense){
        try{
            $expense->delete();
            return response()->json([
                'status'=>'success',
                'message' => 'Deleted successfully..!'
            ], 200);
        }
        catch (Exception $e){
            return response()->json([
                'status'=>'fail',
                'message' => 'Something went wrong..!'
            ], 200);
        }
    }
}
