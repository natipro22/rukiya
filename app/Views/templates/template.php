<!--
=========================================================
* Student Information Management System
=========================================================

* Main Page: Soft UI
* Color: white 
* Date: 10/6/2022
* Coded by Natnael Yirga

=========================================================
-->
<!DOCTYPE html>
<html lang="en">

    <?= $this->include("templates/partials/header");?>
    
    <body class="g-sidenav-show  bg-gray-100">
        
        <?= $this->include("templates/partials/sidenav");?>

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

            <?= $this->include("templates/partials/topnav");?>
            <div class="container-fluid py-4">
                <!-- message block of the views -->
                <?= $this->include("templates/partials/message_block") ?>
                <!-- the main content of the views -->
                <?= $this->renderSection("content");?> 
                
            </div>
            <!-- the footer of the views -->
            <?= $this->include("templates/partials/footer");?>
        </main>

        <?= $this->include("templates/partials/settings");?>
        
        <?= $this->include("templates/partials/footer_include");?>
    </body>
</html>

