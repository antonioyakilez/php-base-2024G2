<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../templates/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../templates/AdminLTE-3.0.5/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../templates/AdminLTE-3.0.5/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="sidebar-collapse sidebar-mini">

<?php include "includes/config.php"; ?>

<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand <?php echo $headerStyle; ?>">
    <?php 
      include "includes/header.php";
    ?>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar <?php echo $lateralStyle; ?> elevation-4">
    <?php 
    include "includes/lateralaside.php";
     ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Titulo Página</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">titulo Corto</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <!-- LISTA DE CATEGORIAS-->
    <div class="row pb-3">
      <div class="col-12">
        <select name="Categorias" id="Categorias" class="form-control" onchange="loadProducts()">
          <option value="0" selected>Filtrar por categoria</option>
        </select>
      </div>
    </div>

    <!-- LISTA DE PRODUCTOS -->
    <div class='row' id="productid"> 
    
 
    </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <?php 
      include "includes/footer.php";
     ?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../templates/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../templates/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../templates/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="../templates/AdminLTE-3.0.5/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="../templates/AdminLTE-3.0.5/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../templates/AdminLTE-3.0.5/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../templates/AdminLTE-3.0.5/dist/js/demo.js"></script>


<script>
    const loadProducts = () => {
        var categ = document.getElementById("Categorias");
        if(categ.selectedIndex > 0){
            Productos(categ.options[categ.selectedIndex].value);
        }
    }

    const Productos = async (params) =>  {
        //alert(params);
        //Cargar los productos basados en la categoria seleccionada, la cual llega por PARAMS
        //https://fakestoreapi.com/products/category/electronics

    }


</script>

<script>
    const loadSelectCategorias = async(datos)=> {        
        var select = document.getElementById("Categorias");
        var option = document.createElement("option");
        datos.forEach(category => {            
            var option = document.createElement('option');
            var optionText = document.createTextNode(category);
            option.appendChild(optionText)
            option.setAttribute('value',category);
            select.appendChild(option); 
        })        
    }
        
    const Categorias = async (params) => {
        const json = {
            continente:params,
        } 
        try {                                    
            fetch("https://fakestoreapi.com/products/categories", {             
                method: "GET",
                headers: {
                    Accept: "application/json", 
                    "Content-Type": "application/json",
                }
            }).then((response) => response.json())
                .then((datos) => {  
                    loadSelectCategorias(datos);
                });
        } catch (error) {
            console.log("Error fetch Login Interno", error);
        }
        
    }
    Categorias("");
</script>

<script type="text/javascript">
        
    fetch("https://fakestoreapi.com/products" , {
        method:"GET",
        headers: {
            Accept: "application/json", 
            "Content-Type": "application/json"
        }
    }).then((resp) => resp.json())
        .then((datos) => {                            
            let prod =  datos.map(function(product){
                
                document.getElementById("productid").innerHTML += " <div class='col-12 col-sm-6 col-md-4  align-items-stretch'> \
                                                          <div class='card bg-light'> \
                                                          <div class='card-header text-muted border-bottom-0' \
                                                          Categoria \
                                                          </div> \
                                                          <div class='card-body pt-0'> \
                                                            <div class='row'> \
                                                              <div class='col-7'> \
                                                                <h2 class='lead'><b>"+ product.title +"</b></h2> \
                                                                <p class='text-muted text-lg'><b>USD "+ product.price +"</b></b> </p> \
                                                              </div> \
                                                              <div class='col-5 text-center'> \
                                                                <img src='"+ product.image +"' alt='' class='img-circle img-fluid'> \
                                                              </div> \
                                                            </div> \
                                                          </div> \
                                                          <div class='card-footer'> \
                                                            <div class='text-right'> \
                                                              <a href='product_details.php?ref="+ product.id +"' class='btn btn-sm bg-teal'> \
                                                                <i class='fas fa-eye'></i> \
                                                              </a> \
                                                              <a href='#' class='btn btn-sm btn-primary'> \
                                                                <i class='fas fa-user'></i> Cart \
                                                              </a> \
                                                            </div> \
                                                          </div>  \
                                                          </div>  \
                                                           </div> ";

            })                

    })

    </script>

</body>
</html>