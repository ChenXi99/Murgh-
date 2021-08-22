<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="link!.css" rel="stylesheet">
    <title>Offer</title>
</head>
<body>

    <!-- Head[Start] -->
    <header>
        <nav class="container_wrap">
          <div class="container">
          <div class="navbar-header"><a class="a_nav" href="../top.html"><img src="../link.png" class="icon" alt=""></a></div>
          <div class="navbar-header"><a class="a_nav" href="rank.php">Rank!</a></div>
          <div class="navbar-header"><a class="a_nav" href="community.php">Community</a></div>
          <div class="navbar-header"><a class="a_nav" href="prof.php">Profile</a></div>
          </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

<h1>Recruit!</h1>
    <form method="POST" action="insert_r.php">
    <div><label>Job Description<br><textarea type="text" cols="50" rows="3" name="description"></textarea></label></div>
    <div><label>Hashtags<br>
        <input type="checkbox" name="tag" value="poultry"> #poultry
        <input type="checkbox" name="tag" value="topfarmer"> #topfarmer
        <input type="checkbox" name="tag" value="welcomebeginners"> #welcomebeginners
        <input type="checkbox" name="tag" value="others"> Others: 
        #<input type="text" name="tag"> 
    </div>

        <table>
        <tr><td>Staffs:</td><td><input type="text" name="staffs">person</td></tr>
            <td>From:</td><td><input type="date" name="date_from"></td></tr>
            <td>Until:</td><td><input type="date" name="date_until"></td></tr>
            <tr><td>Salary:</td><td><input type="text" name="salary">Rs./day</td><tr>
            
            
        </table>
        <div>
            <div><label>Notes<br><textarea type="text" cols="50" rows="2" name="notes"></textarea></label></div>

            <input type="submit" class="btn" value="UPLOAD">
            <a style="display:block; text-align:center; margin-bottom:30px;" href="recruit_view.php">View Image</a>
            <br>
        </div>
        
    </form>
    
</body>
</html>