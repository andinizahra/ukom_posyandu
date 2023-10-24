<?php

namespace App\Http\Controllers;

use App\Models\CatatanImunisasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CatatanImunisasiController extends Controller
{
    public function index()
    {
        $data = [
            'catatan_imunisasi' => CatatanImunisasi::all()
        ];

        return view('dashboard.catatan_imunisasi.index', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'catatan_imunisasi' => ['required', 'max:40']
        ]);

        if ($data) {
            if ($request->input('id') !== null) {
                // TODO: Update catatan imunisasi
                $catatan_imunisasi = CatatanImunisasi::query()->find($request->input('id'));
                $catatan_imunisasi->fill($data);
                $catatan_imunisasi->save();

                return response()->json([
                    'message' => 'Catatan Imunisasi berhasil diupdate!'
                ], 200);
            }

            $dataInsert = CatatanImunisasi::create($data);
            if ($dataInsert) {
                return redirect()->to('/dashboard/catatan_vaksin/catatan_imunisasi')->with('success', 'Catatan Vaksin berhasil ditambah');
            }
        }

        return redirect()->to('/dashboard/catatan_vaksin/catatan_imunisasi')->with('error', 'Gagal tambah data');
    }

    public function delete(int $id): JsonResponse
    {
        $catatan_imunisasi = CatatanImunisasi::query()->find($id)->delete();

        if ($catatan_imunisasi):
            //Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan' => 'Data user berhasil dihapus'
            ];
        else:
            //Pesan Gagal
            $pesan = [
                'success' => false,
                'pesan' => 'Data gagal dihapus'
            ];
        endif;
        return response()->json($pesan);
    }
}
