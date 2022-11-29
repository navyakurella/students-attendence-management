<!DOCTYPE html>
<html>

<head>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-image: url("image1.jpg");
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }

        #login_box {
            background-color: antiquewhite;
            height: 68%;
            width: 28%;
            border-radius: 8px;
            box-shadow: 2px 2px rgb(97, 86, 86);
            margin: auto;
            padding: 2%;
            margin-top: 50px
        }

        #signin_header {
            font-size: x-large;
            font-weight: bold;
            font-family: Georgia, 'Times New Roman', Times, serif;
            text-decoration: underline rgb(58, 58, 224);
            padding: 20px 0px;
            align-items: center;
            justify-content: center;
            display: flex;
        }

        #input_box {

            width: 100%;
            padding: 12px 15px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;

        }

        #submit_but {
            margin: auto;
            width: 50%;
            background-color: rgb(4, 4, 251);
            color: aliceblue;
            padding: 12px 20px;
            border-radius: 4px;
            border: 1px solid blue;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #submit_but:hover {
            background-color: rgb(4, 4, 218);

        }

        .error {

            background: #F2DEDE;

            color: #0c0101;

            padding: 10px;

            width: 95%;

            border-radius: 5px;

            margin: 20px auto;

        }
    </style>
</head>

<body>

    <div id="login_box">
        <form action="login.php" method="post">
            <h1 id="signin_header">SIGNIN</h1>
            <label for="username">Username</label>
            <input type="text" placeholder="USERNAME" id="input_box" name="uname"><br>
            <label for="password">Password</label>
            <input type="password" placeholder="PASSWORD" id="input_box" name="password">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <button id="submit_but" type="submit">SUBMIT</button>
            <h8 style="padding-top: 10px; display:inline-block;">Don't have an account? <a href="sign-up.html" style="text-decoration: none; color:blue;font-size:medium;">SIGNUP</a></h8>
        </form>
    </div>
</body>

</html>