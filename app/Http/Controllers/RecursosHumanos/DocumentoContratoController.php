<?php

namespace App\Http\Controllers\RecursosHumanos;

use App\Contrato;
use App\DocumentoContrato;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class DocumentoContratoController extends ApiController
{
    public function __construct()
    {
        parent::__construct(); //proteje las rutas
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $documentoContratos = DocumentoContrato::all();
        return $this->showAll($documentoContratos);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'contrato_id' => 'required|integer',
            'tipo_documento_id' => 'required|integer',
            "doc" => "required|mimes:pdf|max:10000"
        ];

        
        $this->validate($request, $reglas);
        $contrato = Contrato::find($request->contrato_id);
        $folder = 'contrato_no_'.$contrato->no_contrato;

        $data = $request->all();
        $data['doc'] = $request->doc->store($folder);

        $documentoContrato = DocumentoContrato::create($data);

        return $this->showOne($documentoContrato,201);
    }

    //muestra un registro por id
    public function show(DocumentoContrato $documentoContrato)
    {
        return $this->showOne($documentoContrato);
    }

    //actualiza el registro
    public function update(Request $request, DocumentoContrato $documentoContrato)
    {
        $reglas = [
            'doc' => 'required',
            'contrato_id' => 'required|integer',
            'tipo_documento_id' => 'required|integer'
        ];

        $this->validate($request, $reglas);

        $documentoContrato->tipo_documento_id = $request->tipo_documento_id;

        if (!$documentoContrato->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $documentoContrato->save();
        return $this->showOne($documentoContrato);
    }

    //elminar registro de la tabla
    public function destroy(DocumentoContrato $documentoContrato)
    {
        $documentoContrato->delete();

        return $this->showOne($documentoContrato);
    }
}
