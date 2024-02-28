<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Subscription Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Styles for the dropdown */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 400px;
        padding: 20px;
        border: 1px solid #ddd;
        z-index: 1;
    }

    /* Style for the icon */
    .dropdown-icon {
        cursor: pointer;
    }
</style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title dropdown">Subscribe to our Newsletter</h5>
                    <div class="dropdown col-md-6 ">
                     <span class="dropdown-icon"><i class="fas fa-chevron-down"></i></span>
                      <div class="dropdown-content">
                        <form id="subscriptionForm" class="dropdown">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                            </div>
                            <button  type="submit" class="btn btn-primary">Subscribe</button>
                        </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your custom script for form submission -->
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $(".dropdown-icon").click(function(){
            $(".dropdown-content").toggle();
        });

        $(document).click(function(event) {
            if (!$(event.target).closest('.dropdown').length) {
                $(".dropdown-content").hide();
            }
        });

        function clearEmail()
        {
            $('#email').val('');
        }

        $('#subscriptionForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            
            $.ajax({
                type: 'POST',
                url: '/subscribe',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        clearEmail();
                        alert('Subscription successful!');
                        
                    } else {
                        alert('Subscription failed: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    clearEmail();
                    alert("Already registred");
                }
                
            });
            $(".dropdown-content").hide();
        });
       
       
    });
</script>

</body>
</html>
