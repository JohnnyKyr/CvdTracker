<?php 
    include 'connection.php';
 ?>

<!DOCTYPE HTML>
<html>
  <head>
    <style> #map { height: 500px; }</style>
    

    <?php 
     
      $sql = "SELECT lat,lng FROM coords";
      $result = mysqli_query($connect,$sql);
      if(mysqli_num_rows($result)>0)
        while($row = mysqli_fetch_assoc($result)){
          $help  = $row["lat"];
          $help2 = $row["lng"];

        }
     ?>
    
     
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin="">
   js_varx = "<?php echo $help; ?>"
     js_vary = "<?php echo $help2; ?>"


</script>

    <div id="map" ></div>

  </head>
  
  <body>
  <p id="demo"></p>


    <script>

    class CurrentPossition{
      constructor(poos,zoom){
        this.poos = poos;
        this.zoom = zoom;
      }
    }


    let mycurr = new CurrentPossition([38.25, 21.745],12)
      
      var map = L.map('map').setView(mycurr.poos, mycurr.zoom);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'}).addTo(map);    

    
    L.marker(mycurr.poos).addTo(map);

    L.marker([parseFloat(js_varx),parseFloat(js_vary)]).addTo(map);

     
 
 </script>
  </body>

</html>

