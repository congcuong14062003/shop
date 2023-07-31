<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Modal.css">
    <title>Document</title>
</head>

<body>

    <!-- Modal HTML -->
    <div id="myModal">
        <div class="modal-header">
            <button class="close_modal">X</button>
            <h2>Thông báo</h2>
        </div>
        <div class="modal-content">
            <p id="modal-message"><?php
                                    if (isset($_SESSION['messenger']) && !empty($_SESSION['messenger'])) {
                                        $messenger = $_SESSION['messenger'];
                                        unset($_SESSION['messenger']);
                                        echo $messenger;
                                    }
                                    ?>
            </p>
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        var modalMessage = document.getElementById("modal-message");

        function openModal() {
            modal.classList.add("slide-in");
            modal.style.display = "block";
            setTimeout(() => {
                modal.classList.add("slide-out");
            }, 3000);
        }


        var closeBtn = document.querySelector(".close_modal");
        closeBtn.onclick = function() {
            modal.classList.remove("slide-in");
            modal.classList.add("slide-out");
            setTimeout(function() {
                modal.style.display = "none";
                modal.classList.remove("slide-out");
            }, 500);
        };
    </script>

</body>

</html>