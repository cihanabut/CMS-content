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
<?php
// Détermine la page actuelle
$currentPage = basename($_SERVER['PHP_SELF']);

// Définit l'option sélectionnée en fonction de la page actuelle
$selectedOption = 0;
if ($currentPage == 'user-management.php') {
    $selectedOption = 1;
} elseif ($currentPage == 'content-management.php') {
    $selectedOption = 2;
}
?>
<div class="deroulant">
    <form action="" method="post">
        <select name="choix" id="choix">
            <option value="0" style="display: none;" <?php echo $selectedOption == 0 ? 'selected' : ''; ?>>Choose</option>
            <option value="1" <?php echo $selectedOption == 1 ? 'selected' : ''; ?>>User Management</option>
            <option value="2" <?php echo $selectedOption == 2 ? 'selected' : ''; ?>>Content Management</option>
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
