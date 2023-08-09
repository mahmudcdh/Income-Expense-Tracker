<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function incomePage(){
        return view('income.IncomePage');
    }

    public function incomeList(){
        $incomes = auth()->user()->incomes()->get();
        return response()->json($incomes, 200);
    }

    public function addIncome(Request $request){
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);
        try{
            auth()->user()->incomes()->create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Income created successfully'
            ], 200);
        }
        catch (Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something went wrong..!'
            ], 200);
        }

    }

    public function updateIncome(Request $request, Income $income){
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        try{
            $income->update($validatedData);
            return response()->json([
                'status'=>'success',
                'message' => 'Income updated successfully'
            ], 200);
        }
        catch (Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'Something went wrong..!'
            ], 200);
        }

    }

    public function deleteIncome(Income $income){
        try{
            $income->delete();
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
