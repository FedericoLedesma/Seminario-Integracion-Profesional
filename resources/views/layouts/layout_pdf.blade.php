<html>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 2cm 2cm 2cm;
        }
        tbody tr:nth-child(odd){
          background-color: #E3ECE6;
          color: #000000;
        tr td:last-child{

               white-space:nowrap;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 30px;
        }

    </style>
    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 730, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
    </script>
</head>
<body>


<main>
  @yield('content')
</main>

<footer>
  <div class="page-break"></div>
</footer>
</body>
</html>
