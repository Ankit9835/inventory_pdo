<?php 
  include('connectdb.php');
  session_start();
  include('layout/header.php'); 
  if($_SESSION['username'] == ''){
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
      <h1>Order List <small>it all starts here</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class = "box box-info">
            <div class = "box-header with-border">
             
            </div>
        
            <div class = "box-body">
              
                 <div style = "overflow-x:auto;">
               <table id = "example1" class = "table table-striped">
            <thead>
                <tr>
                  
                    <th> Invoice Id </th>
                    <th> Customer Name </th>
                    <th> Order Date </th>
                    <th> Subtotal </th>
                    <th> Tax </th>
                    <th> Discount </th>
                    <th> Total </th>
                    <th> Paid </th>
                    <th> Due </th>
                    <th> Payment_Type </th>
                    <th> Print </th>
                    <th> Edit </th>
                    <th> Delete </th>
                 
                </tr>
            </thead>
            <tbody>
             <?php 
                  $select = $pdo->prepare("select * from tbl_invoice order by invoice_id desc");
                  $select->execute();

                  while($row = $select->fetch(PDO::FETCH_OBJ)){

                    echo '

                      <tr>
                        <td>' . $row->invoice_id . '</td>
                        <td>' . $row->customer_name . '</td>
                        <td>' . $row->order_date . '</td>
                        <td>' . $row->subtotal . '</td>
                        <td>' . $row->tax . '</td>
                        <td>' . $row->discount . '</td>
                        <td>' . $row->total . '</td>
                        <td>' . $row->paid . '</td>
                        <td>' . $row->due . '</td>
                        <td>' . $row->payment_type . '</td>

                        <td> <a target = "_blank" href = "invoice_80mm.php?id='.$row->invoice_id.'" class = "btn btn-warning" role = "button">  <span class = "glyphicon glyphicon-print" data-toggle = "tooltip" style = "color:black;" title = "Print Invoice"> </span> </a>    </td>

                       <td> <a href = "editorder.php?id='.$row->invoice_id.'" class = "btn btn-info" role = "button">  <span class = "glyphicon glyphicon-edit" data-toggle = "tooltip" style = "color:black;" title = "Edit Product"> </span> </a>    </td>
                        
                         <td> <button id = '.$row->invoice_id.' class = "btn btn-danger btndelete" role = "button">  <span class = "glyphicon glyphicon-trash" data-toggle = "tooltip" style = "color:black;" title = "Delete Product"> </span> </button>    </td>
                      </tr>

                    ';
                  }
             ?>
               
            </tbody>
          </table>
          </div>
               
              
               
             
            </div>
            <div class = "box-footer">
              
            </div>
            
          </div>
     
    </section>
    <!-- /.content -->
  </div>


  <!--Data-toogle Method -->
  <script>
    $(document).ready(function (){
      $('[data-toogle="tooltip"]').tootip();
    })


    $(document).ready(function(){
        $('.btndelete').click(function(){
              //alert('Test');

              var tdh = $(this);
              var id = $(this).attr("id");


              swal({
                    title: "Are you sure to delete this Order?",
                    text: "Once deleted, you will not be able to recover this Order Data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {

                       $.ajax({

                              url:'orderdelete.php',
                              type:'post',
                              data:{
                                  pidd:id
                                },
                              success: function(data){
                                tdh.parents('tr').hide();
                              }

                          });


                      swal("Poof! Your Order Data has been deleted!", {
                        icon: "success",
                      });
                    } else {
                      swal("Your Order Data is safe!");
                    }
                  });

              //alert(id);

             


        });

    });
  </script>

  
  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>