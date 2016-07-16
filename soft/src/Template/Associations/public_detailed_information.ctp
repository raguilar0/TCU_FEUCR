<div class="container">;

<br>
<br>
<br>
<br>
<br>
<br>


    <ul class="nav nav-tabs" id="public_amounts_nav">
        <li class="active"><a data-toggle="tab" href="#tract" onclick="getAmounts(0,0,0, document.getElementById('tracts_id'));">Montos de Tracto</a></li>
        <li><a data-toggle="tab" href="#generated" onclick="getAmounts(1,1,1,document.getElementById('generated_id'));">Ingresos Generados</a></li>
        <li><a data-toggle="tab" href="#surplus" onclick="getAmounts(2,2,2,document.getElementById('surplus_year_id'));">Superávit</a></li>
    </ul>


    <div class = "row text-center">
        <div class = "col-xs-12">
            <?php
            echo "<h1 id='association_name'>".$association_name[0]['name']."</h1>";
            ?>
        </div>
    </div>



    <div class="tab-content">
        <div id="tract" class="tab-pane fade in active">

            <div class="row text-center">
                <div class="col-xs-12">
                    <h2 id = "tract_date">No hay montos de tractos para esta asociación aún.</h2>
                </div>
            </div>

            <br>


            <?php if(!empty($years) and !empty($dates)):?>

            <div class="row text-center">

                <div class="col-xs-12 col-md-6">

                        <?php
                        echo "<label><h5><strong>Elegí el año</strong></h5></label>";
                        echo "<select class='form-control classic' id= 'tract_year_id' name = 'year' onchange='reloadPage(this)'>";


                        foreach ($years as $key => $value) {
                            echo "<option>".$value['year']."</option>"."<br>";
                        }

                        echo "</select>";
                        ?>

                </div>

                <div class="col-xs-12 col-md-6" style='margin-top: 15px;'>
                    <?= $this->Form->input('tract_id', ['options' => $dates, 'class'=> 'form-control classic','label'=>'Elegí la fecha', 'id'=>'tracts_id', 'onchange'=>'getAmounts(0,0,0,this);']);?>

                </div>


            </div>



            <br>
            <br>
            <br>





            <h2><strong>Facturas</strong></h2>

            <div class="table-responsive text-center">

                <table class="table table-hover" id="invoice_tract">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th># Factura</th>
                        <th>Detalle</th>
                        <th>Proveedor</th>
                        <th>Monto</th>
                        <th>Encargado</th>
                        <th>Aclaraciones</th>
                        <th>Ced. Jurídica</th>
                    </tr>
                    </thead>

                    <tbody id="tract_invoices">

                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-xs-12" id="tract_invoices_total">

                </div>
            </div>

            <br>
            <hr>

            <br>
            <br>



            <div class="row">

                <div class="col-xs-12 col-md-6 text-center">

                    <table class="table table-striped" id='income_tract'>
                        <tr>
                            <th><p style="font-size: larger;text-decoration:underline;">Cuadro de ingresos</p></th>
                            <td> </td>
                        </tr>
                        <tr>
                            <th>Monto de Tracto</th>
                            <td id="tract_amount"></td>
                        </tr>

                        <tr>
                            <th>Monto de Ahorro</th>
                            <td class="saving_amount"></td>
                        </tr>

                        <tr>
                            <th>Total</th>
                            <td class = "tract_saving_total" ></td>
                        </tr>

                    </table>
                </div>

                <div class="col-xs-12 col-md-6 text-center">


                    <table class="table table-striped" id="box_tract">
                        <tr>
                            <th><p style="font-size: larger;text-decoration:underline;">Cajas</p></th>
                            <td> </td>
                        </tr>
                        <tr>
                            <th>Caja Fuerte</th>
                            <td id="big_amount_tract"></td>
                        </tr>

                        <tr>
                            <th>Caja Chica</th>
                            <td id="little_amount_tract"></td>
                        </tr>

                        <tr>
                            <th>Total</th>
                            <td class="boxes_total_tract"></td>
                        </tr>

                    </table>
                </div>

            </div>

            <br>

            <div class="row">
                <div class="col-xs-12 text-center">


                    <table class="table tnble-striped" id="general_tract">
                        <tr>
                            <th><p style="font-size: larger;text-decoration:underline;">Estado general del Tracto</p></th>
                            <td> </td>
                        </tr>
                        <tr>
                            <th>Saldo inicial de cajas</th>
                            <td id="tract_initial_amount"></td>
                        </tr>

                        <tr>
                            <th>Ahorro del período anterior</th>
                            <td class="saving_amount"></td>
                        </tr>

                        <tr>
                            <th>Ingresos del período</th>
                            <td class = "tract_saving_total" ></td>
                        </tr>

                        <tr>
                            <th><u>Total de ingresos</u></th>
                            <td id = "total_income"></td>
                        </tr>

                        <tr>
                            <th>Total de gastos</th>
                            <td id="total_spent"></td>
                        </tr>

                        <tr>
                            <th><u>Saldo final</u></th>
                            <td id="tract_final_balance"></td>
                        </tr>

                        <tr>
                            <th>Total de cajas</th>
                            <td class="boxes_total_tract"></td>
                        </tr>

                        <tr>
                            <th><u>Cuenta</u></th>
                            <td id = "tract_count"></td>
                        </tr>
                    </table>
                </div>
            </div>


            <br>
            <br>

            <?php endif;?>

        </div>





        <!--************************************************ Superavit ********************** -->




        <div id="surplus" class="tab-pane fade">


            <div class="row text-center">
                <div class="col-xs-12">
                    <h2 id = "surplus_date">No hay montos de superávit registrados para este año.</h2>
                </div>
            </div>

            <?php if(!empty($years)):?>


            <div class="row text-center">

                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <?php
                    echo "<label><h4><strong>Elegí el año</strong></h4></label>";
                    echo "<select class='form-control classic' id= 'surplus_year_id' name = 'year' onchange='getAmounts(2,2,2,this);'>";


                    foreach ($years as $key => $value) {
                        echo "<option>".$value['year']."</option>"."<br>";
                    }

                    echo "</select>";
                    ?>
                </div>



            </div>






            <br>
            <br>

            <h2><strong>Facturas</strong></h2>



            <div class="table-responsive">
                <table class="table table-hover" id="invoice_surplus">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Número de Factura</th>
                        <th>Detalle</th>
                        <th>Proveedor</th>
                        <th>Monto</th>
                        <th>Encargado</th>
                        <th>Aclaraciones</th>
                        <th>Ced. Jurídica</th>
                    </tr>
                    </thead>

                    <tbody id="surplus_invoices">


                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-xs-12" id="surplus_total_invoices">

                </div>
            </div>

            <br>
            <hr>

            <br>
            <br>



            <div class="row">

                <div class="col-xs-12 text-center">

                    <table class="table table-striped" id="income_surplus">
                        <tr>
                            <th><p style="font-size: larger;text-decoration:underline;">Cuadro de ingresos</p></th>
                            <td> </td>
                        </tr>
                        <tr>
                            <th>Monto de Superávit</th>
                            <td class="surplus_amount"></td>
                        </tr>


                        <tr>
                            <th>Total</th>
                            <td class = "surplus_amount" ></td>
                        </tr>

                    </table>
                </div>


            </div>

            <br>

            <div class="row">
                <div class="col-xs-12 text-center">

                    <table class="table table-striped" id="general_surplus">
                        <tr>
                            <th><p style="font-size: larger;text-decoration:underline;">Estado General</p></th>
                            <td> </td>
                        </tr>
                        <tr>
                            <th>Monto Asignado</th>
                            <td class = "surplus_amount" ></td>
                        </tr>


                        <tr>
                            <th>Total de gastos</th>
                            <td id="surplus_total_spent"></td>
                        </tr>

                        <tr>
                            <th><u>Saldo final</u></th>
                            <td id="surplus_final_balance"></td>
                        </tr>

                    </table>
                </div>
            </div>

            <br>
            <br>

            <?php endif;?>

        </div>


        <!--************************************************ INGRESOS GENERADOS ********************** -->
        <div id="generated" class="tab-pane fade">

            <div class="row text-center">
                <div class="col-xs-12">
                    <h2 id = "generated_date">No hay montos de ingresos generados registrados para esta asociación aún.</h2>
                </div>
            </div>

            <br>

            <?php if(!empty($years) and !empty($dates)):?>

            <div class="row text-center">

                <div class="col-xs-12 col-md-6">
                    <?php
                    echo "<label><h5><strong>Elegí el año</strong></h5></label>";
                    echo "<select class='form-control classic' id= 'tracts_generated_id' name = 'year' onchange='reloadPage(this)'>";


                    foreach ($years as $key => $value) {
                        echo "<option>".$value['year']."</option>"."<br>";
                    }

                    echo "</select>";
                    ?>
                </div>

                <div class="col-xs-12 col-md-6" style='margin-top: 15px;'>
                    <?= $this->Form->input('tract_id', ['options' => $dates, 'class'=> 'form-control classic','label'=>'Elegí la fecha', 'id'=>'generated_id', 'onchange'=>'getAmounts(1,1,1,this);']);?>

                </div>

            </div>






            <br>
            <br>

            <h2><strong>Facturas</strong></h2>


            <div class="table-responsive">
                <table class="table table-hover" id="invoice_generated">
                    <thead>

                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th># Factura</th>
                        <th>Detalle</th>
                        <th>Proveedor</th>
                        <th>Monto</th>
                        <th>Encargado</th>
                        <th>Aclaraciones</th>
                        <th>Ced. Jurídica</th>
                    </tr>
                    </thead>

                    <tbody id="generated_invoices">

                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-xs-12" id="generated_invoices_total">

                </div>
            </div>

            <br>
            <hr>

            <br>
            <br>



            <div class="row">
                <h4><strong style="text-decoration: underline;;">Cuadro de ingresos</strong></h4>
                <div class="col-xs-12 col-md-6 text-center">

                    <div class="table-responsive">
                        <table class="table table-hover" id="income_generated">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Detalle</th>
                                <th>Monto</th>
                            </tr>
                            </thead>

                            <tbody id="generated_incomes">

                            </tbody>
                        </table>

                    </div>

                    <div class="generated_amount">

                    </div>

                </div>


                <div class="col-xs-12 col-md-6 text-center">

                    <table class="table table-striped" id="box_generated">
                        <tr>
                            <th><p style="font-size: larger;text-decoration:underline;">Cajas</p></th>
                            <td> </td>
                        </tr>
                        <tr>
                            <th>Caja Fuerte</th>
                            <td id="generated_big_amount"></td>
                        </tr>

                        <tr>
                            <th>Caja Chica</th>
                            <td id="generated_little_amount"></td>
                        </tr>

                        <tr>
                            <th>Total</th>
                            <td class="generated_total_boxes"></td>
                        </tr>

                    </table>
                </div>

            </div>

            <br>

            <div class="row">
                <div class="col-xs-12 text-center">


                    <table class="table table-striped" id="general_generated">
                        <tr>
                            <th><p style="font-size: larger;text-decoration:underline;">Estado general del Ingresos Generados</p></th>
                            <td> </td>
                        </tr>
                        <tr>
                            <th>Saldo inicial de cajas</th>
                            <td id="generated_initial_amount"></td>
                        </tr>


                        <tr>
                            <th>Ingresos del período</th>
                            <td class="generated_amount"></td>
                        </tr>

                        <tr>
                            <th><u>Total de ingresos</u></th>
                            <td id = "generated_total_income"></td>
                        </tr>

                        <tr>
                            <th>Total de gastos</th>
                            <td id="generated_total_spent"></td>
                        </tr>

                        <tr>
                            <th><u>Saldo final</u></th>
                            <td id="generated_final_balance"></td>
                        </tr>

                        <tr>
                            <th>Total de cajas</th>
                            <td class="generated_total_boxes"></td>
                        </tr>

                        <tr>
                            <th><u>Cuenta de ahorro</u></th>
                            <td id="generated_saving_account"></td>
                        </tr>
                    </table>
                </div>
            </div>





            <br>
            <br>


            <?php endif;?>
        </div>
    </div>






    <script>
        $(document).ready( function ()
        {
            getAmounts(0,0,0, document.getElementById("tracts_id"));
        });

        function getAmounts(amount_type, box_type, invoice_type, object)
        {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function()
            {

                if(xhttp.readyState == 4 && xhttp.status == 200)
                {
                    var obj = JSON.parse(xhttp.responseText);

                    switch(amount_type)
                    {
                        case 0:
                            setTractValues(obj);
                            break;

                        case 1:
                            setGeneratedValues(obj);
                            break;

                        case 2:
                            setSurplusValues(obj);
                            break;
                    }

                }
                else
                {
                    if( xhttp.status == 404)
                    {

                    }


                }

            };


            var newPath = "<?= $this->Url->build(["controller" => "Associations", "action" => "getAmounts"]); ?>"; //Con esto obtenemos la URL a la que necesitamos hacer el get
            var association_id = <?=  $association_name[0]['id']; ?>; //Se obtiene el id de la asociación


            newPath += "/"+association_id+"/"+amount_type+"/"+box_type+"/"+invoice_type+"/"+object.value;

            xhttp.open("GET",newPath,true);
            xhttp.send();

        }





        function reloadPage(element)
        {

            var path = "<?= $this->Url->build(["controller" => "Associations", "action" => "detailedInformation"]); ?>"; //Con esto obtenemos la URL a la que necesitamos hacer el get
            var association_id = <?=  $association_name[0]['id']; ?>; //Se obtiene el id de la asociación


            path += "/"+association_id+"/"+element.value;

            window.location = path;
        }





    </script>

    <?=$this->Html->script('detailed_information.js') ?> <!-- Código para los datos de la vista -->




</div>







