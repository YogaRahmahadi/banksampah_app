<?php

namespace App\Http\Controllers\Pengepul;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Transaksi;
use App\Models\Penyetor;
use App\Models\Pengepul;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('pengepul'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pengepul = Pengepul::all()->pluck('name', 'id');
        $pid = Pengepul::where('users_id', Auth::id())->first();
        $transaksis = Transaksi::where('pengepul_id', $pid->id)->get();

        return view('user.pengepul.index', compact('pengepul', 'transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($penyetor)
    {
        $penyetor = Penyetor::where('id', $penyetor)->first();
        return view('user.pengepul.show', compact('penyetor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        abort_if(Gate::denies('pengepul'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tambah = 1;
        
        if ($transaksi->status <= 2) {
            $transaksi->update([
            'status' => $transaksi->status + 1,
        ]);
        }
        
        return redirect()->route('pengepul.transaksis.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
