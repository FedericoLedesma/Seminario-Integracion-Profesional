<!DOCTYPE html>
<html lang="en">
<head>

    <base href="//crlcu.github.io/multiselect/" />

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="lib/google-code-prettify/prettify.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
{!!Form::open(['route'=>'menu_persona.index','method'=>'GET']) !!}
    <div id="wrap" class="container">

            <div class="row">
                <div class="col-xs-5">
                    <select name="desde[]" class="multiselect form-control" size="8" multiple="multiple" data-right="#multiselect_to_1" data-right-all="#right_All_1" data-right-selected="#right_Selected_1" data-left-all="#left_All_1" data-left-selected="#left_Selected_1">
                        <option value="1">Item 1</option>
                        <option value="2">Item 5</option>
                        <option value="2">Item 2</option>
                        <option value="2">Item 4</option>
                        <option value="3">Item 3</option>
                    </select>
                </div>

                <div class="col-xs-2">
                    <button type="button" id="right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                    <button type="button" id="right_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                    <button type="button" id="left_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                    <button type="button" id="left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                </div>

                <div class="col-xs-5">
                    <select name="hasta[]" id="multiselect_to_1" class="form-control" size="8" multiple="multiple"></select>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">


            </div>
        </div>
    </div>
		{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
		{!! Form::close() !!}

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
<script type="text/javascript" src="dist/js/multiselect.min.js"></script>



<script type="text/javascript">
$(document).ready(function() {
    // make code pretty
    window.prettyPrint && prettyPrint();

    $('.multiselect').multiselect();
});
</script>
</body>
</html>
