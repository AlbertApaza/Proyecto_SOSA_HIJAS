
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .productos {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .producto {
            position: relative;
            width: 300px;
            height: 200px;
            margin: 10px;
            overflow: hidden;
            cursor: pointer;
            background-color: #333;
            color: #fff;
        }
        .producto img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .producto:hover img {
            transform: scale(1.1);
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.5s;
        }
        .producto:hover .overlay {
            opacity: 1;
        }
        .overlay-text {
            text-align: center;
        }
        .overlay-text h3 {
            margin: 0;
            font-size: 24px;
            color: #fff;
        }
        .overlay-text a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background: #fff;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }
        .overlay-text a:hover {
            background: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="productos">
      <?php foreach($datos as $dato){ ?>
              <div class="producto">
                  <img src="IMAGENES/<?php echo $dato['imagenprincipal'] ?> " alt="Grúas Articuladas">
                  <div class="overlay">
                      <div class="overlay-text">
                          <h3><?php echo $dato['nombre'] ?> </h3>
                          <a href="index.php?action=detalle-maquinaria&idmaquinaria=<?php echo $dato['idmaquinaria'] ?>">Ver productos</a>
                      </div>
                  </div>
              </div>
       <?php } ?>
        
        
      
    </div>

    <?php include("VIEW/footer.php"); ?>

</body>
</html>
