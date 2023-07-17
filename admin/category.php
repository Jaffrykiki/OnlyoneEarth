<?php
include("sidebar.php");
include("includes/header.php");
include('../funtion/myfuntion.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <div class="card">
        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
            <h1 class="h5">Category</h1>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>name</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                                $category = getAll("table_product_category");

                                if(mysqli_num_rows($category) > 0 )
                                {
                                    foreach($category as $item)
                                    {
                                        ?>
                                        <tr>
                                        <td> <?= $item['Cat_id'];  ?></td>
                                        <td> <?= $item['Name'];  ?></td>
                                        <td>
                                            <a href="edit-category.php?id=<?= $item['Cat_id'];  ?>" class="btn btn-primary">Edit</a>
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No record found";
                                }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </main>
    </div>


</body>

</html>

<?php include("includes/script.php"); ?>