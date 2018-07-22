<?php include "navBar.php";?>
<html>
    <head>
        <title>
            Add Customer
        </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    </head>
    <style>
        .form{
            font-family: 'Arvo', serif;
        }
    </style>
    <body>
        <div class='container-fluid'>
            <div class='col-md-5 col-md-offset-3'>
                <h2 class='form'> Add a Hairstyle </h2> <hr>
                <form class='form' method="POST" action="addCust.php" enctype="multipart/form-data">
                    <div class='form-group'>
                        <label>
                            Upload a Picture
                        </label> <br>
                        <img id="blah" src="#" alt="Your image here..." />
                        <br><br>
                        <input type="file" name="picture" id="file" accept=".jpg, .jpeg, .png,. gif" onchange="readURL(this);"><br>
                                 
                        <span class="textWhite">JPG, JPEG, PNG, or GIF files only</span>
                    </div>
                    <div class='form-group'>
                        <label> Hair style </label> <br>
                        <input type="text" name="title" placeholder="Hair Style" class="form-control"> <br>
                        <label> Customer </label> <br>
                        <input type="text" name="customerName" placeholder="Customer" class="form-control"> <br>
                        <label> Barber </label> <br>
                        <input type="text" name="barberName" placeholder="Barber" class="form-control"><br>
                        <label> Hair Type </label> <br>
                        
                        <select name="type[]">
                            <option value="Straight">Straight</option>
                            <option value="Wavy">Wavy</option>
                            <option value="Curly">Curly</option>
                            <option value="Kinky">Kinky</option>
                        </select> <br><br>
                        
                        <label> Hair Length </label> <br>
                        <select name="length[]">
                            <option value="Short (Above Ear)">
                                Short (Above Ear)
                            </option>
                            <option value="Ear">Ear</option>
                            <option value="Neck">Neck</option>
                            <option value="Shoulder">Shoulder</option>
                            <option value="Armpit">Armpit</option>
                            <option value="Below Shoulder Blade">
                                Below Shoulder Blade
                            </option>
                            <option value="Bra Strap">Bra Strap</option>
                            <option value="Mid-Back">Mid-Back</option>
                            <option value="Waist">Waist</option>
                            <option value="Tailbone">Tailbone</option>
                            <option value="Hip">Hip</option>
                            <option value="Mid-Thigh">Mid-Thigh</option>
                            <option value="Knee">Knee</option>
                        </select> <br><br>
                        
                        <label> Hair Condition </label> <br>
                        <select name="condition[]">
                            <option value="Healthy">Healthy</option>
                            <option value="Unhealthy">Unhealthy</option>
                        </select> <br><br>
                        
                        <label> Original Hair Color </label> <br>
                        <select name="color[]">
                            <option value="Black">Black</option>
                            <option value="Blond">Blond</option>
                            <option value="Brown">Brown</option>
                            <option value="Red">Red</option>
                            <option value="White">White</option>
                        </select> <br>
                        <br>
                        <label> Hair Dye </label> <br>
                        <input type="text" name="dye" placeholder="Dye" class="form-control"><br>
                        <label> Add a description </label>
                        <textarea rows="4" cols="80" placeholder="Hair cut instructions, specifications, etc..." name="description" class='form-control'></textarea> <br>
                        <input type='submit' class='btn btn-success' value='Submit' name="addCust">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                 .attr('src', e.target.result)
                 .width(241)
                 .height(251);
            };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>