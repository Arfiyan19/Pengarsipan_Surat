<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Mobil;
use DataTables;
use App\Models\surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = surat::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="lihat/' . $row->id . '" data-toggle="tooltip"  
                            data-original-title="lihat" class="btn btn-primary">
                            Lihat                             
                            </a> 
                            
                            <a href="unduh/' . $row->id . '" data-toggle="tooltip"  
                            data-original-title="unduh" class="btn btn-warning">
                            Unduh                             
                            </a> 

                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" 
                            class="btn btn-danger deleteData">Delete
                             </a>
                        ';


                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.surat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'NomorSurat'   => 'required',
            'Kategori'  => 'required',
            'Judul'  => 'required',
            'waktu_arsip'  => 'required',
            // 'foto'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->file('File')) {
            $fileName = $request->file('File')->store('dokumen', 'public');
        }

        // mobil update or create
        $surat = surat::updateOrCreate(

            ['id' => $request->data_id],
            [
                'NomorSurat'      => $request->NomorSurat,
                'Kategori'     => $request->Kategori,
                'Judul'     => $request->Judul,
                'waktu_arsip'     => $request->waktu_arsip,
                'File'      => $fileName,
            ]
        );

        if (!$request->data_id == '') {
            return response()->json([
                'status' => 'sukses',
                'message' => 'Surat berhasil Diubah'
            ], 200);
        } else {
            return response()->json([
                'status' => 'sukses',
                'message' => 'Surat berhasil Ditambahkan'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function lihat($id)
    {
        $data = surat::find($id);
        return view('admin.surat.show', compact('data'));
    }

    public function unduh($id)
    {
        $data = surat::find($id);
        return response()->download(storage_path('app/public/' . $data->File));
    }
    public function show($id)
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function edit(surat $surat)
    {
        return response()->json($surat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, surat $surat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function destroy(surat $surat)
    {
        $surat->delete();
        return response()->json([
            'status' => 'sukses',
            'message' => 'Surat berhasil Dihapus'
        ], 200);
    }
}
