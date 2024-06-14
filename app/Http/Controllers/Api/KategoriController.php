<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use App\Models\Kategori;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return KategoriResource::collection(Kategori::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $kategoriNew = Kategori::create($request->all());
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        DB::commit();
        return new KategoriResource($kategoriNew);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return new KategoriResource($kategori);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        DB::beginTransaction();
        try {
             $kategori->update($request->all());
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        DB::commit();
        return new KategoriResource($kategori);
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
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        DB::commit();
        return response()->json(['status' => "Kategori berhasil dihapus"]);
    }
}
