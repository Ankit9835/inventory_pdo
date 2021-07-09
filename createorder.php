<?php
  include('connectdb.php');
  session_start();

  function fill_product($pdo){

      $output = '';

      $select = $pdo->prepare("select * from tbl_product order by pname");
      $select->execute();

      $result = $select->fetchall();

      foreach($result as $row){
        $output.= '<option value = "'.$row["pid"].'"> '.$row["pname"].' </option>';
      }

      return $output;
  }

  if(isset($_POST['btnsaveorder'])){

        $custname = $_POST['txtcustomer'];
        $date = date('Y-m-d',strtotime($_POST['orderdate']));
        $subtotal = $_POST['txtsubtotal'];
        $tax = $_POST['txttax'];
        $discount = $_POST['txtdiscount'];
        $total = $_POST['txttotal'];
        $paid = $_POST['txtpaid'];
        $due = $_POST['txtdue'];
        $payment_method = $_POST['rb'];
        //////////////////////////////////


        $arr_productid = $_POST['productid'];
        $arr_productname = $_POST['productname'];
        $arr_stock = $_POST['stock'];
        $arr_qty = $_POST['qty'];
        $arr_price = $_POST['price'];
        $arr_order_date = $_POST['total'];






        $insert = $pdo->prepare("insert into tbl_invoice(customer_name, order_date, subtotal, tax, discount, total, paid, due, payment_type)values(:cname,:orderdate,:subtotal,:tax,:discount,:total,:paid,:due,:payment_type)");

        $insert->bindparam(':cname',$custname);
        $insert->bindparam(':orderdate',$date);
        $insert->bindparam(':subtotal',$subtotal);
        $insert->bindparam(':tax',$tax);
        $insert->bindparam(':discount',$discount);
        $insert->bindparam(':total',$total);
        $insert->bindparam(':paid',$paid);
        $insert->bindparam(':due',$due);
        $insert->bindparam(':payment_type',$payment_method);

        $insert->execute();

        $invoice_id = $pdo->lastInsertId();

        if($invoice_id!=null){
          for($i=0; $i<count($arr_productid); $i++){

            $rem_qty =  $arr_stock[$i] -  $arr_qty[$i];
            if($rem_qty<0){
              return "Order Not Complete";
            }  else {
              $update = $pdo->prepare("update tbl_product set pstock ='$rem_qty' where pid='".$arr_productid[$i]."' ");
              $update->execute();
            }

            $insert = $pdo->prepare("insert into tbl_invoice_details(invoice_id,product_id,product_name,qty,price,order_date)values(:invid,:pid,:pname,:qty,:price,:order)");

            $insert->bindparam(':invid',$invoice_id);
            $insert->bindparam(':pid',$arr_productid[$i]);
            $insert->bindparam(':pname',$arr_productname[$i]);
            $insert->bindparam(':qty',$arr_qty[$i]);
            $insert->bindparam(':price',$arr_price[$i]);
            $insert->bindparam(':order', $date);

            $insert->execute();

          }

          //echo "Inserted SuccessFully";
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
      <h1>Create Order <small>it all starts here</small></h1>
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
                <h3 class = "box-title"> New Order  </h3>
              </div>
       
              <div class = "box-body">

                  <div class = "col-md-6">
                       <div class="form-group">
                        <label for="exampleInputEmail1">Customer Name</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                          </div>
                          <input type="text" class="form-control" name = "txtcustomer" placeholder="Enter Customer Name" required>
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
                      <input type="text" class="form-control pull-right" id="datepicker" name = "orderdate" value = "<?php echo date("Y-m-d") ?>" data-date-format = "yyyy-mm-dd">
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
                      <input type="text" id = "txtsubtotal" class="form-control" name = "txtsubtotal" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tax(5%)</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                          </div>
                      <input type="text" class="form-control" id = "txttax" name = "txttax" readonly>
                    </div>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Discount</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                          </div>
                      <input type="text" class="form-control"  id = "txtdiscount" name = "txtdiscount" required>
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
                      <input type="text" class="form-control" id = "txttotal" name = "txttotal" readonly>
                    </div>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Paid</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                          </div>
                      <input type="text" class="form-control" id = "txtpaid" name = "txtpaid" required>
                    </div>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Due</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                          </div>
                      <input type="text" class="form-control" id = "txtdue" name = "txtdue" readonly>
                    </div>
                    </div>

                    <label> Payment Method </label>
                    <div class="form-group">

                        <label>
                          <input type="radio" name="rb" class="minimal-red" value = "Cash" checked> CASH
                        </label>
                        <label>
                          <input type="radio" name="rb" class="minimal-red" value = "Card"> CARD
                        </label>
                        <label>
                          <input type="radio" name="rb" class="minimal-red" value = "Cheque"> CHEQUE
                         
                        </label>
                    </div>




                  </div>





                </div>  <!-- tax, dicount, etc -->

                <hr>

                <div align = "center">
                    <input type = "submit" name = "btnsaveorder" value = "Save Order" class = "btn btn-info">
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
        $(document).on('click','.btnadd',function(){
          var html='';
          html+='<tr>';
          html+='<td> <input type="hidden" class="form-control pname" name = "productname[]" readonly> </td>';
          html+='<td> <select style = "width:250px;"  class="form-control productid" name = "productid[]"> <option value = ""> Select Option  </option> <?php echo fill_product($pdo) ?> </select> </td>';
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

