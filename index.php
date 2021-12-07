<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <style>
        .sidebar{ 
            background-color: #ddd;
            height: 100vh;
        }
        .authordata div, .booksdata div{
            columns: 4;
        }
    </style>    
</head>
<body>

<?php
    $conn = new mysqli('localhost', 'root', '', 'test')or die('DB Not Connected');
?>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-start row">
                    <div class="col-2 sidebar p-0">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Dashboard</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Authors</button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Books</button>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="tab-content" id="v-pills-tabContent">


                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="datacount">
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <h2>Authors</h2>
                                            <p>
                                                <?php 
                                                $authors = "SELECT * from authors";
                                                $result = $conn->query($authors);
                                                $authorsCount = mysqli_num_rows($result);
                                                    echo '<h3>'.$authorsCount.'</h3>';
                                                ?>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <h2>Books</h2>
                                            <p>
                                                <?php 
                                                    $books = "SELECT * from books";
                                                    $resultBook = $conn->query($books);
                                                    $booksCount = mysqli_num_rows($resultBook);
                                                    echo '<h3>'.$booksCount.'</h3>';
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row px-5 mt-5">
                                        <div class="col-12">
                                            
                                            <table id="datashow1" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Authors</th>
                                                        <th>Books</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $key = 0;
                                                        $select = "SELECT *,count(authors)as total_author FROM `books` GROUP BY authors order BY total_author desc limit 3";
                                                        $resultTop = $conn->query($select);
                                                        while($fetchTop = $resultTop->fetch_assoc())
                                                        {
                                                            $key++;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $key;?></td>
                                                            <td><?php echo $fetchTop['authors'];?></td>
                                                            <td><?php echo $fetchTop['total_author'];?></td>

                                                        </tr>
                                                    <?php
                                                        }
                                                    ?>        
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <h2 class="mb-4 text-center">Authors</h2>
                                <div class="row px-5 mt-5">
                                        <div class="col-12">
                                            
                                        <table id="datashow2" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Authors</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                            $author = "SELECT * from authors";
                                                            $resultAuthors = $conn->query($author);
                                                            while($fetchAuthors = $resultAuthors->fetch_assoc())
                                                            {
                                                        ?>
                                                
                                                            <tr>
                                                                <td><?php echo $fetchAuthors['id']?></td>
                                                                <td><?php echo $fetchAuthors['name']?></td>
                                                            </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <h2 class="mb-4 text-center">Books</h2>
                                <div class="row">
                                    <div class="col-12">
                                        <table id="datashow3" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Authors</th>
                                                    <th>Status</th>
                                                    <th>Publish Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $books = "SELECT * from books";
                                                    $resultBook = $conn->query($books);
                                                    while($fetchBook = $resultBook->fetch_assoc())
                                                    {
                                                ?>
                                        
                                                    <tr>
                                                        <td><?php echo $fetchBook['id']?></td>
                                                        <td><?php echo $fetchBook['title']?></td>
                                                        <td><?php echo $fetchBook['authors']?></td>
                                                        <td><?php echo $fetchBook['status']?></td>
                                                        <td><?php echo date('Y-m-d', strtotime($fetchBook['publishedDate']))?></td>

                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/jquery.js"></script>
    <script src="js/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="js/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#datashow1').DataTable( {
               
            } );

            $('#datashow2').DataTable( {
               
            } );

            $('#datashow3').DataTable( {
               
            } );
        } );
    </script>
</body>
</html>