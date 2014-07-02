<link href="<?php echo base_url();?>assets/frontend/css/style.css" rel="stylesheet">



        <fieldset class="extra-property">



            <label class="control-label">Bedroom:</label>

            <input type="hidden" value="Bedroom"/>

            <select name="bedroom" id="bedroom">


                <?php

                $a = 1;

                while ($a <= 10) {

                ?>

                <option value="<?php echo $a;?>" <?php echo ($prop_info->bedroom == $a)?'selected':'';?>><?php echo $a;?></option>

                <?php

                $a++; }

                ?>

            </select>

             <a id="bedroom<?php echo $prop_info->id;?>" onclick="saveSingle('bedroom');" width="60%">

            <img  src="<?php echo base_url();?>assets/frontend/images/edit.png">

            Save</a>

            

            



        </fieldset>

        <fieldset class="extra-property">



            <label class="control-label">Bathroom:</label>

            <input type="hidden" value="Bathroom"/>

            <select name="bathroom" id="bathroom">


                <?php

                $b = 1;

                while ($b <= 10) {

                ?>

                <option value="<?php echo $b;?>" <?php echo ($prop_info->bathroom == $b)?'selected':'';?>><?php echo $b;?></option>

                <?php

                $b++; }

                ?>

            </select>

             <a id="bathroom<?php echo ($prop_info->id);?>" onclick="saveSingle('bathroom');" width="60%">

            <img src="<?php echo base_url();?>assets/frontend/images/edit.png">

            Save</a>

            

            



        </fieldset>

<fieldset class="extra-property">



            <label class="control-label">Adult:</label>

            <input type="hidden" value="Adult"/>

            <select name="adult" id="adult">


                <?php

                $c = 1;

                while ($c <= 10) {

                ?>

                <option value="<?php echo $c;?>" <?php echo ($prop_info->adult == $c)?'selected':'';?>><?php echo $c;?></option>

                <?php

                $c++; }

                ?>

            </select>

             <a id="adult<?php echo $prop_info->id;?>" onclick="saveSingle('adult');" width="60%">

            <img src="<?php echo base_url();?>assets/frontend/images/edit.png">

            Save</a>

            

           



        </fieldset>

<fieldset class="extra-property">



            <label class="control-label">Children:</label>

            <input type="hidden" value="Children"/>

            <select name="children" id="children">


                <?php

                $d = 0;

                while ($d <= 10) {

                ?>

                <option value="<?php echo $d;?>" <?php echo ($prop_info->children == $d)?'selected':'';?>><?php echo ($d==0)?'None':$d;?></option>

                <?php

                $d++; }

                ?>

            </select>

             <a id="children<?php echo $prop_info->id;?>" onclick="saveSingle('children');" width="60%">

            <img src="<?php echo base_url();?>assets/frontend/images/edit.png">

            Save</a>

            

            



        </fieldset>



        <fieldset class="extra-property">



            <label class="control-label">Pet:</label>

            

            <input type="radio" id="pet" name="pet" value="1" <?php if($prop_info->pet == 1) { echo 'checked'; } ?> />Yes

            <input type="radio" id="pet" name="pet" value="0" <?php if($prop_info->pet == 0) { echo 'checked'; } ?> />No

             <a id="pet<?php echo ($prop_info->id);?>" onclick="savePet('pet', '<?php echo $prop_info->id;?>');" width="60%">

            <img src="<?php echo base_url();?>assets/frontend/images/edit.png">

            Save</a>

            

            



        </fieldset>

        <?php

   

        if (@$extra_property) {

    $i = 1;

    foreach (@$extra_property as $exp) {

       

       {

        ?>



        <fieldset class="extra-property">



            <label class="control-label">Custom Fields:</label>

            <div id="custom_<?php echo ($exp->id).$i;?>">

            <input id="type_<?php echo ($exp->id).$i;?>"type="text" class="txt" value="<?php echo $exp->type; ?>"  name="ctype[]">

            <input id="value_<?php echo ($exp->id).$i;?>"type="text" class="txt" value="<?php echo $exp->value; ?>" name="cvalue[]">

            </div>

            <a id="ddddd<?php echo ($exp->id).$i;?>" onclick="saveSingleCustom('<?php echo $exp->id;?>', '<?php echo $i;?>');" xhref="<?php echo base_url();?>ajax/updateExtraInfoByID/<?php echo $exp->id;?>" width="60%">

            <img src="<?php echo base_url();?>assets/frontend/images/edit.png">

            Save</a>

            



            <a href="<?php echo base_url();?>ajax/removeExtraProp/<?php echo $exp->id;?>" width="60%">

            <img src="<?php echo base_url();?>assets/frontend/images/cross.png">

            Delete</a>



        </fieldset>



        <?php

       }

        $i++;

    }

}

    ?>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js//jquery-1.10.1.min.js"></script>

<script>

    

function saveSingle(dddddddd)

{

    $('#' + dddddddd + '<?php echo $prop_info->id;?>').html('<img src="<?php echo base_url();?>assets/frontend/images/search/loading.gif">Saving..');

    var valx = $('#' + dddddddd).val();

     $.ajax({

            type: 'POST',

            url: '<?php echo site_url();?>ajax/editEachfixedProp',

            data: {pid : <?php echo $prop_info->id;?>, colx: dddddddd,fieldx: valx},

            cache: false,

            success: function(result){ 

            $('#' + dddddddd + '<?php echo $prop_info->id;?>').html('<img src="<?php echo base_url();?>assets/frontend/images/edit.png">Save');

            $('#' + dddddddd).html(result);

      }

  });

}



function saveSingleCustom(pid, eid)

{

    var ddd = $('#abc' + eid).val();

    var type = $('#type_' + pid + eid).val();

    var value = $('#value_' + pid + eid).val();

    $('#ddddd' + pid + eid).html('<img src="<?php echo base_url();?>assets/frontend/images/search/loading.gif">Saving..');

     $.ajax({

            type: 'POST',

            url: '<?php echo site_url();?>ajax/editEachcustomProp',

            data: {pid : pid, type : type, value : value, eid: eid},

            cache: false,

            success: function(result){

            $('#ddddd' + pid + eid).html('<img src="<?php echo base_url();?>assets/frontend/images/edit.png">Save');

            $('#custom_' + pid + eid).html(result);

      }

  });

}



function savePet(pet,pid)

{

    var radio_button_value;



    if ($("input[name='pet']:checked").length > 0){

        radio_button_value = $('input:radio[name=pet]:checked').val();

    }

       $('#pet' + pid).html('<img src="<?php echo base_url();?>assets/frontend/images/search/loading.gif">Saving..');

       $.ajax({

            type: 'POST',

            url: '<?php echo site_url();?>ajax/savepet',

            data: {pid : pid, pet : radio_button_value},

            cache: false,

            success: function(result){

            $('#pet' + pid ).html('<img src="<?php echo base_url();?>assets/frontend/images/edit.png">Save');

            }

        });

    

}

</script>





