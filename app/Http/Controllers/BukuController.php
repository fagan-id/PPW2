<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Bus;

class BukuController extends Controller
{

    /**
     * Inisiasi instansi BukuController
     */
    public function __construct()
    {
        $this->middleware('admin')->except([
            'index','search',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Paginator::useBootstrapFive();
        $cari = '';
        $data_buku = Buku::orderBy('id', 'asc')->paginate(10); // sort by newest added
        $rowCount = Buku::count(); // total data
        $totalPrice = Buku::sum('harga'); // total harga
        return view('buku.buku2', compact('data_buku', 'rowCount', 'totalPrice', 'cari')); // compact() digunakan untuk passing variabel

    }
    // $data_buku = Buku::all()->sortByDesc('id');
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'photo' => 'nullable|image|max:1999'
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $request->file('photo')->storeAs('public',$filenameSimpan);
            // $request->file('photo')->storeAs('photo',$filenameSimpan);
        }

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->photo = $filenameSimpan ?? null;
        $buku->save();

        // Buku::create([
        //     'judul' => $request->judul,
        //     'penulis' => $request->penulis,
        //     'harga' => $request->harga,
        //     'tgl_terbit' => $request->tgl_terbit,
        //     'photo' => $request->photo
        // ]);

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::find($id);
        return view('buku.update', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'photo' => 'nullable|image|max:1999'
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $request->file('photo')->storeAs('public',$filenameSimpan);
            // $request->file('photo')->storeAs('photo',$filenameSimpan);
        }


        $buku = Buku::findOrFail($id);
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->photo = $filenameSimpan ?? null;
        $buku->save();

        return redirect('/buku')->with('success', 'Data Buku Berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku')->with('deleted', 'Berhasil Menghapus Data Buku!');
    }

    /**
     * Searching
     */
    public function search(Request $request)
    {

        Paginator::useBootstrapFive();
        $cari = $request->kata;

        $data_buku = Buku::where('judul', 'like', "%" . $cari . '%')
            ->orWhere('penulis', 'like', '%' . $cari . '%')->paginate(5);
        // $data_buku = Buku::where('judul','like','%',$cari.'%')->paginate(5);
        $rowCount = Buku::count(); // total data
        $totalPrice = Buku::sum('harga'); // total harga

        $jumlah_buku = $data_buku->count();
        return view('buku.buku2', compact('data_buku', 'cari', 'rowCount', 'totalPrice'));
    }
}
