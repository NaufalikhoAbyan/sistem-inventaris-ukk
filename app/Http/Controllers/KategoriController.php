<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Kategori/Index', [
            'kategori' => Kategori::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Kategori/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Kategori::create($request->all());
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        DB::commit();
        return redirect()->route('kategori.index')->with(['message', 'Kategori berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return inertia('Kategori/Show', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return inertia('Kategori/Edit', [
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'deskripsi' => ['string', 'required'],
            'kategori' => ['string', 'required']
        ]);
        $kategori->update($data);
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        DB::beginTransaction();
        try {
            $kategori->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        DB::commit();
        return redirect()->route('kategori.index');
    }
}
