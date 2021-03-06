<?php
  include('connectdb.php');
  session_start();

  function fill_product($pdo,$pid){

      $output = '';

      $select = $pdo->prepare("select * from tbl_product order by pname");
      $select->execute();

      $result = $select->fetchall();

      foreach($result as $row){
        $output.= '<option value = "'.$row["pid"].'"';
          if($pid==$row['pid']){
            $output.='selected';
          }
        $output.='>'.$row["pname"].' </option>';
      }

      return $output;
  }


     $id=$_GET['id'];
$select=$pdo->prepare("select * from tbl_invoice where invoice_id =$id");
$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);

 $customer_name=$row['customer_name'];
    $order_date=date('Y-m-d',strtotime($row['order_date']));
    $subtotal=$row["subtotal"];
    $tax=$row['tax'];
    $discount=$row['discount'];
    $total=$row['total'];
    $paid=$row['paid'];
    $due=$row['due'];
    $payment_type=$row['payment_type'];


$select=$pdo->prepare("select * from tbl_invoice_details where invoice_id =$id");
$select->execute();

$row_invoice_details=$select->fetchAll(PDO::FETCH_ASSOC);




if(isset($_POST['btneditorder'])){
    
    
//Steps for btnupdateorder button.

// 1) Get values from text feilds and from array in variables.
    $txt_customer_name=$_POST['txtcustomer'];
    $txt_order_date=date('Y-m-d',strtotime($_POST['orderdate']));
    $txt_subtotal=$_POST["txtsubtotal"];
    $txt_tax=$_POST['txttax'];
    $txt_discount=$_POST['txtdiscount'];
    $txt_total=$_POST['txttotal'];
    $txt_paid=$_POST['txtpaid'];
    $txt_due=$_POST['txtdue'];
    $txt_payment_type=$_POST['rb'];
    ////////////////////////////////
    
         $arr_productid=$_POST['productid'];
         $arr_productname=$_POST['productname'];
         $arr_stock=$_POST['stock'];
         $arr_qty=$_POST['qty'];
         $arr_price=$_POST['price'];
         $arr_total=$_POST['total'];
    
    
    
    
    
    
    
// 2) Write update query for tbl_product stock.
    
foreach($row_invoice_details as $item_invoice_details){

    $updateproduct=$pdo->prepare("update tbl_product set pstock=pstock+".$item_invoice_details['qty']." where pid='".$item_invoice_details['product_id']."'");
    $updateproduct->execute();
 }    
    
    
    
    
    
// 3) Write delete query for tbl_invoice_details table data where invoice_id =$id .
    
    
$delete_invoice_details=$pdo->prepare("delete from tbl_invoice_details where invoice_id=$id");
    
$delete_invoice_details->execute();    
    
    
    
    

    
    



    
    
    // 4) Write update query for tbl_invoice table data.
    $update_invoice=$pdo->prepare("update tbl_invoice set customer_name=:cust,order_date=:orderdate,subtotal=:stotal,tax=:tax,discount=:disc,total=:total,paid=:paid,due=:due,payment_type=:ptype where invoice_id=$id");
    
   $update_invoice->bindParam(':cust',$txt_customer_name);
   $update_invoice->bindParam(':orderdate',$txt_order_date);
   $update_invoice->bindParam(':stotal' ,$txt_subtotal);
   $update_invoice->bindParam(':tax',$txt_tax);
   $update_invoice->bindParam(':disc',$txt_discount);
   $update_invoice->bindParam(':total',$txt_total);
   $update_invoice->bindParam(':paid',$txt_paid);
   $update_invoice->bindParam(':due',$txt_due);
   $update_invoice->bindParam(':ptype',$txt_payment_type);
   
    $update_invoice->execute();
    
    
    
   
    
    $invoice_id=$pdo->lastInsertId();
    if($invoice_id!=null){
    
for($i=0 ; $i<count($arr_productid) ; $i++){
   
// 5) Write select query for tbl_product table to get out stock value.    
    
$selectpdt=$pdo->prepare("select * from tbl_product where pid='".$arr_productid[$i]."'");
$selectpdt->execute();
    
while($rowpdt=$selectpdt->fetch(PDO::FETCH_OBJ)){
    
     $db_stock[$i]=$rowpdt->pstock;
    
    
    $rem_qty = $db_stock[$i]-$arr_qty[$i];
    
    if($rem_qty<0){
        
        return"Order Is Not Complete";
    }else{
        
        
        // 6) Write update query for tbl_product table to update stock values.

        
       $update=$pdo->prepare("update tbl_product SET pstock ='$rem_qty' where pid='".$arr_productid[$i]."'");
        
        $update->execute();
        
        
    }
      
    
    
}    
    
    
    
 
    
    
    
    
    
    
    // 7) Write insert query for tbl_invoice_details for insert new records.
        
    
   $insert=$pdo->prepare("insert into tbl_invoice_details(invoice_id,product_id,product_name,qty,price,order_date) values(:invid,:pid,:pname,:qty,:price,:orderdate)");
    
    $insert->bindParam(':invid',$id);
    $insert->bindParam(':pid', $arr_productid[$i]);
    $insert->bindParam(':pname',$arr_productname[$i]);
    $insert->bindParam(':qty',$arr_qty[$i]);
    $insert->bindParam(':price',$arr_price[$i]);
    $insert->bindParam(':orderdate',$txt_order_date);
     
    
    $insert->execute();
    
   
    
    
    
    
}        
        
   //  echo"success fully created order";    
   header('location:orderlist.php');     
        
    }    
    



      }
  

  


  include('layout/header.php');
  if($_SESSION['useremail'] == '' OR $_SESSION['role'] == 'user'){
    header('location:index.php');
  }

 
