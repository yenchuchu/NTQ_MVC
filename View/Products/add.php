
<?php require 'View/Layouts/checkLogined.php'; ?>
 <?php require 'View/Layouts/menu_admin.php'; ?>
    </ul>
</div>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="?controller=Products&action=index">List Products</a> <span class="divider">></span></li>
            <li class="active">Add</li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Products Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form class="form-horizontal" action="?controller=Products&action=add" 
                            method="POST" enctype="multipart/form-data">
                    	<div class="row-form">
                            <div class="span3">Product Name:</div>
                            <div class="span9">
                                <input type="text" placeholder="enter product name..." name="product-name" 
                                        value="<?php if (isset($_POST['product-name'])) { 
                                                        echo $_POST['product-name']; }?>" 
                                        required />
                            </div>
                            <div class="clear"></div>
                            <span id="message"><?php if (isset($result['message-prName'])) {
                                    echo $result['message-prName'] ;
                                } ?></span>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Price:</div>
                            <div class="span9">
                                <input type="number" placeholder="enter money..." name="price"
                                        id="add-price" value="<?php if (isset($_POST['price'])) { 
                                                        echo $_POST['price']; }?>" required />
                            </div>
                            <div class="clear"></div>
                             <span id="message"><?php if (isset($result['message-price'])) {
                                    echo $result['message-price'] ;
                                } ?></span>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Description:</div>
                            <div class="span9">
                                <textarea name="description" placeholder="add a description..."><?php 
                                                    if (isset($_POST['description'])) { 
                                                        echo $_POST['description'];} ?></textarea>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="row-form">
                            <div class="span3">Category:</div>
                            <div class="span9">
                            <select name="select-category" required >
                                <option value="">choose a option...</option>
                                <?php foreach ($result['categories'] as $category) {
                                    $selected = '';
                                    if (isset($_POST['select-category'])) {
                                        if ($category['id'] == $_POST['select-category']) {
                                             $selected = 'selected="selected"';
                                        }
                                    } 
                                   echo "<option value='".$category['id']."'".$selected.">".$category['category_name']."</option>";
                                } ?> 
                            </select>
                            </div>
                            <div class="clear"></div>
                            <span id="message"><?php if (isset($result['message-category'])) {
                                    echo $result['message-category'] ;
                                } ?></span>
                        </div>

                        <div class="row-form">
                            <div class="span3">Upload image:</div>
                            <div class="span9">
                                <img id="load-avatar-upload" src="img/users/avatar.jpg" 
                                    style="width: 50px; height: 50px " /> 
                                <script>
                                    var loadFile = function (event) {
                                        var output = document.getElementById('load-avatar-upload');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                    };
                                    
                                </script> 
                                <br/>
                                <input type="file" name="fileToUpload" size="19"
                                accept="image/*" id="fileToUpload" onchange="loadFile(event)">
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="select-activate" required>
                                    <?php 
                                        $select_activate = '';
                                        if (isset($_POST['select-activate'])) {
                                            $select_activate = $_POST['select-activate'];
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
                                    name="create-product" id="btn-create">Create</button>
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