<?php 
  include('connectdb.php');
  session_start();
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
      <h1>Product List <small>it all starts here</small></h1>
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
                  
                    <th> Product Name </th>
                    <th> Category </th>
                    <th> Purchase Price </th>
                    <th> Sale Price </th>
                    <th> Stock </th>
                    <th> Description </th>
                    <th> Product Image </th>
                    <th> VIEW </th>
                    <th> EDIT </th>
                    <th> DELETE </th>
                 
                </tr>
            </thead>
            <tbody>
             <?php 
                  $select = $pdo->prepare("select * from tbl_product order by pid desc");
                  $select->execute();

                  while($row = $select->fetch(PDO::FETCH_OBJ)){

                    echo '

                      <tr>
                        <td>' . $row->pname . '</td>
                        <td>' . $row->pcategory . '</td>
                        <td>' . $row->purchaseprice . '</td>
                        <td>' . $row->saleprice . '</td>
                        <td>' . $row->pstock . '</td>
                        <td>' . $row->pdescription . '</td>
                        <td> <img src = "productimage/'.$row->pimage.'" class = "img-rounded" width = "60px" height = "50px"> </td>

                        <td> <a href = "viewproduct.php?id='.$row->pid.'" class = "btn btn-success" role = "button">  <span class = "glyphicon glyphicon-eye-open" data-toggle = "tooltip" style = "color:black;" title = "view product"> </span> </a>    </td>

                       <td> <a href = "editproduct.php?id='.$row->pid.'" class = "btn btn-info" role = "button">  <span class = "glyphicon glyphicon-edit" data-toggle = "tooltip" style = "color:black;" title = "edit product"> </span> </a>    </td>
                        
                         <td> <button id = '.$row->pid.' class = "btn btn-danger btndelete" role = "button">  <span class = "glyphicon glyphicon-trash" data-toggle = "tooltip" style = "color:black;" title = "delete product"> </span> </button>    </td>
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
  </script>

  <script>
    $(document).ready(function(){
        $('.btndelete').click(function(){
              //alert('Test');

              var tdh = $(this);
              var id = $(this).attr("id");


              swal({
                    title: "Are you sure to delete this product?",
                    text: "Once deleted, you will not be able to recover this Product Data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {

                       $.ajax({

                              url:'productdelete.php',
                              type:'post',
                              data:{
                                  pidd:id
                                },
                              success: function(data){
                                tdh.parents('tr').hide();
                              }

                          });


                      swal("Poof! Your Product Data has been deleted!", {
                        icon: "success",
                      });
                    } else {
                      swal("Your Product Data is safe!");
                    }
                  });

              //alert(id);

             


        });

    });
  </script>



  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>