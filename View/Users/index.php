<?php require 'View/Layouts/checkLogined.php'; ?>
 <?php require 'View/Layouts/menu_admin.php'; ?>
        <li>
            <a href="?controller=Users&action=index">
                <span class="isw-user"></span><span class="text">Users</span>
            </a>
        </li>
    </ul>

</div>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="?controller=Users&action=index">List Users</a></li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form>
                    <input type="text" class="span11" placeholder="Some text for search..." name="search"/>
                    <button class="btn span1" type="submit">Search</button>
                </form>
            </div>
        </div>
        <!-- /row-fluid-->

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Users Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <a href="add-user.html" class="btn btn-add">Add User</a>
                    <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"/></th>
                            <th width="15%" class="sorting"><a href="#">ID</a></th>
                            <th width="35%" class="sorting"><a href="#">Username</a></th>
                            <th width="20%" class="sorting"><a href="#">Activate</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Created</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Updated</a></th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result['ulist'] as $user) { ?>
                            <tr>
                                <td><input type="checkbox" name="checkbox"/></td>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php if ($user['activate'] == 1) { ?>
                                            <span class="text-success"> 
                                            <?php    echo "Activated"; ?> </span>
                                        <?php } else {
                                        ?> <span class="text-error"> <?php    echo "Deactivate";
                                        }  ?></span> </td>
                                <td><?php 
                                        $date=date_create($user['created']);
                                        echo date_format( $date,"H:i d/m/Y"); ?></td>
                                <td><?php 
                                        $date=date_create($user['modified']);
                                        echo date_format( $date,"H:i d/m/Y"); ?></td>
                                <td><a href="edit-user.html" class="btn btn-info">Edit</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="bulk-action">
                        <a href="#" class="btn btn-success">Activate</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </div><!-- /bulk-action-->
                    <div class="dataTables_paginate">
                        <a class="first paginate_button paginate_button_disabled" href="#">First</a>
                        <a class="previous paginate_button paginate_button_disabled" href="#">Previous</a>
                        <span>
                            <a class="paginate_active" href="#">1</a>
                            <a class="paginate_button" href="#">2</a>
                        </span>
                        <a class="next paginate_button" href="#">Next</a>
                        <a class="last paginate_button" href="#">Last</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>

<?php //foreach($users as $user) { ?>
  <!-- <p> -->
    <?php //echo $user->author; ?>
    <!-- <a href='?controller=posts&action=show&id=<?php echo $user->id; ?>'>See content</a> -->
  <!-- </p> -->
<?php //} ?>