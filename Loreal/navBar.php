<html>
    <head>
        <titLe> HaDa </titLe>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
        <script src='jquery-3.2.1.min.js'></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <style>
        html, body {
            margin: 0;
            height: 100%;
        }
        #navBar{
            background-color: #e1a566;
        }
        #logo{
            height:60px;
        }
        #searchBar{
            margin-top:12px;
        }
        #icon{
            margin-top:20px;
            color: white;
        }
        #HairDex{
            color:white;
            margin-top:-2px;
            font-family: 'Arvo', serif;
        }
        .link{
            margin-top: 18px;
            color:white;
            font-family: 'Arvo', serif;
        }
        .vl {
            border-left: 4px solid white;
            border-radius:5px;
            height: 60px;
        }
        .link > a:hover{
            color: black;
            text-decoration: none;
        }
        .link > a{
            color: white;
        }
        .image{
            display: inline;
            width: 229px;
            height: 239px;
            border-radius: 5px;
        }
        .image:hover{
             border: 3px solid crimson;
        }
        .style{
            color: black;
        }
        #searchCon{
            background-color: #e1a566;
            border-color:  #e1a566;
        }
        .imageModal{
            display: inline;
            width: 229px;
            height: 239px;
            border-radius: 5px;
        }
        .imageView{
            display: inline;
            width: 229px;
            height: 239px;
            border-radius: 5px;
        }
        
    </style>
    <body>
        <div class='row'  id='navBar'>
                <div class='col-md-1'>
                    <a href="Home.php">
                    <img src='images/CaptureFinal.png' id='logo'>
                    </a>
                </div>
                <div class='col-md-1 link' id='HairDex'>
                    <a href="Home.php">
                    <h2> HairDex </h2>
                    </a>
                </div>
                <div class='col-md-1 col-md-offset-1 link'>
                    <a href="Home.php">
                        <h4> Home </h4>
                    </a>
                </div>
                
                <div class='col-md-1 link'>
                    <a href="add.php">
                        <h4> Add <span class='glyphicon glyphicon-plus'> </h4>
                    </a>
                </div>
                
                <div class='col-md-2 link'>
                    <a href="Customers.php">
                        <h4>Customers</h4>
                    </a>
                    
                </div>
                    
                <form method="post" action="Search.php">
                    <div class='col-md-3 col-md-offset-1' id='searchBar'>
                        <input type='text' class='form-control' placeholder="Search..." name="search">
                    </div>
                    <div class='col-md-1'>
                        <button type="submit" class='btn btn-primary' id='searchCon' name="searchBtn">
                            <span class='glyphicon glyphicon-search' id='icon'  id='search'></span>
                        </button>
                        
                    </div>
                </form>
        </div>
            
    </body>
</html>

<script>
    $(document).ready(function(){
       // alert("ready");
    });
</script>