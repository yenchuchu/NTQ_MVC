<?php require 'View/Layouts/checkLogined.php'; ?>
 <?php require 'View/Layouts/menu_admin.php'; ?>
    </ul>
</div>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="?controller=Products&action=index">List Products</a> <span class="divider">></span></li>
            <li class="active">Edit</li>
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
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                            action="?controller=Products&action=edit&id=<?php echo $_GET['id']; ?>" >
                    	<div class="row-form">
                            <div class="span3">Product Name:</div>
                            <div class="span9">
                                <input type="text" placeholder="some text value..." 
                                        name="edit-product-name" required
                                       value="<?php if (isset($_POST['edit-product-name'])) { 
                                                        echo $_POST['edit-product-name']; 
                                                    } else {
                                                        echo $result['Clist']['product_name'];} ?>"  />
                            </div>
                            <div class="clear"></div>
                            <span id="message"><?php if (isset($result['message-prName'])) {
                                    echo $result['message-prName'] ;
                                } ?></span>
                        </div>
                        <div class="row-form">
                            <div class="span3">Upload image:</div>
                            <div class="span9">
                                <img id="load-avatar-upload" src="img/products/<?php 
                                                if(!empty($result['Clist']['image'])) {
                                                    echo $result['Clist']['image'];
                                                } else {
                                                     echo "1.jpg";
                                                }?>"  
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
                            <div class="span3">Price:</div>
                            <div class="span9">
                               <input type="number" placeholder="some text value..." id="add-price" name="edit-price"
                                       value="<?php if (isset($_POST['edit-price'])) { 
                                                        echo $_POST['edit-price']; 
                                                    } else{ echo $result['Clist']['price'];} ?>" required  />
                            </div>
                            <div class="clear"></div>
                            <span id="message"><?php if (isset($result['message-price'])) {
                                    echo $result['message-price'] ;
                                } ?></span>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Description:</div>
                            <div class="span9"> 
                                <textarea name="description" placeholder="Textarea field placeholder..."><?php
                                            $description = trim($result['Clist']['description']); 
                                            if (isset($_POST['description'])) { 
                                                echo $_POST['description'];
                                            } else{ echo $description; } ?></textarea>
                            </div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="select-activate" required>
                                <?php  
                                    if (isset($_POST['select-activate'])) {
                                        $select_activate = $_POST['select-activate']; ?>
                                        <option value="">choose a option...</option>
                                        <option value="1" <?php if ($select_activate == 1) { 
                                                                    echo 'selected="selected"'; 
                                                                }; ?> >Activate </option>
                                        <option value="2" <?php if ($select_activate == 2) {
                                                                    echo 'selected="selected"'; 
                                                                }; ?> >Deactivate</option>
                                    <?php } else { ?>
                                        <option value="">choose a option...</option>
                                        <option value="1" <?php if($result['Clist']['activate'] == 1) echo ' selected="selected"'; ?> >Activate</option>
                                        <option value="2" <?php if($result['Clist']['activate'] == 2) echo ' selected="selected"'; ?> >Deactivate</option>
                                    <?php } ?>  
                                    </select>
                            </div>
                            <div class="clear"></div>
                            <span id="message"><?php if (isset($result['message-activate'])) {
                                    echo $result['message-activate'] ;
                                } ?></span>
                        </div>                          
                        <div class="row-form">
                        	<button class="btn btn-success" type="submit" name="Update">Update</button>
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