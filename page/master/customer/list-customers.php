<?php
    include('koneksi.php');
    
    $select_customer	= mysqli_query($koneksi, "SELECT * FROM customer");
    $num_customer		= mysqli_num_rows($select_customer);

    if(isset($_POST['regis-customer'])){
        $name		= mysqli_real_escape_string($koneksi, $_POST['name_customer']);
        $email		= mysqli_real_escape_string($koneksi, $_POST['email']);
        $phone		= mysqli_real_escape_string($koneksi, $_POST['phone']);
        $address	= mysqli_real_escape_string($koneksi, $_POST['address']);

        if($name == '' || $email == '' || $phone == '' || $address == ''){
            echo "<div class='alert alert-danger'>Form Registrasi Tidak Boleh Kosong!</div>"; 
        }else{
            $sql = "INSERT INTO customer (name_customer, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
            $query = mysqli_query($koneksi, $sql);
            if($query){
                echo "<div class='alert alert-success'>Registrasi Berhasil!</div>";
            }else{
                echo "<div class='alert alert-danger'>Registrasi Gagal!</div>";
            }
        }
        header('Location: index.php?page=master/customer/list-customers');
    }
?>

<style>
    select{
        padding: 7px;
    }

    input[type=text] {
    background-color: white;
    padding: 5px 5px 5px 10px;
    margin-bottom: 8px;
    
    }

    table, th, td {
    border: 1px solid #ddd;
    }

    table{
        width: 100%;
    }

    th {
    font-weight: bold;
    border: none;
    
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
        }

    th, td {
    padding: 10px;
    text-align: center;
    }

    .hidetext { -webkit-text-security: disc; /* Default */ }

</style>

<div class="list-jenis">
    <div class="row">
        <section class="panel panel-default">
            <div class="col-sm-12">
                <section class="panel panel-default">
                    <div class="panel panel-heading">List Customer</div>
                    <div class="panel panel-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#regis-c"> + Tambahkan </button>
                        <br /> <br />
                        <!-- model -->
                        <div class="modal fade" id="regis-c" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="modal-title">Tambahkan Customer</h3>
                                    </div>
                                    <!-- form tambaha -->
                                    <form action="" method="POST" autocomplete="off">
                                        <div class="modal-body">
                                            <p>
                                                <label for="name_customer">Name</label><br />
                                                <input class="form-control" name="name_customer" id="name_customer" type="text" required />
                                            </p>
                                            <p>
                                                <label for="email">Email</label><br />
                                                <input class="form-control" name="email" id="email" type="text" required />
                                            </p>
                                            <p>
                                                <label for="phone">Phone</label><br />
                                                <input class="form-control" name="phone" id="phone" type="number" required />
                                            </p>
                                            <p>
                                                <label for="address">Alamat</label><br />
                                                <input class="form-control" name="address" id="address" type="text" required />
                                            </p>
                                        </div>
                                        <div class="modal-footer">  
                                            <button type="close" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                            <button type="submit" class="btn btn-primary" name="regis-customer">ADD</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end model -->
                        <table id="list-user" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    while($row = mysqli_fetch_array($select_customer)){
                                ?>
                                <tr>
                                    <td><?=$no++; ?></td>
                                    <td><?=$row['id_customer']; ?></td>
                                    <td><?=$row['name_customer']; ?></td>
                                    <td><?=$row['email']; ?></td>
                                    <td><?=$row['phone']; ?></td>
                                    <td><?=$row['address']; ?></td>
                                    <td>
                                        <a href="index.php?page=master/customer/update-customer&id=<?=$row['id_customer']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="index.php?page=master/customer/delete-customer&id=<?=$row['id_customer']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </section>
    </div>
</div>
