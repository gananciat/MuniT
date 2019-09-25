<?php

namespace App;

use App\Contrato;
use App\TipoDocumento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoContrato extends Model
{
    use SoftDeletes;

    protected $table = 'documento_contratos';
    protected $fillable= [
    	'doc',
    	'contrato_id',
    	'tipo_documento_id'
    ];

    public function contrato(){
    	return $this->belongsTo(Contrato::class);
    }

    public function tipo_documento(){
    	return $this->belongsTo(TipoDocumento::class);
    }
}
