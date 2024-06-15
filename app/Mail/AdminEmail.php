<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $razon_solicitud;
    public $ambiente;
    public $materia;
    public $fecha;
    public $estado_de_solicitud;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $razon_solicitud, $ambiente, $materia, $fecha, $estado_de_solicitud, $content)
    {
        $this->title = $title;
        $this->razon_solicitud = $razon_solicitud;
        $this->ambiente = $ambiente;
        $this->materia = $materia;
        $this->fecha = $fecha;
        $this->estado_de_solicitud = $estado_de_solicitud;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin_email')
            ->with([
                'title' => $this->title,
                'razon_solicitud' => $this->razon_solicitud,
                'ambiente' => $this->ambiente,
                'materia' => $this->materia,
                'fecha' => $this->fecha,
                'estado_de_solicitud' => $this->estado_de_solicitud,
                'content' => $this->content,
            ]);
    }
}
