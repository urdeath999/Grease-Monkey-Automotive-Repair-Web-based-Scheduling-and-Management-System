<?php
session_start();
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Hello, world!</h1>

    

    <div class="container">
    <?php include('mess.php'); ?>

  
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Appointment

                        <a href="appoint.html" class="btn btn-danger float-end"> BACK</a>
                    </h3>
                    </div>
                    <div class="card-body">
                    
                        <form action="dbcon.php" method="post">

                            <div class="mb-3">
                                <label>Clients</label>
                                <input type="text" name="name" class="form control">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form control">
                            </div>
                            <div class="mb-3">
                                <label>Number</label>
                                <input type="number" name="number" class="form control">
                            </div>
                            <div class="mb-3">
                                <label>date</label>
                                <input type="date" name="date" class="form control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="appointment" class="btn btn-primary">Appoint! </button>
                            </div>


                        </form>
                    </div>
                </div>
            </div> 

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
</body>
</html>