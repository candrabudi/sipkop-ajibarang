<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return view('loans.index', ['loans' => Loan::all()]);
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_anggota' => 'required',
            'kode_jenis_pinjam' => 'required',
            'besar_pinjam' => 'required|numeric',
            'lama_pinjam' => 'required',
            'bunga' => 'required|numeric',
        ]);
        
        Loan::create($validatedData);
        return redirect()->route('loans.index');
    }

    public function edit($id)
    {
        $loan = Loan::find($id);
        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_anggota' => 'required',
            'kode_jenis_pinjam' => 'required',
            'besar_pinjam' => 'required|numeric',
            'lama_pinjam' => 'required',
            'bunga' => 'required|numeric',
        ]);

        $loan = Loan::find($id);
        $loan->update($validatedData);

        return redirect()->route('loans.index');
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);
        $loan->delete();
        return redirect()->route('loans.index');
    }
}
