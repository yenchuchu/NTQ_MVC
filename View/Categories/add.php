<?php require 'View/Layouts/checkLogined.php'; ?>
 <?php require 'View/Layouts/menu_admin.php'; ?>
    </ul>
</div>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="?controller=Categories&action=index">List Categories</a> <span class="divider">></span></li>
            <li class="active">Add</li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Categories Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form class="form-horizontal" action="?controller=Categories&action=add" method="POST">
                    	<div class="row-form">
                            <div class="span3">Category Name:</div>
                            <div class="span9">
                                <input type="text" name="categoryName" id="category-name"
                                        placeholder="some text value... "
                                        value="<?php if (isset($_POST['categoryName'])) { 
                                                        echo $_POST['categoryName']; }?>" required />
                            </div>
                            <div class="clear"></div>
                            <span id="message"><?php if (isset($result['message-cateName'])) {
                                    echo $result['message-cateName'] ;
                                } ?></span>
                        </div> 
                          
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="activate" id="activate-cate" required>
                                <?php 
                                    $select_activate = '';
                                    if (isset($_POST['activate'])) {
                                        $select_activate = $_POST['activate'];
                                    } ?>
                                    <option value="">choose a option...</option>
                                    <option value="1" <?php if ($select_activate == 1) {
                                        echo 'selected="selected"'; }; ?> >Activate</option>
                                    <option value="2" <?php if ($select_activate == 2) {
                                        echo 'selected="selected"'; }; ?> >Deactivate</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                            <span id="message"><?php if (isset($result['message-activate'])) {
                                    echo $result['message-activate'] ;
                                } ?></span>
                        </div>                          
                        <div class="row-form">
                        	<button class="btn btn-success" type="submit" 
                                    name="createCategory" id="created">Create</button>
							<div class="clear"></div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>   