?>

<?php include('layout/topbar.php'); ?>
<?php include('layout/navbar.php'); ?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Order <small>it all starts here</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class = "box box-warning">

            <form role="form" method = "post" action = "">
              <div class = "box-header with-border">
                <h3 class = "box-title"> Edit Order  </h3>
              </div>
       
              <div class = "box-body">

                  <div class = "col-md-6">
                       <div class="form-group">
                        <label for="exampleInputEmail1">Customer Name</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                          </div>
                          <input type="text" class="form-control" name = "txtcustomer" value = "<?php echo $customer_name; ?>" placeholder="Enter Customer Name" required>
                        </div>
                      </div>
                  </div>

                  <div class = "col-md-6">
                    <div class="form-group">
                      <label>Date:</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name = "orderdate" value = "<?php echo $order_date; ?>">
                    </div>
                    <!-- /.input group -->
                    </div>
                  </div>


              </div> <!-- This is for customer and date -->
                 
              <div class = "box-body">
                <div class = "col-md-12">
                  <div style = "overflow-x:auto;">
                  <table id = "producttable"  class = "table table-striped">
                    <thead>
                       <tr>
                 
                          <th> # </th>
                          <th> Search Product </th>
                          <th> Stock </th>
                          <th> Price </th>
                          <th> Enter Quantity </th>
                          <th> Total </th>
                          <th>
                               <center> <button type = "button" name = "add" class = "btn btn-success btn-sm btnadd" role = "button">  <span class = "glyphicon glyphicon-plus"> </span> </button>  </center>

                          </th>
                 
                 
                       </tr>
                    </thead>

                    <?php

                        foreach($row_invoice_details as $item_invoice_details){
                        $select = $pdo->prepare("select * from tbl_product where pid = '{$item_invoice_details['product_id']}'");
                        $select->execute();
                        $row_product = $select->fetch(PDO::FETCH_ASSOC);
 
                    ?>

                    <tr>
                      <?php

                          echo  '<td> <input type="hidden" class="form-control pname" name = "productname[]" readonly> </td>';

                          echo '<td> <select style = "width:250px;"  class="form-control productidedit" name = "productid[]"> <option value = ""> Select Option  </option> <'.fill_product($pdo,$item_invoice_details['product_id']).' </select> </td>';

                          echo '<td> <input type="text" value = "'.$row_product['pstock'].'" class="form-control stock" name = "stock[]" readonly> </td>';

                          echo '<td> <input type="text" value = "'.$row_product['saleprice'].'"  class="form-control price" name = "price[]" readonly> </td>';

                          echo '<td> <input type="number"  value = "'.$item_invoice_details['qty'].'"  min = "1" class="form-control qty" name = "qty[]"> </td>';

                          echo '<td> <input type="text" value = "'.$row_product['saleprice']*$item_invoice_details['qty'].'" class="form-control total" name = "total[]" readonly> </td>';

                          echo '<td> <center> <button type = "button" name = "remove" class = "btn btn-danger btn-sm btnremove" role = "button">  <span class = "glyphicon glyphicon-remove"> </span> </button> </center> </td>';

                      ?>
                    </tr>

                  <?php } ?>
                  </table>
                  </div>
                 </div>
               </div> <!-- This is for table -->
               
              <div class = "box-body">

                  <div class = "col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">SubTotal</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                          </div>
                      <input type="text" id = "txtsubtotal" value = "<?php echo $subtotal; ?>" class="form-control" name = "txtsubtotal" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tax(5%)</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                          </div>
                      <input type="text" class="form-control" id = "txttax" name = "txttax" value = "<?php echo $tax; ?>" readonly>
                    </div>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Discount</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                          </div>
                      <input type="text" class="form-control" value = "<?php echo $discount; ?>"  id = "txtdiscount" name = "txtdiscount" required>
                    </div>
                    </div>




                  </div>


                  <div class = "col-md-6">


                    <div class="form-group">
                      <label for="exampleInputEmail1">Total</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                          </div>
                      <input type="text" class="form-control" value = "<?php echo $total; ?>" id = "txttotal" name = "txttotal" readonly>
                    </div>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Paid</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                          </div>
                      <input type="text" class="form-control" value = "<?php echo $paid; ?>" id = "txtpaid" name = "txtpaid" required>
                    </div>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Due</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                          </div>
                      <input type="text" class="form-control" id = "txtdue" value = "<?php echo $due; ?>" name = "txtdue" readonly>
                    </div>
                    </div>

                    <label> Payment Method </label>
                    <div class="form-group">

                        <label>
                          <input type="radio" name="rb" class="minimal-red" value = "Cash"<?php echo ($payment_type=='Cash')?'checked':''?>> CASH
                        </label>
                        <label>
                          <input type="radio" name="rb" class="minimal-red" value = "Card"<?php echo ($payment_type=='Card')?'checked':''?>> CARD
                        </label>
                        <label>
                          <input type="radio" name="rb" class="minimal-red" value = "Cheque"<?php echo ($payment_type=='Cheque')?'checked':''?>> CHEQUE
                         
                        </label>
                    </div>




                  </div>





                </div>  <!-- tax, dicount, etc -->

                <hr>

                <div align = "center">
                    <input type = "submit" name = "btneditorder" value = "Update Order" class = "btn btn-warning">
                </div> <br>
             
            </form>
           
           
          </div>
     
    </section>
    <!-- /.content -->
  </div>


  <script>
     //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })


    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })


    $(document).ready(function(){

      $('.productidedit').select2()

          $('.productidedit').on('change', function(e){
              var productid = this.value;
              var tr=$(this).parent().parent();

              $.ajax({
                  url:"getproduct.php",
                  method:"get",
                  data:{id:productid},
                  success:function(data){
                    console.log(data);
                      tr.find(".pname").val(data["pname"]);
                      tr.find(".stock").val(data["pstock"]);
                      tr.find(".price").val(data["saleprice"]);
                      tr.find(".qty").val(1);
                      tr.find(".total").val(tr.find(".qty").val() *  tr.find(".price").val());
                      calculate(0,0);
                  }
              })

          })
        $(document).on('click','.btnadd',function(){
          var html='';
          html+='<tr>';
          html+='<td> <input type="hidden" class="form-control pname" name = "productname[]" readonly> </td>';
          html+='<td> <select style = "width:250px;"  class="form-control productid" name = "productid[]"> <option value = ""> Select Option  </option> <?php echo fill_product($pdo,'') ?> </select> </td>';
          html+='<td> <input type="text" class="form-control stock" name = "stock[]" readonly> </td>';
          html+='<td> <input type="text" class="form-control price" name = "price[]" readonly> </td>';
          html+='<td> <input type="number" min = "1" class="form-control qty" name = "qty[]"> </td>';
          html+='<td> <input type="text" class="form-control total" name = "total[]" readonly> </td>';

          html+='<td> <center> <button type = "button" name = "remove" class = "btn btn-danger btn-sm btnremove" role = "button">  <span class = "glyphicon glyphicon-remove"> </span> </button> </center> </td>';

       

          $('#producttable').append(html);

          //Initialize Select2 Elements
          $('.productid').select2()

          $('.productid').on('change', function(e){
              var productid = this.value;
              var tr=$(this).parent().parent();

              $.ajax({
                  url:"getproduct.php",
                  method:"get",
                  data:{id:productid},
                  success:function(data){
                    console.log(data);
                      tr.find(".pname").val(data["pname"]);
                      tr.find(".stock").val(data["pstock"]);
                      tr.find(".price").val(data["saleprice"]);
                      tr.find(".qty").val(1);
                      tr.find(".total").val(tr.find(".qty").val() *  tr.find(".price").val());
                      calculate(0,0);
                  }
              })

          })

        })

        $(document).on('click','.btnremove',function(){

            $(this).closest('tr').remove();
            calculate(0,0);
            $("#txtpaid").val(0);

        })

       $("#producttable").delegate(".qty","keyup change" ,function(){
       
      var quantity = $(this);
       var tr = $(this).parent().parent();
       
    if((quantity.val()-0)>(tr.find(".stock").val()-0) ){
       
       swal("WARNING!","SORRY! This much of quantity is not available","warning");
       
        quantity.val(1);
       
         tr.find(".total").val(quantity.val() *  tr.find(".price").val());
        calculate(0,0);
       }else{
           
           tr.find(".total").val(quantity.val() *  tr.find(".price").val());
           calculate(0,0);
       }    
       
       
       
    })    
     
       
     function calculate(dis,paid){
         
    var subtotal=0;
    var tax=0;
    var discount = dis;    
    var net_total=0;
    var paid_amt=paid;
 var due=0;
         
         
   $(".total").each(function(){
       
    subtotal = subtotal+($(this).val()*1);    
       
    })
         
          tax = 0.05*subtotal;
          net_total = tax+subtotal;
          net_total = net_total-discount;
          due = net_total-paid_amt;    
         
   
          $("#txtsubtotal").val(subtotal.toFixed(2));
          $("#txttax").val(tax.toFixed(2));
          $("#txttotal").val(net_total.toFixed(2));
          //$("#txttotal").val(net_total.toFixed(2));
          $("#txtdiscount").val(discount);
          $("#txtdue").val(due.toFixed(2));
 
         
         
     }// function calculate end here
       
      $("#txtdiscount").keyup(function(){
            var discount = $(this).val();
            calculate(discount,0);

        })
       
      $("#txtpaid").keyup(function(){
            var paid = $(this).val();
            var discount = $("#txtdiscount").val();
            calculate(discount,paid);

        })  
       
       
       
    });
  </script>

 
  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>

