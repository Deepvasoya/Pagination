<?php
#database connection
$conn = mysqli_connect("localhost", "root", "", "pagination") or die("Not connect" . mysqli_connect_error());
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Pagination</title>
</head>

<body>
    <div class="container my-5">
        <h1>All Student</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>



            <?php
            #get page value from link
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }


            #set limit
            $limit = 6;

            #set offset
            $offset = ($page - 1) * $limit;

            $sql = "SELECT * FROM `student` LIMIT {$offset}, {$limit}";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result)  > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

            ?>

                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $row['id']; ?></th>
                            <td><?php echo $row['Name']; ?></td>

                        </tr>

                    </tbody>
            <?php
                }
            }

            ?>
        </table>



        <! –– Pagination ––>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">

                    <?php
                    #Previous
                    if ($page > 1) {
                        echo ' <li class="page-item">
                    <a class="page-link" href="index.php?page=' . ($page - 1) . '" tabindex="-1" aria-disabled="true">Previous</a>
                </li>';
                    }
                    ?>




                    <?php

                    $sql1 = "SELECT * FROM `student`";
                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1)  > 0) {

                        $total_record = mysqli_num_rows($result1);
                        $total_page = ceil($total_record / $limit);

                        for ($i = 1; $i <= $total_page; $i++) {

                            #for activee page class
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }

                    ?>


                            <li class="page-item <?php echo $active; ?>"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                    <?php
                        }
                    }
                    ?>

                    <?php
                    #Next
                    if ($total_page > $page) {
                        echo '<li class="page-item">
                    <a class="page-link" href="index.php?page=' . ($page + 1) . '">Next</a>
                </li>';
                    }
                    ?>

                </ul>
            </nav>
    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>