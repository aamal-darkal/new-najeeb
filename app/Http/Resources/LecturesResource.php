<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LecturesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'video_link' => $this->video_link,
            'time_publish' => $this->date,
            'duration' => $this->duration,
            'pdf_files' => PdfFilesResource::collection($this->pdfFIles)
        ];
    }
}
