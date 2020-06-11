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
        div.blueTable {
          border: 1px solid #1C6EA4;
          width: 100%;
          text-align: left;
          border-collapse: collapse;
        }
        .divTable.blueTable .divTableCell, .divTable.blueTable .divTableHead {
          border: 1px solid #AAAAAA;
          padding: 3px 2px;
        }
        .divTable.blueTable .divTableBody .divTableCell {
          font-size: 13px;
        }
        .divTable.blueTable .divTableRow:nth-child(even) {
          background: #F5F5F5;
        }
        .divTable.blueTable .divTableHeading {
          background: #FFFFFF;
          background: -moz-linear-gradient(top, #ffffff 0%, #ffffff 66%, #FFFFFF 100%);
          background: -webkit-linear-gradient(top, #ffffff 0%, #ffffff 66%, #FFFFFF 100%);
          background: linear-gradient(to bottom, #ffffff 0%, #ffffff 66%, #FFFFFF 100%);
          border-bottom: 2px solid #444444;
        }
        .divTable.blueTable .divTableHeading .divTableHead {
          font-size: 15px;
          font-weight: bold;
          color: #010101;
          border-left: 2px solid #6A7A84;
        }
        .divTable.blueTable .divTableHeading .divTableHead:first-child {
          border-left: none;
        }

        .blueTable .tableFootStyle {
          font-size: 14px;
          font-weight: bold;
          color: #FFFFFF;
          background: #D0E4F5;
          background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
          background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
          background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
          border-top: 2px solid #444444;
        }
        .blueTable .tableFootStyle {
          font-size: 14px;
        }
        .blueTable .tableFootStyle .links {
        	 text-align: right;
        }
        .blueTable .tableFootStyle .links a{
          display: inline-block;
          background: #1C6EA4;
          color: #FFFFFF;
          padding: 2px 8px;
          border-radius: 5px;
        }
        .blueTable.outerTableFooter {
          border-top: none;
        }
        .blueTable.outerTableFooter .tableFootStyle {
          padding: 3px 5px;
        }
        /* DivTable.com */
        .divTable{ display: table; }
        .divTableRow { display: table-row; }
        .divTableHeading { display: table-header-group;}
        .divTableCell, .divTableHead { display: table-cell;}
        .divTableHeading { display: table-header-group;}
        .divTableFoot { display: table-footer-group;}
        .divTableBody { display: table-row-group;}
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
