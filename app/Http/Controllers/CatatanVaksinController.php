<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatatanVaksinCreateRequest;
use App\Http\Requests\CatatanVaksinUpdateRequest;
use App\Models\CatatanImunisasi;
use App\Models\CatatanVaksin;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CatatanVaksinController extends Controller
{
    public function index(): View
    {
        $data = [
            
            'catatan_vaksin' => CatatanVaksin::all()
        ];

        return view('dashboard.catatan_vaksin.index', $data);
    }

    public function store(CatatanVaksinCreateRequest $request)
    {
        $data = $request->validated();

        if ($path = $request->file('file')) {
            $path = $path->storePublicly('', 'public');
            $data['file'] = $path;
        }

        $vaksin = CatatanVaksin::query()->create($data);

        if (!$vaksin) {
            return response()->json([
                'message' => 'Failed create vaksin'
            ], 403);
        }

        return response()->json([
            'message' => 'Vaksin created'
        ], 201);
    }

    public function download(Request $request)
    {
        return Storage::download("public/$request->path");
    }

    public function update(CatatanVaksinUpdateRequest $request)
    {
        $data = $request->validated();
        $vaksin = CatatanVaksin::query()->find($request->id);

        if ($path = $request->file('file')) {
            // Delete old file
            if ($vaksin->file) {
                Storage::delete("public/$vaksin->file");
            }

            // Store new file
            $path = $path->storePublicly('', 'public');
            $data['file'] = $path;
        }

        $vaksin->fill($data)->save();

        return [
            'message' => 'Berhasil update vaksin!'
        ];
    }

    public function delete(int $id)
    {
        $vaksin = CatatanVaksin::query()->find($id);

        if (!$vaksin) {
            throw new HttpResponseException(response()->json([
                'message' => 'Not found'
            ])->setStatusCode(404));
        }

        // Deleting file
        Storage::delete("public/$vaksin->file");
        // Deleting vaksin
        $vaksin->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus vaksin'
        ], 200);
    }
}
