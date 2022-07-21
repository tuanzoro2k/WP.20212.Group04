<link rel="stylesheet" href="public/build/css/sidebar.css">
<div id="mySidebar" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <?php foreach ($data['categories'] as $key => $val) { ?>
        <button class="dropdown-btn"><?php echo $val['name'] ?>
            <i class="fa fa-caret-down"></i>
        </button>

        <div class="dropdown-container">
            <?php if (isset($val['children']) && $val['children'] != NULL) { ?>
                <?php foreach ($val['children'] as $key_child => $val_child) { ?>
                    <a href="<?= $val_child['slug'] ?>"><?php echo $val_child['name'] ?></a>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>

</div>
<div id="main">
    <button class="openbtn" onclick="openNav()">&#9776; </button>
</div>
<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }

    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
</script>