<?php

namespace App\Http\Controllers;

use App\Http\Requests\BayiRequest;
use App\Http\Requests\BayiUpdateRequest;
use App\Models\pencatatan_bayi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PencatatanBayiController extends Controller
{
    public function index(): View
    {
        $data = [
            'bayi' => pencatatan_bayi::all()
        ];

        return view('dashboard.bayi.index', $data);
    }
        public function store(BayiRequest $request)
    {
        try {

            $data = $request->validated();
            $bayi = pencatatan_bayi::query()->create($data);

            return redirect()->to('dashboard/bayi')->with('succsess', 'Bayi successfully created');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
      
    public function update(BayiUpdateRequest $request)
    {
        $data = $request->validated();
        $bayi = pencatatan_bayi::query()->find($request->id);

        $bayi->fill($data)->save();

        return redirect()->to('/dashboard/bayi')->with('success', 'Update success');
    }

    public function delete(int $id): JsonResponse
    {
        $bayi = pencatatan_bayi::query()->find($id)->delete();

        if($bayi):
            //Pesan Berhasil
            $pesan = [
                'success'   => true,
                'pesan'     => 'Data bayi berhasil dihapus'
            ];
        else:
            //Pesan Gagal
            $pesan = [
                'success' => false,
                'pesan'     => 'Data gagal dihapus'
            ];
        endif;
        return response()->json($pesan);
    }
}
