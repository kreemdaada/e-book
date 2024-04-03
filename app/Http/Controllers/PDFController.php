<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Stellen Sie sicher, dass nur authentifizierte Benutzer auf diese Methode zugreifen können
    }

    public function downloadPDF()
    {
        // Holen Sie sich den angemeldeten Benutzer
        $user = Auth::user();

        $books = Book::all(); 

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('pdf.books', compact('books'))->render());

        // (Optional) Setzen Sie das Papierformat und die Ausrichtung
        $dompdf->setPaper('A4', 'portrait');

        // Rendern Sie das HTML als PDF
        $dompdf->render();

        // Geben Sie das generierte PDF an den Browser aus
        return $dompdf->stream('books.pdf');
    }
}
