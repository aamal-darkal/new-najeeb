<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowLectureResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'subject_id' => $this->subject_id ,
            'event_subject_id' => $this->subject_id ,
            'name' => $this->name ,
            'time_publish' => $this->date ,
            'description' => null ,
            'created_at' => $this->created_at ,
            'updated_at' => $this->updated_at ,
            'video_url' => $this->video_link ,
            'files_pdf' =>  PdfFilesResource::collection( $this->pdfFiles ),
        ];
    }
}
