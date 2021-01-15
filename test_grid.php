<!DOCTYPE html>

<html>

<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>

<body>

<form method="post" action="">
<table id="myTable" cellspacing="1" border="1">            
    <thead>> 
        <tr> 
            <th>Date</th> 
            <th>Serial No</th> 
            <th>Disease</th> 
            <th>Cut of Value</th> 
            <th>Patient Value</th> 
            <th>Repeat Date</th> 
            
            <th>Final Status</th> 
            <th>Fax Date</th> 
        </tr> 
    </thead> 
    <tbody>
    <?php
        for($k=1; $k<10; $k++){
            ?>
        <tr class="clone"> 
            <td>peter</td> 
            <td>parker</td>
            <td>parker</td> 
            <td><input type="text" name="cut_of_value" value=""></td> 
            <td><input type="text" name="patient_value" value=""></td> 
            
            <td><input type="text" name="repeat_date" value=""></td> 
            <td><input type="text" name="final_status" value=""></td> 
            <td><input type="text" name="fax_date" value=""></td> 
            
            <td><button id="btn" class="btn-save">Click ME</button></td>
        </tr>

            <?php
        }
    ?> 
         
        <!-- <tr> 
            <td>john</td> 
            <td>hood</td> 
            <td>33</td> 
            <td><input type="text" name="onhand_khi" id="onhand_khi" value=""></td>  
            <td>25.1%</td> 
            <td>-7</td> 
            <td><button id="btn" class="btn-save" >Click ME</button></td>
        </tr> 
        <tr> 
            <td>clark</td> 
            <td>kent</td> 
            <td>18</td> 
            <td><input type="text" name="onhand_khi" id="onhand_khi" value=""></td>  
            <td>44.2%</td> 
            <td>-15</td> 
            <td><button id="btn" class="btn-save">Click ME</button></td>
        </tr> 
        <tr> 
            <td>bruce</td> 
            <td>almighty</td> 
            <td>45</td> 
            <td><input type="text" name="onhand_khi" id="onhand_khi" value=""></td>  
            <td>44%</td> 
            <td>+19</td> 
            <td><button id="btn" class="btn-save">Click ME</button></td>
        </tr> 
        <tr> 
            <td>bruce</td> 
            <td>evans</td> 
            <td>56</td> 
            <td><input type="text" name="onhand_khi" id="onhand_khi" value=""></td>  
            <td>23%</td> 
            <td>+9</td> 
            <td><button id="btn" class="btn-save">Click ME</button></td>
        </tr>  -->
     
    </tbody> 
</table>
</form>
<!-- Firstname is:<input type="text" id="firstname" />
<br>
Lastname is:<input type="text" id="lastname" />
<br>
Age is:<input type="text" id="age" />
<br>
Total is:<input type="text" id="total" />
<br>
Discount is:<input type="text" id="discount" />
<br>
Diff is:<input type="text" id="diff" /> -->

</body>

</html>
<script type="text/javascript">
    (function ($) {
        $('.btn-save').live('click', function (e) {
            e.preventDefault();
            var row = $(this).parents('tr.clone');
            
            var cut_of_value = row.find('[name^=cut_of_value]').val();
            var patient_value = row.find('[name^=patient_value]').val();
            var repeat_date = row.find('[name^=repeat_date]').val();
            var final_status = row.find('[name^=final_status]').val();
            var fax_date = row.find('[name^=fax_date]').val();

            console.log(cut_of_value,patient_value,repeat_date,final_status,fax_date);
            // $.ajax({
            //         url:"{{ route('StockController.update') }}",
            //         method:"POST",
            //         data:{
            //             productID:pro_id,
            //             onHand:onhand,
            //             warehouseID:wh_id,
            //             in_stock:in_stock,
            //             out_stock:out_stock,
            //             reason:reason,
            //             _token:_token,
            //             },
            //         success:function(result)
            //         {
            //          $("#stock_result2").html(result);
            //         }
            //        })
})
    })(jQuery)
</script>
