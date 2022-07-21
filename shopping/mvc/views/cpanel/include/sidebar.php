<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="index2.html">Dashboard2</a></li>
                    <li><a href="index3.html">Dashboard3</a></li>
                </ul>
            </li>
            <?php if(isset($data['data_admin']['getModule']) && $data['data_admin']['getModule'] != NULL){?>
                <?php foreach($data['data_admin']['getModule'] as $key => $val){?>
                    <li><a href="<?= $val['children'] != null?'javascript:void(0)':$val['link'] ?>"><i class="fa fa-edit"></i> <?= $val['name'] ?> <?= $val['children'] != null?'<span class="fa fa-chevron-down"></span>':'' ?></a>
                        <?php if(isset($val['children']) && $val['children']!= null){?>
                            <ul class="nav child_menu">
                                <?php foreach($val['children'] as $key_child => $val_child){?>
                                    <li><a href="<?= $val_child['link'] ?>"><?= $val_child['name'] ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>