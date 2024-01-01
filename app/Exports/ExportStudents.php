<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportStudents implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithEvents, WithHeadingRow
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    private $subject;
    private $recCount;
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function query()
    {

        $subject_id = $this->subject->id;

        //prepare query to bring all student has enrolled to the subject
        $students = Student::wherehas('subjects', function ($q) use ($subject_id) {
            return $q->where('subject_id', $subject_id);
        });
        $this->recCount = $students->count() + 2;
        return  $students;
    }

    public function map($studentRec): array
    {
        $subject_id = $this->subject->id;
        $lectureCount = $this->subject->lectures->count();
        $lectureCount = $lectureCount == 0 ? 1 : $lectureCount;
        return [
            $studentRec->first_name,
            $studentRec->last_name,
            $studentRec->lecture = round($studentRec->lectures()->whereHas('subject', function ($q) use ($subject_id) {
                return $q->where('subject_id', $subject_id);
            })->count() * 100 / $lectureCount, 0)  . '%',
            $studentRec->phone,
            $studentRec->parent_phone,
            \Carbon\Carbon::create($studentRec->created_at)->diffForHumans(),
        ];
    }

    // header & row header
    public function headings(): array
    {
        return [
            ["طلاب مادة " . $this->subject->name . " بتاريخ " .  \Carbon\Carbon::today()->toDateString()],
            [
                'الاسم الأول',
                'الاسم الثاني',
                'نسبة الحضور',
                'رقم الجوال',
                'رقم الأب',
                'تاريخ انشاء الحساب'
            ]
        ];
    }
    public function headingRow(): int
    {
        return 2;
    }

    //styles
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'font' => ['bold' => true],
                'font' => ['size' => 16]
            ],
            'A2:F2' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'fdfddb']
                ]
            ],
            "A2:F$this->recCount"    => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true); // this change
                $event->sheet->mergeCells('A1:F1'); // this change
            },
        ];
    }
}
