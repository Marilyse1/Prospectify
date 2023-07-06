<?php
namespace App\Exports;
use App\Models\Prospect;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ProspectsExport implements FromQuery, WithHeadings, ShouldAutoSize, WithStyles
{
    public function query()
    {
        $start_date = request('start_date');
        $end_date = request('end_date');

        return Prospect::query()
            ->where('sale_concluded', true)
            ->whereBetween('date', [$start_date, $end_date])
            ->select(
                'agent_name',
                'client_name',
                'client_address',
                'date',
                'start_time',
                'end_time',
                'duration',
                'product',
                'observations',
                'sale_concluded',
            );
    }

    public function headings(): array
    {
        return [
            'Nom de l\'agent',
            'Nom du client',
            'Adresse du client',
            'Date',
            'Heure de début',
            'Heure de fin',
            'Durée',
            'Produit',
            'Observations',
            'Vente conclue',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // En-têtes en gras (ligne 1)
        ];
    }
}

