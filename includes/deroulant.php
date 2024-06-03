<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>

</head>
<body>
<div class=deroulant>
<form action="" method="post">
            <select name="choix" id="choix">
                <option value="0" style="display: none;" selected>Choose </option>
                <option value="1">User Management</option>
                <option value="2">Content Management</option>
            </select>
        </form>
    </div>

        <script> 
    const select = document.getElementById('choix');
            select.addEventListener('change', function () {
                var valeur = select.options[select.selectedIndex].value;
                valeur = parseInt(valeur);
                 
                switch (valeur) {
                    case 1:
                        changeURL('user-management.php');
                        break;
                    case 2:
                        changeURL('content-management.php');
                        break;
                    default:
                        console.log('default');
                }
 
            });
             
            function changeURL(url) {
                window.location.href = url;
            }
    </script>

</body>
</html>
