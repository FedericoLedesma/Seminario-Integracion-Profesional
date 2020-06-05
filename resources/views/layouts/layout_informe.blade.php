<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Informe</title>
    <style>
    body {
         height: 842px;
         width: 595px;
         /* to centre page on screen*/
         margin-left: auto;
         margin-right: auto;
     }
    table {
     width:auto;
     border: 1px solid #000;
  }
    th, {
       width: 25%;
       text-align: left;
       vertical-align: top;
       border: 1px solid #000;
       border-collapse: collapse;
       padding: 0.3em;
       caption-side: bottom;
       font-size: 8px;
    }
    td{
         border:1px  #000;
         font-size: 8px;
      }
    thead tr{
      font-size: 8px;
    }
    tbody tr:nth-child(odd){
      background-color: #E3ECE6;
      color: #000000;
    tr td:last-child{
           width:1%;
           white-space:nowrap;
    }
  caption {
     padding: 0.3em;
     color: #fff;
      background: #000;
  }
  th {
     background: #eee;
     font-size: 8px;
  }
    </style>

  </head>
  <body>
 	  @yield('content')
  </body>
</html>
