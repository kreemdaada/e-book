<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends Controller
{
    public function downloadPDF()
    {
        // Alle Bücher abrufen
        $books = Book::all(); 

        // PDF-Optionen einrichten
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Dompdf-Instanz erstellen
        $dompdf = new Dompdf($options);

        // HTML aus der Blade-Vorlage laden
        $html = view('pdf.books', compact('books'))->render();

        // HTML zum Dompdf hinzufügen
        $dompdf->loadHtml($html);

        // Papiergröße und Ausrichtung festlegen
        $dompdf->setPaper('A4', 'portrait');

        // HTML als PDF rendern
        $dompdf->render();

        // Generiertes PDF zum Browser senden und herunterladen
        return $dompdf->stream('books.pdf');
    }
}
