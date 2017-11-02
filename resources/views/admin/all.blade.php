@extends('layouts.main')

@section('content')
    <script>
        var validate=prompt("Enter your PIN","");
        if (validate!="970520@dsc") {
            window.location = '/home';
        }
    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin Panel: You are logged in as administrator.</div>

                    <script>
                        function updateUser(userId){//email, username, password, mobile, credit_rating) {
                            //var email=prompt("Updating email",email);
                            //var username=prompt("Updating username",username);
                            //var password=prompt("Updating password",password);
                            //var mobile=prompt("Updating mobile",mobile);
                            //var credit_rating=prompt("Updating credit_rating",credit_rating);

                            //window.location.href =
                            window.location.href = 'admin/editUser/' + userId;

                        }
                        function deleteUser(userId) {
                            window.location.href = 'admin/deleteUser/' + userId;
                        }

                        function newUser(userId) {
                            window.location.href = 'admin/newUser';
                        }

                    </script>

                    <div class="panel-heading">Users</div>

                    <?php

                        echo "<div class='form-group'>
                                    <div class='col-md-8 col-md-offset-4'>
                                        <button type='submit' class='btn btn-primary'
                                        onclick='newUser()'>
                                        Add New User
                                        </button>
                                    </div>
                                </div>";
                        $db = new mysqli('localhost', 'root', 'admin', 'blog');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }
                        $sql = 'SELECT * from users';
                        $results = $db->query($sql);
                        $index = 1;
                        while ($row = $results -> fetch_assoc())
                        {
                            $current_user_id = $row['id'];
                            echo "<strong>".$index."</strong>"; echo " ";
                            echo "Email: ".$row['email'];
                            echo ";User Name: ".$row['username'];
                            echo ";Password: ".$row['password'];
                            echo ";Mobile: ".$row['mobile'];
                            echo ";Credit Rate: ".$row['credit_rating']."<br>";
                            $index++;

                            echo "
                                <div class='form-group'>
                                    <div class='col-md-8 col-md-offset-4'>
                                        <button type='submit' class='btn btn-primary'
                                        onclick='updateUser(".$current_user_id.")'>
                                        Update
                                        </button>
                                        <button type='submit' class='btn btn-primary' onclick='deleteUser(".$current_user_id.")'>
                                        Delete
                                        </button>
                                    </div>
                                </div>";


                        }





                    ?>





                </div>
            </div>
        </div>
    </div>

@endsection