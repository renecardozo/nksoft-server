<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocenteMateriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = null;
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'docente_id' => $this->docente_id,
            'materia_id' => $this->materia_id,
            'grupo' => $this->grupo,
            'materia' => $this->materia,
        ];
    }
}
